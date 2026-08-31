<?php
/**
 * What this site asks Google to index.
 *
 * Two faults from the 31 August 2026 audit, both invisible from the
 * front end:
 *
 * 1. /category/uncategorized/ was in the sitemap and returning 200.
 *    There is one category, every post is in it, and it is called
 *    Uncategorized - so that URL was a near-duplicate of /blog/ under a
 *    placeholder name, being actively submitted for indexing.
 *
 * 2. /portfolio/ was not in the sitemap at all. Core sitemaps cover
 *    posts, pages, custom post type entries and taxonomies; they do not
 *    cover post type archives. All three case studies were listed and
 *    the page built to introduce them was not.
 *
 * @package RankCraft_Web
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Keep taxonomy archives out of the sitemap.
 *
 * With a single category holding every post, the category archive says
 * nothing /blog/ does not already say. If real categories are added
 * later, with genuinely different sets of posts, this is the first
 * thing to revisit - along with the noindex below.
 *
 * @param array $taxonomies Taxonomies included in the sitemap.
 * @return array
 */
function rankcraft_sitemap_taxonomies( $taxonomies ) {
	unset( $taxonomies['category'], $taxonomies['post_tag'] );
	return $taxonomies;
}
add_filter( 'wp_sitemaps_taxonomies', 'rankcraft_sitemap_taxonomies' );

/**
 * Mark the archives that duplicate another page as noindex, follow.
 *
 * Follow rather than nofollow on purpose: the pages linked from these
 * archives are ones that should rank, and there is no reason to stop a
 * crawler reaching them just because the list itself is redundant.
 *
 * @param array $robots Robots directives.
 * @return array
 */
function rankcraft_noindex_duplicate_archives( $robots ) {
	if ( is_category() || is_tag() || is_date() || is_author() ) {
		$robots['noindex'] = true;
		$robots['follow']  = true;
	}
	return $robots;
}
add_filter( 'wp_robots', 'rankcraft_noindex_duplicate_archives' );

/**
 * Sitemap entry for the case study archive at /portfolio/.
 *
 * Core has no hook for adding a single URL, so this is the smallest
 * provider that will carry one. If another post type archive ever needs
 * listing, add it to the array in get_url_list() rather than writing a
 * second provider.
 */
class RankCraft_Archive_Sitemap_Provider extends WP_Sitemaps_Provider {

	/**
	 * Set the provider's name and object type.
	 */
	public function __construct() {
		$this->name        = 'archives';
		$this->object_type = 'archive';
	}

	/**
	 * Return the archive URLs.
	 *
	 * @param int    $page_num       Page of results.
	 * @param string $object_subtype Unused.
	 * @return array
	 */
	public function get_url_list( $page_num, $object_subtype = '' ) {
		if ( 1 !== (int) $page_num ) {
			return array();
		}

		$urls = array();

		foreach ( array( 'case_study' ) as $post_type ) {
			$link = get_post_type_archive_link( $post_type );

			// An archive with no published entries is not worth
			// submitting, and get_post_type_archive_link() returns false
			// if the post type stops declaring has_archive.
			if ( ! $link ) {
				continue;
			}

			$count = wp_count_posts( $post_type );
			if ( empty( $count->publish ) ) {
				continue;
			}

			$urls[] = array( 'loc' => $link );
		}

		return $urls;
	}

	/**
	 * One page is always enough for a handful of archive URLs.
	 *
	 * @param string $object_subtype Unused.
	 * @return int
	 */
	public function get_max_num_pages( $object_subtype = '' ) {
		return 1;
	}
}

/**
 * Register the archive provider once sitemaps are available.
 */
function rankcraft_register_archive_sitemap() {
	if ( ! function_exists( 'wp_register_sitemap_provider' ) ) {
		return;
	}
	wp_register_sitemap_provider( 'archives', new RankCraft_Archive_Sitemap_Provider() );
}
add_action( 'init', 'rankcraft_register_archive_sitemap' );
