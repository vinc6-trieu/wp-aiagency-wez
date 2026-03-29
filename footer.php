<?php
/**
 * Theme footer.
 *
 * @package aiagency-wez
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	</main>

	<?php
	$is_home_v1      = function_exists( 'aiagency_wez_is_home_v1_template' ) && aiagency_wez_is_home_v1_template();
	$current_page_id = get_queried_object_id();

	if ( $is_home_v1 ) :
		$footer_copy              = function_exists( 'get_field' ) ? get_field( 'home_v1_footer_copy', $current_page_id ) : '';
		$footer_primary_heading   = function_exists( 'get_field' ) ? get_field( 'home_v1_footer_nav_primary_heading', $current_page_id ) : '';
		$footer_secondary_heading = function_exists( 'get_field' ) ? get_field( 'home_v1_footer_nav_secondary_heading', $current_page_id ) : '';
		$footer_linkedin_url      = function_exists( 'get_field' ) ? get_field( 'home_v1_footer_social_linkedin_url', $current_page_id ) : '';
		$footer_instagram_url     = function_exists( 'get_field' ) ? get_field( 'home_v1_footer_social_instagram_url', $current_page_id ) : '';
		$footer_copy              = $footer_copy ? $footer_copy : __( 'AI-powered ecosystems that connect knowledge, operations, and customer experience into one intelligent business layer.', 'aiagency-wez' );
		$footer_primary_heading   = $footer_primary_heading ? $footer_primary_heading : __( 'Navigation', 'aiagency-wez' );
		$footer_secondary_heading = $footer_secondary_heading ? $footer_secondary_heading : __( 'Sections', 'aiagency-wez' );
		?>
		<footer class="site-footer site-footer--home-v1">
			<div class="site-footer__inner site-footer__inner--home-v1">
				<div class="site-footer__brand">
					<p class="site-footer__logo">
						<a class="site-branding__link" href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php echo wp_kses_post( aiagency_wez_get_site_logo_img_html() ); ?>
						</a>
					</p>
					<p class="site-footer__copy"><?php echo esc_html( $footer_copy ); ?></p>
				</div>

				<div class="site-footer__menus">
					<div class="site-footer__menu-group">
						<p class="site-footer__menu-title"><?php echo esc_html( $footer_primary_heading ); ?></p>
						<nav class="site-footer__nav" aria-label="<?php echo esc_attr( $footer_primary_heading ); ?>">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'primary',
									'container'      => false,
									'menu_class'     => 'site-footer__menu',
									'fallback_cb'    => 'wp_page_menu',
								)
							);
							?>
						</nav>
					</div>

					<div class="site-footer__menu-group">
						<p class="site-footer__menu-title"><?php echo esc_html( $footer_secondary_heading ); ?></p>
						<ul class="site-footer__menu">
							<li><a href="#core-competencies"><?php esc_html_e( 'Competencies', 'aiagency-wez' ); ?></a></li>
							<li><a href="#our-projects"><?php esc_html_e( 'Projects', 'aiagency-wez' ); ?></a></li>
							<li><a href="#who-we-are"><?php esc_html_e( 'Who We Are', 'aiagency-wez' ); ?></a></li>
							<li><a href="#contact-us"><?php esc_html_e( 'Contact', 'aiagency-wez' ); ?></a></li>
						</ul>
					</div>
				</div>

				<div class="site-footer__meta">
					<div
						class="site-footer__translate"
						role="navigation"
						aria-label="<?php esc_attr_e( 'Choose site language (Google Translate)', 'aiagency-wez' ); ?>"
					>
						<span class="site-footer__translate-icon" aria-hidden="true">
							<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" focusable="false">
								<circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" />
								<path d="M2 12h20M12 2a15 15 0 0 1 4 10 15 15 0 0 1-4 10 15 15 0 0 1-4-10 15 15 0 0 1 4-10" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
							</svg>
						</span>
						<div
							id="google_translate_element"
							class="site-footer__translate-mount"
						></div>
					</div>

					<div class="site-footer__socials">
						<?php if ( $footer_linkedin_url ) : ?>
							<a class="site-footer__social-link" href="<?php echo esc_url( $footer_linkedin_url ); ?>" aria-label="<?php esc_attr_e( 'LinkedIn', 'aiagency-wez' ); ?>">
								<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
									<path d="M6.94 8.5H3.56V20h3.38zm.22-5.03A1.97 1.97 0 0 0 5.2 1.5a1.97 1.97 0 0 0-1.94 1.97A1.94 1.94 0 0 0 5.2 5.41a1.94 1.94 0 0 0 1.96-1.94M20.74 20v-6.31c0-3.38-1.8-4.95-4.2-4.95-1.94 0-2.8 1.07-3.28 1.82V8.5H9.88c.05 1.36 0 11.5 0 11.5h3.38v-6.42c0-.34.02-.69.13-.93.27-.68.88-1.38 1.9-1.38 1.34 0 1.88 1.03 1.88 2.54V20z"/>
								</svg>
							</a>
						<?php endif; ?>

						<?php if ( $footer_instagram_url ) : ?>
							<a class="site-footer__social-link" href="<?php echo esc_url( $footer_instagram_url ); ?>" aria-label="<?php esc_attr_e( 'Instagram', 'aiagency-wez' ); ?>">
								<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
									<path d="M7.5 2h9A5.51 5.51 0 0 1 22 7.5v9a5.51 5.51 0 0 1-5.5 5.5h-9A5.51 5.51 0 0 1 2 16.5v-9A5.51 5.51 0 0 1 7.5 2m0 1.8A3.7 3.7 0 0 0 3.8 7.5v9a3.7 3.7 0 0 0 3.7 3.7h9a3.7 3.7 0 0 0 3.7-3.7v-9a3.7 3.7 0 0 0-3.7-3.7zm9.45 1.35a1.1 1.1 0 1 1-1.1 1.1 1.1 1.1 0 0 1 1.1-1.1M12 6.86A5.14 5.14 0 1 1 6.86 12 5.14 5.14 0 0 1 12 6.86m0 1.8A3.34 3.34 0 1 0 15.34 12 3.34 3.34 0 0 0 12 8.66"/>
								</svg>
							</a>
						<?php endif; ?>
					</div>

					<p class="site-footer__legal">
						<?php
						printf(
							/* translators: %s: current year. */
							esc_html__( '© %s aiagency-wez. All rights reserved.', 'aiagency-wez' ),
							esc_html( gmdate( 'Y' ) )
						);
						?>
					</p>
				</div>
			</div>
		</footer>
	<?php else : ?>
		<footer class="site-footer">
			<div class="site-footer__inner">
				<p>
					<?php
					printf(
						/* translators: %s: current year. */
						esc_html__( '© %s aiagency-wez. Built for Local development.', 'aiagency-wez' ),
						esc_html( gmdate( 'Y' ) )
					);
					?>
				</p>
			</div>
		</footer>
	<?php endif; ?>
</div>

<?php wp_footer(); ?>
</body>
</html>
