<?php
/**
 * Theme setup and helper functions for aiagency-wez.
 *
 * @package aiagency-wez
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aiagency_wez_setup' ) ) {
	/**
	 * Registers theme defaults.
	 */
	function aiagency_wez_setup() {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'aiagency-wez' ),
			)
		);
	}
}
add_action( 'after_setup_theme', 'aiagency_wez_setup' );

/**
 * Enqueues theme assets.
 */
function aiagency_wez_enqueue_assets() {
	wp_enqueue_style(
		'aiagency-wez-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'aiagency_wez_enqueue_assets' );

/**
 * Turns a textarea value into a clean array of lines.
 *
 * @param mixed $value Raw textarea content.
 * @return array<int, string>
 */
function aiagency_wez_get_lines( $value ) {
	if ( empty( $value ) || ! is_string( $value ) ) {
		return array();
	}

	$lines = preg_split( '/\r\n|\r|\n/', $value );

	if ( ! is_array( $lines ) ) {
		return array();
	}

	$lines = array_map( 'trim', $lines );
	$lines = array_filter( $lines );

	return array_values( $lines );
}

/**
 * Returns a small allowlist for iframe embed markup.
 *
 * @return array<string, array<string, true>>
 */
function aiagency_wez_allowed_iframe_html() {
	return array(
		'iframe' => array(
			'allow'           => true,
			'allowfullscreen' => true,
			'height'          => true,
			'loading'         => true,
			'referrerpolicy'  => true,
			'src'             => true,
			'style'           => true,
			'title'           => true,
			'width'           => true,
		),
	);
}

/**
 * Normalizes common ACF image return formats.
 *
 * @param mixed $image ACF image field value.
 * @return array<string, string>
 */
function aiagency_wez_get_image_data( $image ) {
	$image_data = array(
		'url' => '',
		'alt' => '',
	);

	if ( empty( $image ) ) {
		return $image_data;
	}

	if ( is_array( $image ) ) {
		$image_data['url'] = isset( $image['url'] ) ? (string) $image['url'] : '';
		$image_data['alt'] = isset( $image['alt'] ) ? (string) $image['alt'] : '';

		return $image_data;
	}

	if ( is_numeric( $image ) ) {
		$image_id = (int) $image;

		$image_data['url'] = (string) wp_get_attachment_image_url( $image_id, 'full' );
		$image_data['alt'] = (string) get_post_meta( $image_id, '_wp_attachment_image_alt', true );

		return $image_data;
	}

	if ( is_string( $image ) ) {
		$image_data['url'] = $image;
	}

	return $image_data;
}
