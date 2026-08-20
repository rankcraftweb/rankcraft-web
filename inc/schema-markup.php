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
				// Add social/profile URLs here once live:
				// 'https://www.linkedin.com/in/...',
				// 'https://github.com/...',
			),
		);
	}

	public static function output_schema() {
		$schema = apply_filters( 'rankcraft_schema_markup_data', self::get_schema_data() );

		echo '<script type="application/ld+json">' . "\n";
		echo wp_json_encode( $schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
		echo "\n" . '</script>' . "\n";
	}
}

RankCraft_Schema_Markup::init();
