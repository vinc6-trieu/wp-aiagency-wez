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
 * Enqueues a theme stylesheet with a filemtime version when the file exists.
 *
 * @param string   $handle        Registered style handle.
 * @param string   $relative_path Theme-relative asset path, starting with "/".
 * @param string[] $deps          Optional style dependencies.
 * @return string|false
 */
function aiagency_wez_enqueue_versioned_style( $handle, $relative_path, $deps = array() ) {
	$path = get_template_directory() . $relative_path;

	if ( ! is_readable( $path ) ) {
		return false;
	}

	wp_enqueue_style(
		$handle,
		get_template_directory_uri() . $relative_path,
		$deps,
		(string) filemtime( $path )
	);

	return $handle;
}

/**
 * Enqueues theme assets.
 */
function aiagency_wez_enqueue_assets() {
	wp_enqueue_style(
		'aiagency-wez-fonts',
		'https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800;900&family=Poppins:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	$style_manifest = array(
		'aiagency-wez-base'               => '/assets/css/base.css',
		'aiagency-wez-home'               => '/assets/css/home.css',
		'aiagency-wez-base-responsive'    => '/assets/css/base-responsive.css',
		'aiagency-wez-home-v1-chrome'     => '/assets/css/home-v1-chrome.css',
		'aiagency-wez-home-v1-motion'     => '/assets/css/home-v1-motion.css',
		'aiagency-wez-home-v1-layout'     => '/assets/css/home-v1-layout.css',
		'aiagency-wez-home-v1-responsive' => '/assets/css/home-v1-responsive.css',
	);

	$last_style_handle = 'aiagency-wez-fonts';

	foreach ( $style_manifest as $handle => $relative_path ) {
		$enqueued_handle = aiagency_wez_enqueue_versioned_style( $handle, $relative_path, array( $last_style_handle ) );

		if ( $enqueued_handle ) {
			$last_style_handle = $enqueued_handle;
		}
	}

	if ( aiagency_wez_is_content_page_template() ) {
		aiagency_wez_enqueue_versioned_style(
			'aiagency-wez-content-page',
			'/assets/css/content-page.css',
			array( $last_style_handle )
		);
	}

	$menu_path = get_template_directory() . '/assets/js/site-header-menu.js';
	if ( is_readable( $menu_path ) ) {
		wp_enqueue_script(
			'aiagency-wez-site-header-menu',
			get_template_directory_uri() . '/assets/js/site-header-menu.js',
			array(),
			(string) filemtime( $menu_path ),
			true
		);
		wp_script_add_data( 'aiagency-wez-site-header-menu', 'strategy', 'defer' );
	}
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
 * Checks whether the current request uses the Content Page template.
 *
 * @return bool
 */
function aiagency_wez_is_content_page_template() {
	return is_page_template( 'page-templates/template-content-page.php' );
}

/**
 * Checks whether the current request should use Home V1 header/footer chrome.
 *
 * @return bool
 */
function aiagency_wez_uses_home_v1_chrome() {
	return aiagency_wez_is_home_v1_template() || aiagency_wez_is_content_page_template();
}

/**
 * Returns the page ID that owns the Home V1 chrome content.
 *
 * @return int
 */
function aiagency_wez_get_home_v1_page_id() {
	if ( aiagency_wez_is_home_v1_template() ) {
		return (int) get_queried_object_id();
	}

	$pages = get_posts(
		array(
			'post_type'              => 'page',
			'post_status'            => 'publish',
			'posts_per_page'         => 1,
			'fields'                 => 'ids',
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'meta_key'               => '_wp_page_template',
			'meta_value'             => 'page-templates/template-home-v1.php',
		)
	);

	if ( empty( $pages ) ) {
		return 0;
	}

	return (int) $pages[0];
}

/**
 * Returns the Home V1 page URL, with an optional fragment.
 *
 * @param string $fragment Optional in-page fragment without leading "#".
 * @return string
 */
function aiagency_wez_get_home_v1_page_url( $fragment = '' ) {
	$page_id = aiagency_wez_get_home_v1_page_id();
	$url     = $page_id > 0 ? get_permalink( $page_id ) : home_url( '/' );

	if ( ! is_string( $url ) || '' === $url ) {
		$url = home_url( '/' );
	}

	$fragment = is_string( $fragment ) ? ltrim( $fragment, '#' ) : '';

	if ( '' === $fragment ) {
		return $url;
	}

	return $url . '#' . $fragment;
}

/**
 * Normalizes a URL path to match assets/js/home-v1-smooth-nav.js (trailing slash stripped; root is "/").
 *
 * @param string $path Path from wp_parse_url( ..., PHP_URL_PATH ).
 * @return string
 */
function aiagency_wez_normalize_smooth_nav_path( $path ) {
	if ( ! is_string( $path ) || '' === $path ) {
		return '/';
	}
	$path   = '/' . ltrim( $path, '/' );
	$trimmed = untrailingslashit( $path );

	return '' === $trimmed ? '/' : $trimmed;
}

/**
 * Pathnames that refer to the current Home V1 page (permalink + front URL when this page is the static front page).
 *
 * Used so primary-menu links like /page-slug/#section still smooth-scroll when the visitor is already on /.
 *
 * @return string[]
 */
function aiagency_wez_home_v1_anchor_path_aliases() {
	$page_id = get_queried_object_id();
	if ( $page_id < 1 ) {
		return array();
	}

	$candidates = array();
	$permalink  = get_permalink( $page_id );
	if ( is_string( $permalink ) && '' !== $permalink ) {
		$p = wp_parse_url( $permalink, PHP_URL_PATH );
		if ( is_string( $p ) ) {
			$candidates[] = $p;
		}
	}

	$is_front = (int) get_option( 'page_on_front' ) === (int) $page_id;
	if ( $is_front ) {
		$home_p = wp_parse_url( home_url( '/' ), PHP_URL_PATH );
		if ( is_string( $home_p ) ) {
			$candidates[] = $home_p;
		}
		$candidates[] = '/';
	}

	$normalized = array();
	foreach ( $candidates as $c ) {
		$normalized[] = aiagency_wez_normalize_smooth_nav_path( $c );
	}

	return array_values( array_unique( $normalized ) );
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
		wp_localize_script(
			'aiagency-wez-home-v1-smooth-nav',
			'aiagencyWezSmoothNav',
			array(
				'p' => aiagency_wez_home_v1_anchor_path_aliases(),
			)
		);
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
	if ( is_admin() || ! aiagency_wez_uses_home_v1_chrome() ) {
		return;
	}

	$page_lang = aiagency_wez_get_page_language_code();

	wp_register_script( 'aiagency-wez-gtranslate-init', false, array(), null, true );
	wp_enqueue_script( 'aiagency-wez-gtranslate-init' );

	$init = sprintf(
		'function aiagencyWezGetGoogleTranslateSelect(){return document.querySelector(\'#google_translate_element .goog-te-combo\');}' .
		'function aiagencyWezPopulateFooterLanguageSwitcher(){var googleSelect=aiagencyWezGetGoogleTranslateSelect();var footerSwitcher=document.getElementById(\'site-footer-language-switcher\');if(!(googleSelect instanceof HTMLSelectElement)||!(footerSwitcher instanceof HTMLSelectElement)){return;}' .
		'var options=Array.from(googleSelect.options).filter(function(option){return option.value;});if(!options.length){return;}' .
		'if(footerSwitcher.options.length===options.length&&footerSwitcher.dataset.aiagencyWezPopulated===\'true\'){return;}' .
		'var currentValue=footerSwitcher.value;footerSwitcher.innerHTML=\'\';options.forEach(function(option){var nextOption=document.createElement(\'option\');nextOption.value=option.value;nextOption.textContent=option.textContent||option.innerText||option.value;footerSwitcher.appendChild(nextOption);});' .
		'footerSwitcher.dataset.aiagencyWezPopulated=\'true\';if(currentValue){footerSwitcher.value=currentValue;}}' .
		'function aiagencyWezReadGoogleTranslateLanguage(defaultLang){var match=document.cookie.match(/(?:^|; )googtrans=([^;]+)/);if(!match){return defaultLang;}' .
		'var parts=decodeURIComponent(match[1]).split(\'/\');return parts[parts.length-1]||defaultLang;}' .
		'function aiagencyWezSyncLanguageSwitchers(lang){document.querySelectorAll(\'[data-aiagency-wez-language-switcher]\').forEach(function(switcher){if(!(switcher instanceof HTMLSelectElement)){return;}var hasOption=Array.from(switcher.options).some(function(option){return option.value===lang;});if(hasOption&&switcher.value!==lang){switcher.value=lang;}});}' .
		'function aiagencyWezApplyGoogleTranslateLanguage(lang){var nextLang=typeof lang===\'string\'&&lang?lang:\'en\';var select=aiagencyWezGetGoogleTranslateSelect();if(!(select instanceof HTMLSelectElement)){window.setTimeout(function(){aiagencyWezApplyGoogleTranslateLanguage(nextLang);},250);return;}' .
		'if(select.value!==nextLang){select.value=nextLang;select.dispatchEvent(new Event(\'change\',{bubbles:true}));}' .
		'aiagencyWezSyncLanguageSwitchers(nextLang);}' .
		'function aiagencyWezBindGoogleTranslateSwitchers(defaultLang){if(window.aiagencyWezGoogleTranslateSwitchersBound){aiagencyWezSyncLanguageSwitchers(aiagencyWezReadGoogleTranslateLanguage(defaultLang));return;}' .
		'window.aiagencyWezGoogleTranslateSwitchersBound=true;' .
		'document.addEventListener(\'change\',function(event){if(event.target instanceof HTMLSelectElement&&event.target.matches(\'[data-aiagency-wez-language-switcher]\')){aiagencyWezApplyGoogleTranslateLanguage(event.target.value);}});' .
		'var syncControls=function(){var select=aiagencyWezGetGoogleTranslateSelect();if(select instanceof HTMLSelectElement&&!select.dataset.aiagencyWezBound){select.dataset.aiagencyWezBound=\'true\';select.addEventListener(\'change\',function(){aiagencyWezSyncLanguageSwitchers(select.value);});}' .
		'aiagencyWezPopulateFooterLanguageSwitcher();' .
		'aiagencyWezSyncLanguageSwitchers(aiagencyWezReadGoogleTranslateLanguage(defaultLang));};' .
		'window.setTimeout(syncControls,0);window.setTimeout(syncControls,300);window.setTimeout(syncControls,900);window.addEventListener(\'pageshow\',function(){aiagencyWezSyncLanguageSwitchers(aiagencyWezReadGoogleTranslateLanguage(defaultLang));});' .
		'aiagencyWezSyncLanguageSwitchers(aiagencyWezReadGoogleTranslateLanguage(defaultLang));}' .
		'function aiagencyWezGoogleTranslateInit(){if(typeof google===\'undefined\'||!google.translate||!document.getElementById(\'google_translate_element\')){return;}' .
		'new google.translate.TranslateElement({pageLanguage:\'%s\',autoDisplay:false},\'google_translate_element\');' .
		'aiagencyWezBindGoogleTranslateSwitchers(\'%s\');}',
		esc_js( $page_lang ),
		esc_js( 'vi' === $page_lang ? 'vi' : 'en' )
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

	if ( aiagency_wez_is_content_page_template() ) {
		$classes[] = 'aiagency-wez-content-page-template';
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
 * Inline SVG for Home V1 competency cards when no icon image is set.
 *
 * @param int $variant Optional icon variant.
 * @return string
 */
function aiagency_wez_home_v1_competency_default_icon_svg( $variant = 0 ) {
	$icons = array(
		'<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none" aria-hidden="true" focusable="false"><path d="M6.25 21.25l5.1-5.1 3.95 3.95 8.45-8.45" stroke="currentColor" stroke-width="2.35" stroke-linecap="round" stroke-linejoin="round"/><path d="M20.6 11.65h3.15v3.15" stroke="currentColor" stroke-width="2.35" stroke-linecap="round" stroke-linejoin="round"/><path d="M9.15 8.4l.7 1.55 1.55.7-1.55.7-.7 1.55-.7-1.55-1.55-.7 1.55-.7.7-1.55Z" fill="currentColor"/><path d="M15.95 5.65l.45.95.95.45-.95.45-.45.95-.45-.95-.95-.45.95-.45.45-.95Z" fill="currentColor"/></svg>',
		'<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none" aria-hidden="true" focusable="false"><path d="M12.2 5.75v3" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/><path d="M17.8 5.75v3" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/><path d="M8.65 8.15l2.1 2.1" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/><path d="M21.35 8.15l-2.1 2.1" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/><path d="M6.2 13.65h3" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/><path d="M20.8 13.65h3" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/><path d="M9.2 18.8a6.2 6.2 0 1 1 8.55 0" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/><path d="M11.2 23.15a3.8 3.8 0 0 1 7.6 0v1.1h-7.6v-1.1Z" stroke="currentColor" stroke-width="2.2" stroke-linejoin="round"/><circle cx="22.2" cy="21.8" r="2.2" stroke="currentColor" stroke-width="2.2"/><path d="M22.2 20.7v2.2" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/><path d="M21.1 21.8h2.2" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/></svg>',
		'<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none" aria-hidden="true" focusable="false"><circle cx="15" cy="6.4" r="2.65" stroke="currentColor" stroke-width="2.2"/><circle cx="7.2" cy="15" r="2.65" stroke="currentColor" stroke-width="2.2"/><circle cx="22.8" cy="15" r="2.65" stroke="currentColor" stroke-width="2.2"/><circle cx="10.15" cy="23.1" r="2.65" stroke="currentColor" stroke-width="2.2"/><circle cx="19.85" cy="23.1" r="2.65" stroke="currentColor" stroke-width="2.2"/><path d="M13.2 8.55 9 12.85" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/><path d="M16.8 8.55 21 12.85" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/><path d="M9.85 17.45 11.2 20.35" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/><path d="M20.15 17.45 18.8 20.35" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/><path d="M12.8 23.1h4.4" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/></svg>',
	);
	$variant = max( 0, (int) $variant );

	return $icons[ $variant % count( $icons ) ];
}
