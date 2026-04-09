<?php
/**
 * Theme header.
 *
 * @package aiagency-wez
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="screen-reader-text" href="#main-content"><?php esc_html_e( 'Skip to content', 'aiagency-wez' ); ?></a>

<div class="site-wrapper">
	<?php
	$is_home_v1      = function_exists( 'aiagency_wez_is_home_v1_template' ) && aiagency_wez_is_home_v1_template();
	$uses_home_v1_ui = function_exists( 'aiagency_wez_uses_home_v1_chrome' ) && aiagency_wez_uses_home_v1_chrome();
	$home_url        = home_url( '/' );
	$current_page_id = get_queried_object_id();

	if ( $uses_home_v1_ui ) :
		$header_cta_text = function_exists( 'get_field' ) ? get_field( 'home_v1_header_cta_text', $current_page_id ) : '';
		$header_cta_url  = function_exists( 'get_field' ) ? get_field( 'home_v1_header_cta_url', $current_page_id ) : '';
		?>
		<header class="site-header site-header--home-v1">
			<div class="site-header__inner site-header__inner--home-v1">
				<div class="site-branding site-branding--home-v1">
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-branding__title">
							<a class="site-branding__link" href="<?php echo esc_url( $home_url ); ?>">
								<?php echo wp_kses_post( aiagency_wez_get_site_logo_img_html() ); ?>
							</a>
						</h1>
					<?php else : ?>
						<p class="site-branding__title">
							<a class="site-branding__link" href="<?php echo esc_url( $home_url ); ?>">
								<?php echo wp_kses_post( aiagency_wez_get_site_logo_img_html() ); ?>
							</a>
						</p>
					<?php endif; ?>
				</div>

				<button
					type="button"
					class="site-header__menu-toggle"
					aria-expanded="false"
					aria-controls="site-header-primary-menu"
				>
					<span class="site-header__menu-toggle-box" aria-hidden="true">
						<span class="site-header__menu-toggle-bar"></span>
						<span class="site-header__menu-toggle-bar"></span>
						<span class="site-header__menu-toggle-bar"></span>
					</span>
					<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'aiagency-wez' ); ?></span>
				</button>

				<div id="site-header-primary-menu" class="site-header__menu-panel">
					<div class="site-header__nav-group">
						<nav class="main-navigation main-navigation--home-v1" aria-label="<?php esc_attr_e( 'Primary Menu', 'aiagency-wez' ); ?>">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'primary',
									'container'      => false,
									'fallback_cb'    => 'wp_page_menu',
								)
							);
							?>
						</nav>

						<?php if ( $header_cta_text && $header_cta_url ) : ?>
							<a class="site-header__cta" href="<?php echo esc_url( $header_cta_url ); ?>">
								<?php echo esc_html( $header_cta_text ); ?>
							</a>
						<?php endif; ?>

						<?php if ( $is_home_v1 ) : ?>
							<div
								class="site-header__translate site-footer__translate"
								role="navigation"
								aria-label="<?php esc_attr_e( 'Choose site language (Google Translate)', 'aiagency-wez' ); ?>"
							>
								<span class="site-header__translate-icon site-footer__translate-icon" aria-hidden="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" focusable="false">
										<circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" />
										<path d="M2 12h20M12 2a15 15 0 0 1 4 10 15 15 0 0 1-4 10 15 15 0 0 1-4-10 15 15 0 0 1 4-10" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
									</svg>
								</span>
								<label class="screen-reader-text" for="site-header-language-switcher"><?php esc_html_e( 'Change language', 'aiagency-wez' ); ?></label>
								<select
									id="site-header-language-switcher"
									class="site-header__translate-select home-v1-language-switcher"
									data-aiagency-wez-language-switcher
								>
									<option value="en"><?php esc_html_e( 'English', 'aiagency-wez' ); ?></option>
									<option value="vi"><?php esc_html_e( 'Vietnamese', 'aiagency-wez' ); ?></option>
								</select>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</header>
	<?php else : ?>
		<header class="site-header">
			<div class="site-header__inner">
				<div class="site-branding">
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-branding__title">
							<a class="site-branding__link" href="<?php echo esc_url( $home_url ); ?>">
								<?php echo wp_kses_post( aiagency_wez_get_site_logo_img_html() ); ?>
							</a>
						</h1>
					<?php else : ?>
						<p class="site-branding__title">
							<a class="site-branding__link" href="<?php echo esc_url( $home_url ); ?>">
								<?php echo wp_kses_post( aiagency_wez_get_site_logo_img_html() ); ?>
							</a>
						</p>
					<?php endif; ?>

					<?php $description = get_bloginfo( 'description', 'display' ); ?>
					<?php if ( $description ) : ?>
						<p class="site-branding__tagline"><?php echo esc_html( $description ); ?></p>
					<?php endif; ?>
				</div>

				<button
					type="button"
					class="site-header__menu-toggle"
					aria-expanded="false"
					aria-controls="site-header-primary-menu"
				>
					<span class="site-header__menu-toggle-box" aria-hidden="true">
						<span class="site-header__menu-toggle-bar"></span>
						<span class="site-header__menu-toggle-bar"></span>
						<span class="site-header__menu-toggle-bar"></span>
					</span>
					<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'aiagency-wez' ); ?></span>
				</button>

				<div id="site-header-primary-menu" class="site-header__menu-panel">
					<nav class="main-navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'aiagency-wez' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'container'      => false,
								'fallback_cb'    => 'wp_page_menu',
							)
						);
						?>
					</nav>
				</div>
			</div>
		</header>
	<?php endif; ?>

	<main id="main-content" class="site-main">
