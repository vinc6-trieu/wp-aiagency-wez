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
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 800,
				'width'       => 800,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);

		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'aiagency-wez' ),
			)
		);
	}
}
add_action( 'after_setup_theme', 'aiagency_wez_setup' );

/**
 * Returns safe HTML for the site logo image (Customizer logo or theme default).
 *
 * @return string
 */
function aiagency_wez_get_site_logo_img_html() {
	$custom_logo_id = (int) get_theme_mod( 'custom_logo' );

	if ( $custom_logo_id ) {
		$html = wp_get_attachment_image(
			$custom_logo_id,
			'full',
			false,
			array(
				'class' => 'site-branding__logo',
			)
		);

		return is_string( $html ) ? $html : '';
	}

	$src = get_template_directory_uri() . '/assets/logo.png';

	return sprintf(
		'<img src="%1$s" alt="%2$s" class="site-branding__logo" width="800" height="800" decoding="async" loading="eager">',
		esc_url( $src ),
		esc_attr( get_bloginfo( 'name' ) )
	);
}

/**
 * Enqueues theme assets.
 */
function aiagency_wez_enqueue_assets() {
	$style_path    = get_stylesheet_directory() . '/style.css';
	$style_version = file_exists( $style_path ) ? (string) filemtime( $style_path ) : wp_get_theme()->get( 'Version' );

	wp_enqueue_style(
		'aiagency-wez-fonts',
		'https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800;900&family=Poppins:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'aiagency-wez-style',
		get_stylesheet_uri(),
		array( 'aiagency-wez-fonts' ),
		$style_version
	);
}
add_action( 'wp_enqueue_scripts', 'aiagency_wez_enqueue_assets' );

/**
 * Checks whether the current request uses the Home Page - Version 1 template.
 *
 * @return bool
 */
function aiagency_wez_is_home_v1_template() {
	return is_page_template( 'page-templates/template-home-v1.php' );
}

/**
 * Enqueues Home V1 scroll-reveal script when that template is active.
 */
function aiagency_wez_enqueue_home_v1_reveal() {
	if ( ! aiagency_wez_is_home_v1_template() ) {
		return;
	}

	$reveal_path = get_template_directory() . '/assets/js/home-v1-reveal.js';
	if ( ! is_readable( $reveal_path ) ) {
		return;
	}

	wp_enqueue_script(
		'aiagency-wez-home-v1-reveal',
		get_template_directory_uri() . '/assets/js/home-v1-reveal.js',
		array(),
		(string) filemtime( $reveal_path ),
		true
	);
	wp_script_add_data( 'aiagency-wez-home-v1-reveal', 'strategy', 'defer' );

	$nav_path = get_template_directory() . '/assets/js/home-v1-smooth-nav.js';
	if ( is_readable( $nav_path ) ) {
		wp_enqueue_script(
			'aiagency-wez-home-v1-smooth-nav',
			get_template_directory_uri() . '/assets/js/home-v1-smooth-nav.js',
			array(),
			(string) filemtime( $nav_path ),
			true
		);
		wp_script_add_data( 'aiagency-wez-home-v1-smooth-nav', 'strategy', 'defer' );
	}
}
add_action( 'wp_enqueue_scripts', 'aiagency_wez_enqueue_home_v1_reveal', 20 );

/**
 * ISO 639-1 source language code for Google Translate (from site locale).
 *
 * @return string
 */
function aiagency_wez_get_page_language_code() {
	$locale = get_locale();
	if ( ! is_string( $locale ) || $locale === '' ) {
		return 'en';
	}
	$base = strstr( $locale, '_', true );
	if ( false === $base ) {
		$base = $locale;
	}
	$code = strtolower( substr( $base, 0, 2 ) );
	return preg_match( '/^[a-z]{2}$/', $code ) ? $code : 'en';
}

/**
 * Loads Google Website Translator on Home V1 (user picks language; no full page reload).
 */
function aiagency_wez_enqueue_google_translate() {
	if ( is_admin() || ! aiagency_wez_is_home_v1_template() ) {
		return;
	}

	$page_lang = aiagency_wez_get_page_language_code();

	wp_register_script( 'aiagency-wez-gtranslate-init', false, array(), null, true );
	wp_enqueue_script( 'aiagency-wez-gtranslate-init' );

	$init = sprintf(
		'function aiagencyWezGoogleTranslateInit(){if(typeof google===\'undefined\'||!google.translate){return;}' .
		'new google.translate.TranslateElement({pageLanguage:\'%s\',layout:google.translate.TranslateElement.InlineLayout.SIMPLE,autoDisplay:false},\'google_translate_element\');}',
		esc_js( $page_lang )
	);
	wp_add_inline_script( 'aiagency-wez-gtranslate-init', $init, 'after' );

	wp_enqueue_script(
		'google-translate-element',
		'https://translate.google.com/translate_a/element.js?cb=aiagencyWezGoogleTranslateInit',
		array( 'aiagency-wez-gtranslate-init' ),
		null,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'aiagency_wez_enqueue_google_translate', 25 );

/**
 * Adds a stable body class for the custom home page template.
 *
 * @param array<int, string> $classes Existing body classes.
 * @return array<int, string>
 */
function aiagency_wez_body_classes( $classes ) {
	if ( is_page_template( 'page-templates/template-home.php' ) ) {
		$classes[] = 'aiagency-wez-home-template';
	}

	if ( aiagency_wez_is_home_v1_template() ) {
		$classes[] = 'aiagency-wez-home-v1-template';
	}

	return $classes;
}
add_filter( 'body_class', 'aiagency_wez_body_classes' );

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

/**
 * Inline SVG for Home V1 competency rows when no icon image is set (circle + checkmark).
 *
 * @return string
 */
function aiagency_wez_home_v1_competency_default_icon_svg() {
	return '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="9.25" fill="none" stroke="currentColor" stroke-width="1.3"/><path stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" d="M7.6 12.2 10.4 15l6-6.2"/></svg>';
}
