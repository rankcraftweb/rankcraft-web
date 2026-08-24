<?php
/**
 * RankCraft Web - Meta Description & Open Graph Tags
 *
 * Lightweight, hand-coded SEO meta output (no plugin dependency),
 * following the same pattern as inc/schema-markup.php: a small class
 * hooked to wp_head. Canonical URLs are already handled by WordPress
 * core (rel_canonical()), so this only covers what core doesn't:
 * meta description, Open Graph, and Twitter Card tags.
 *
 * @package RankCraft_Web
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RankCraft_SEO_Meta {

	public static function init() {
		add_action( 'wp_head', array( __CLASS__, 'output_meta_tags' ), 2 );
	}

	/**
	 * Build a plain-text description for the current page.
	 */
	private static function get_description() {
		if ( is_front_page() ) {
			return "RankCraft builds fast, SEO-optimized WordPress websites for service businesses. Get a free website audit and see exactly where your site stands.";
		}

		if ( is_home() ) {
			return 'Practical, no-fluff notes on WordPress development, technical SEO, and website performance from RankCraft Web.';
		}

		if ( is_post_type_archive( 'case_study' ) ) {
			return 'Real client projects: WordPress builds and technical SEO work from RankCraft Web, with the results to back them up.';
		}

		if ( is_singular() ) {
			$post = get_queried_object();

			if ( $post && ! empty( $post->post_excerpt ) ) {
				return wp_strip_all_tags( $post->post_excerpt );
			}

			if ( $post ) {
				$content = wp_strip_all_tags( strip_shortcodes( $post->post_content ) );
				if ( $content ) {
					return wp_trim_words( $content, 30, '...' );
				}
			}
		}

		$tagline = get_bloginfo( 'description' );
		return $tagline ? $tagline : get_bloginfo( 'name' );
	}

	/**
	 * Google truncates meta descriptions around 155-160 characters.
	 * Cut cleanly at a word boundary instead of mid-sentence.
	 */
	private static function truncate_description( $text, $limit = 155 ) {
		$text = trim( $text );

		if ( mb_strlen( $text ) <= $limit ) {
			return $text;
		}

		$truncated  = mb_substr( $text, 0, $limit - 1 );
		$last_space = mb_strrpos( $truncated, ' ' );

		if ( false !== $last_space ) {
			$truncated = mb_substr( $truncated, 0, $last_space );
		}

		return rtrim( $truncated, " .,;:-" ) . '…';
	}

	/**
	 * Pick an image to represent the current page in social shares.
	 */
	private static function get_image_url() {
		if ( is_singular() && has_post_thumbnail() ) {
			$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
			if ( $image ) {
				return $image[0];
			}
		}

		// A dedicated fallback card, not the homepage hero mockup, so a
		// page without its own image doesn't share previews that look
		// like they're for the homepage specifically.
		return wp_get_attachment_image_url( 377, 'full' );
	}

	private static function get_og_type() {
		return is_singular( 'post' ) ? 'article' : 'website';
	}

	private static function get_current_url() {
		global $wp;
		return home_url( add_query_arg( array(), $wp->request ) );
	}

	/**
	 * WordPress core's rel_canonical() doesn't output a tag for the
	 * blog listing (page_for_posts) or the case_study archive on this
	 * site, so add an explicit one for just those two rather than
	 * relying on core here.
	 */
	private static function output_canonical() {
		if ( ! is_home() && ! is_post_type_archive( 'case_study' ) ) {
			return;
		}

		printf( '<link rel="canonical" href="%s">' . "\n", esc_url( self::get_current_url() ) );
	}

	public static function output_meta_tags() {
		$description = self::truncate_description( self::get_description() );
		$title       = wp_get_document_title();
		$image       = self::get_image_url();
		$url         = self::get_current_url();

		self::output_canonical();

		echo "\n<!-- Meta description & Open Graph (RankCraft) -->\n";
		printf( '<meta name="description" content="%s">' . "\n", esc_attr( $description ) );

		printf( '<meta property="og:type" content="%s">' . "\n", esc_attr( self::get_og_type() ) );
		printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( get_bloginfo( 'name' ) ) );
		printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $title ) );
		printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $description ) );
		printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $url ) );
		printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $image ) );

		printf( '<meta name="twitter:card" content="summary_large_image">' . "\n" );
		printf( '<meta name="twitter:title" content="%s">' . "\n", esc_attr( $title ) );
		printf( '<meta name="twitter:description" content="%s">' . "\n", esc_attr( $description ) );
		printf( '<meta name="twitter:image" content="%s">' . "\n", esc_url( $image ) );
	}
}

RankCraft_SEO_Meta::init();
