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
	}

	private static function get_schema_data() {
		return array(
			'@context'    => 'https://schema.org',
			'@type'       => 'ProfessionalService',
			'@id'         => home_url( '/#organization' ),
			'name'        => 'RankCraft Web',
			'url'         => home_url( '/' ),
			'description' => 'WordPress development, SEO, and website audits for small businesses.',
			'areaServed'  => array(
				array( '@type' => 'Country', 'name' => 'United States' ),
			),
			'sameAs'      => array(
				home_url( '/' ),
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
				'answer'   => 'Mostly service-based businesses, real estate, home services, and local businesses that depend on their website to bring in leads, not just look good.',
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
				'answer'   => "Yes. I offer ongoing maintenance and support after launch, hosting, updates, and changes, so you're never stuck if something needs fixing down the line.",
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
}

RankCraft_Schema_Markup::init();
