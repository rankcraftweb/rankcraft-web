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
	 *
	 * Returns array( url, width, height ).
	 *
	 * This used to ask for WordPress's 'large' size, which is 1024px
	 * wide - under the 1200x630 that Facebook, LinkedIn and X all
	 * document, so every share card on the site was being built from a
	 * smaller file than the one that existed. See the 'rankcraft-og'
	 * size in functions.php for why the fix is a cropped size rather
	 * than simply 'full'.
	 *
	 * The dimensions come back with the URL so they can be declared in
	 * the markup, and they are read from the same lookup on purpose: a
	 * declared size that disagrees with the actual file is worse than
	 * declaring no size at all.
	 */
	private static function get_image() {
		if ( is_singular() && has_post_thumbnail() ) {
			$image = self::share_image( get_post_thumbnail_id() );
			if ( $image ) {
				return $image;
			}
		}

		// A dedicated fallback card, not the homepage hero mockup, so a
		// page without its own image doesn't share previews that look
		// like they're for the homepage specifically.
		$fallback = self::share_image( 377 );

		return $fallback ? $fallback : array( '', 0, 0 );
	}

	/**
	 * The share-card size for one attachment, or null.
	 *
	 * 'rankcraft-og' only exists for images uploaded or regenerated
	 * since it was registered. wp_get_attachment_image_src() falls back
	 * to the original on its own when a named size is missing, which is
	 * why the width and height are read from its return value rather
	 * than assumed to be 1200x630.
	 */
	private static function share_image( $attachment_id ) {
		$image = wp_get_attachment_image_src( $attachment_id, 'rankcraft-og' );

		if ( ! $image || empty( $image[0] ) ) {
			return null;
		}

		return array( $image[0], (int) $image[1], (int) $image[2] );
	}

	private static function get_og_type() {
		return is_singular( 'post' ) ? 'article' : 'website';
	}

	private static function get_current_url() {
		global $wp;
		return home_url( user_trailingslashit( $wp->request ) );
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
		$url         = self::get_current_url();

		list( $image, $image_w, $image_h ) = self::get_image();

		self::output_canonical();

		echo "\n<!-- Meta description & Open Graph (RankCraft) -->\n";
		printf( '<meta name="description" content="%s">' . "\n", esc_attr( $description ) );

		printf( '<meta property="og:type" content="%s">' . "\n", esc_attr( self::get_og_type() ) );
		printf( '<meta property="og:site_name" content="%s">' . "\n", esc_attr( get_bloginfo( 'name' ) ) );
		printf( '<meta property="og:title" content="%s">' . "\n", esc_attr( $title ) );
		printf( '<meta property="og:description" content="%s">' . "\n", esc_attr( $description ) );
		printf( '<meta property="og:url" content="%s">' . "\n", esc_url( $url ) );
		printf( '<meta property="og:image" content="%s">' . "\n", esc_url( $image ) );

		// Only when they are real numbers. Declaring a size that does
		// not match the file makes the card worse, not better.
		if ( $image_w && $image_h ) {
			printf( '<meta property="og:image:width" content="%d">' . "\n", $image_w );
			printf( '<meta property="og:image:height" content="%d">' . "\n", $image_h );
		}

		printf( '<meta name="twitter:card" content="summary_large_image">' . "\n" );
		printf( '<meta name="twitter:title" content="%s">' . "\n", esc_attr( $title ) );
		printf( '<meta name="twitter:description" content="%s">' . "\n", esc_attr( $description ) );
		printf( '<meta name="twitter:image" content="%s">' . "\n", esc_url( $image ) );
	}
}

RankCraft_SEO_Meta::init();
