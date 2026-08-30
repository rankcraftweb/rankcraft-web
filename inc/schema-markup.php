<?php
/**
 * RankCraft Web - Organization Schema Markup
 *
 * Same pattern proven on the Rossi Real Estate project:
 * structured PHP array, output via wp_json_encode, hooked to wp_head.
 *
 * @package RankCraft_Web
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class RankCraft_Schema_Markup {

	public static function init() {
		add_action( 'wp_head', array( __CLASS__, 'output_schema' ), 5 );
		add_action( 'wp_head', array( __CLASS__, 'output_faq_schema' ), 5 );
		add_action( 'wp_head', array( __CLASS__, 'output_blog_posting_schema' ), 5 );
		add_action( 'wp_head', array( __CLASS__, 'output_service_schema' ), 5 );
		add_action( 'wp_head', array( __CLASS__, 'output_case_study_schema' ), 5 );
	}

	/**
	 * Search Console shows the bare brand name ("rankcraft") sitting around
	 * position 38 while the exact domain ranks 1-2, i.e. Google resolves the
	 * URL to us but hasn't tied the short name to an entity yet. alternateName
	 * states that mapping outright, and logo/image give the entity something
	 * to attach to in a knowledge panel.
	 */
	private static function get_schema_data() {
		return array(
			'@context'        => 'https://schema.org',
			'@type'           => 'ProfessionalService',
			'@id'             => home_url( '/#organization' ),
			'name'            => 'RankCraft Web',
			'alternateName'   => 'RankCraft',
			'url'             => home_url( '/' ),
			// Square mark with its own background, so it stays legible
			// wherever Google places it (light or dark surface).
			'logo'            => RANKCRAFT_URI . '/assets/images/apple-touch-icon.png',
			// Attachment 377 is the same fallback inc/seo-meta.php serves as
			// og:image; going through the media library keeps the two in sync
			// instead of hardcoding an uploads path that can move.
			'image'           => wp_get_attachment_image_url( 377, 'full' ),
			'description'     => 'WordPress development, SEO, and website audits for small businesses.',
			// Three months of Search Console data: the Philippines supplies 118
			// impressions and 3 of the 4 total clicks, while the United States
			// supplies 81 impressions at position 11 and has never produced a
			// single click - part of that being Laguna Beach and Laguna Hills in
			// California matching pages written for Laguna province. Naming the
			// real service area also stops the markup contradicting the Google
			// Business Profile, which is set to Cavite.
			'areaServed'      => array(
				array( '@type' => 'City', 'name' => 'Silang' ),
				array( '@type' => 'AdministrativeArea', 'name' => 'Cavite' ),
				array( '@type' => 'Country', 'name' => 'Philippines' ),
			),
			// Capabilities, not verticals. The industries previously listed
			// here came from work delivered under a client's own brand, so
			// they described their market rather than this one's.
			'knowsAbout'      => array(
				'WordPress development',
				'Custom WordPress theme development',
				'Technical SEO',
				'Core Web Vitals optimization',
				'Website performance optimization',
				'Structured data and schema markup',
			),
			'hasOfferCatalog' => array(
				'@type'           => 'OfferCatalog',
				'name'            => 'WordPress development and SEO services',
				'itemListElement' => array(
					array(
						'@type'       => 'Offer',
						'itemOffered' => array(
							'@type' => 'Service',
							'name'  => 'WordPress Development',
							'url'   => home_url( '/wordpress-development/' ),
						),
					),
					array(
						'@type'       => 'Offer',
						'itemOffered' => array(
							'@type' => 'Service',
							'name'  => 'SEO and Local Search',
							'url'   => home_url( '/seo-and-local-search/' ),
						),
					),
					array(
						'@type'       => 'Offer',
						'itemOffered' => array(
							'@type' => 'Service',
							'name'  => 'Performance Audits',
							'url'   => home_url( '/performance-audits/' ),
						),
					),
				),
			),
			'founder'         => array(
				'@type'  => 'Person',
				'name'   => 'Jan',
				'url'    => home_url( '/about/' ),
				'sameAs' => array(
					'https://www.linkedin.com/in/jan-christopher-buen-24715117a',
					'https://github.com/rankcraftweb',
				),
			),
			// sameAs is for profiles *elsewhere* that describe this same
			// entity - listing our own homepage here (already given as `url`)
			// said nothing, so it's dropped.
			//
			// The Facebook page is the organisation's own profile and already
			// ranks on page one for "RankCraft Web", so it's the strongest
			// third-party confirmation that this name maps to this business -
			// which is exactly what's missing while nine unrelated companies
			// share the "RankCraft" name.
			'sameAs'          => array(
				'https://www.facebook.com/rankcraftweb',
				'https://www.linkedin.com/in/jan-christopher-buen-24715117a',
				'https://github.com/rankcraftweb',
			),
		);
	}

	public static function output_schema() {
		$schema = apply_filters( 'rankcraft_schema_markup_data', self::get_schema_data() );

		echo '<script type="application/ld+json">' . "\n";
		echo wp_json_encode( $schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
		echo "\n" . '</script>' . "\n";
	}

	/**
	 * FAQPage schema for the homepage FAQ section. Keep this list in sync
	 * with the <details> markup in front-page.php.
	 */
	private static function get_faq_items() {
		return array(
			array(
				'question' => 'Do you build websites, help with SEO, or both?',
				'answer'   => "Both. Most clients come to me for a WordPress build and ongoing technical SEO, since the two are hard to separate: a site that isn't built right technically will never rank as well as it should.",
			),
			array(
				'question' => 'What type of businesses do you work with?',
				'answer'   => "Small and service-based businesses whose website has to bring in leads, not just look good. If your site is slow or isn't showing up in search, that's the work I do.",
			),
			array(
				'question' => 'Can you work with my existing website, or does it need a full rebuild?',
				'answer'   => "It depends on what's underneath. Sometimes a technical audit and targeted fixes are enough. Other times a rebuild is genuinely faster and cheaper long-term. I'll tell you honestly which one your site needs.",
			),
			array(
				'question' => 'Will my website be mobile-friendly?',
				'answer'   => 'Yes. Every site I build is responsive and tested across devices, and mobile performance is part of every technical SEO audit since Google evaluates the mobile experience first.',
			),
			array(
				'question' => 'How long does a typical project take?',
				'answer'   => 'A custom WordPress build usually takes 2 to 4 weeks depending on scope. Audits and SEO fixes move faster, often within a week of getting started.',
			),
			array(
				'question' => 'Do you offer support after the site launches?',
				'answer'   => 'Yes, as a separate monthly plan rather than something folded into the build price. Hosting, updates, backups, security monitoring and small changes, so you are not stuck when something needs fixing later.',
			),
		);
	}

	public static function output_faq_schema() {
		if ( ! is_front_page() ) {
			return;
		}

		$schema = array(
			'@context'   => 'https://schema.org',
			'@type'      => 'FAQPage',
			'mainEntity' => array(),
		);

		foreach ( self::get_faq_items() as $item ) {
			$schema['mainEntity'][] = array(
				'@type'          => 'Question',
				'name'           => $item['question'],
				'acceptedAnswer' => array(
					'@type' => 'Answer',
					'text'  => $item['answer'],
				),
			);
		}

		echo '<script type="application/ld+json">' . "\n";
		echo wp_json_encode( $schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
		echo "\n" . '</script>' . "\n";
	}

	/**
	 * BlogPosting schema for single blog posts.
	 */
	public static function output_blog_posting_schema() {
		if ( ! is_singular( 'post' ) ) {
			return;
		}

		$post_id = get_the_ID();
		$image   = has_post_thumbnail( $post_id ) ? wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'large' ) : false;

		$schema = array(
			'@context'         => 'https://schema.org',
			'@type'            => 'BlogPosting',
			'headline'         => get_the_title( $post_id ),
			'url'              => get_permalink( $post_id ),
			'datePublished'    => get_the_date( 'c', $post_id ),
			'dateModified'     => get_the_modified_date( 'c', $post_id ),
			'author'           => array(
				'@type' => 'Person',
				'name'  => 'Jan',
				'url'   => home_url( '/about/' ),
			),
			'publisher'        => array(
				'@type' => 'Organization',
				'name'  => 'RankCraft Web',
				'url'   => home_url( '/' ),
			),
			'mainEntityOfPage' => array(
				'@type' => 'WebPage',
				'@id'   => get_permalink( $post_id ),
			),
		);

		if ( $image ) {
			$schema['image'] = $image[0];
		}

		echo '<script type="application/ld+json">' . "\n";
		echo wp_json_encode( $schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
		echo "\n" . '</script>' . "\n";
	}

	/**
	 * Service schema for the three service pages.
	 */
	private static function get_service_pages() {
		return array(
			'wordpress-development' => 'WordPress Development',
			'seo-and-local-search'  => 'SEO and Local Search',
			'performance-audits'    => 'Performance Audits',
		);
	}

	public static function output_service_schema() {
		if ( ! is_page() ) {
			return;
		}

		$slug     = get_post_field( 'post_name', get_the_ID() );
		$services = self::get_service_pages();

		if ( ! isset( $services[ $slug ] ) ) {
			return;
		}

		$schema = array(
			'@context'    => 'https://schema.org',
			'@type'       => 'Service',
			'name'        => $services[ $slug ],
			'url'         => get_permalink(),
			'description' => get_the_excerpt() ? wp_strip_all_tags( get_the_excerpt() ) : '',
			'provider'    => array(
				'@type' => 'ProfessionalService',
				'@id'   => home_url( '/#organization' ),
				'name'  => 'RankCraft Web',
			),
			'areaServed'  => array(
				array( '@type' => 'City', 'name' => 'Silang' ),
				array( '@type' => 'AdministrativeArea', 'name' => 'Cavite' ),
				array( '@type' => 'Country', 'name' => 'Philippines' ),
			),
		);

		echo '<script type="application/ld+json">' . "\n";
		echo wp_json_encode( $schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
		echo "\n" . '</script>' . "\n";
	}

	/**
	 * CreativeWork schema for case studies, carrying the client name and
	 * headline stats through to search engines.
	 */
	public static function output_case_study_schema() {
		if ( ! is_singular( 'case_study' ) ) {
			return;
		}

		$post_id     = get_the_ID();
		$client_name = get_post_meta( $post_id, '_rc_client_name', true );
		$project_url = get_post_meta( $post_id, '_rc_project_url', true );

		$stats = array();
		for ( $i = 1; $i <= 4; $i++ ) {
			$number = get_post_meta( $post_id, '_rc_stat_' . $i . '_number', true );
			$label  = get_post_meta( $post_id, '_rc_stat_' . $i . '_label', true );
			if ( $number && $label ) {
				$stats[] = $number . ' ' . $label;
			}
		}

		$schema = array(
			'@context' => 'https://schema.org',
			'@type'    => 'CreativeWork',
			'name'     => get_the_title( $post_id ),
			'url'      => get_permalink( $post_id ),
			'creator'  => array(
				'@type' => 'Organization',
				'name'  => 'RankCraft Web',
			),
		);

		if ( $client_name ) {
			$schema['about'] = $client_name;
		}

		if ( $project_url ) {
			$schema['mentions'] = array(
				'@type' => 'WebSite',
				'url'   => $project_url,
			);
		}

		if ( $stats ) {
			$schema['keywords'] = implode( ', ', $stats );
		}

		echo '<script type="application/ld+json">' . "\n";
		echo wp_json_encode( $schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
		echo "\n" . '</script>' . "\n";
	}
}

RankCraft_Schema_Markup::init();
