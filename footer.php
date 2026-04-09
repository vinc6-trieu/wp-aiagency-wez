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
	$uses_home_v1_ui = function_exists( 'aiagency_wez_uses_home_v1_chrome' ) && aiagency_wez_uses_home_v1_chrome();
	$current_page_id = get_queried_object_id();
	$chrome_page_id  = function_exists( 'aiagency_wez_get_home_v1_page_id' ) ? aiagency_wez_get_home_v1_page_id() : $current_page_id;

	if ( $uses_home_v1_ui ) :
		$footer_linkedin_url = function_exists( 'get_field' ) ? get_field( 'home_v1_footer_social_linkedin_url', $chrome_page_id ) : '';
		$footer_address      = function_exists( 'get_field' ) ? get_field( 'home_v1_footer_address', $chrome_page_id ) : '';
		$footer_email_raw    = function_exists( 'get_field' ) ? get_field( 'home_v1_contact_email_value', $chrome_page_id ) : '';
		$footer_email        = '';
		$footer_map_url      = '';
		$footer_address      = is_string( $footer_address ) ? trim( $footer_address ) : '';
		$footer_email_raw    = is_string( $footer_email_raw ) ? trim( $footer_email_raw ) : '';
		$home_v1_section_links = array(
			'who-we-are'  => $is_home_v1 ? '#who-we-are' : ( function_exists( 'aiagency_wez_get_home_v1_page_url' ) ? aiagency_wez_get_home_v1_page_url( 'who-we-are' ) : home_url( '/#who-we-are' ) ),
			'our-projects' => $is_home_v1 ? '#our-projects' : ( function_exists( 'aiagency_wez_get_home_v1_page_url' ) ? aiagency_wez_get_home_v1_page_url( 'our-projects' ) : home_url( '/#our-projects' ) ),
			'contact-us'  => $is_home_v1 ? '#contact-us' : ( function_exists( 'aiagency_wez_get_home_v1_page_url' ) ? aiagency_wez_get_home_v1_page_url( 'contact-us' ) : home_url( '/#contact-us' ) ),
		);

		if ( $footer_email_raw ) {
			$footer_email = sanitize_email( $footer_email_raw );
		}

		if ( $footer_address ) {
			$footer_map_url = sprintf(
				'https://maps.google.com/maps?q=%s&z=15&output=embed',
				rawurlencode( $footer_address )
			);
		}

		$legal_links        = array();
		$privacy_policy_url = function_exists( 'get_privacy_policy_url' ) ? get_privacy_policy_url() : '';

		if ( is_string( $privacy_policy_url ) && '' !== $privacy_policy_url ) {
			$legal_links[] = array(
				'label' => __( 'Privacy Policy', 'aiagency-wez' ),
				'url'   => $privacy_policy_url,
			);
		}

		$legal_page_candidates = array(
			'terms-and-conditions' => __( 'Terms & Conditions', 'aiagency-wez' ),
			'terms-of-service'     => __( 'Terms of Service', 'aiagency-wez' ),
			'cookie-policy'        => __( 'Cookie Policy', 'aiagency-wez' ),
		);
		$legal_page_ids        = array();

		foreach ( $legal_page_candidates as $page_slug => $page_label ) {
			$legal_page = get_page_by_path( $page_slug );

			if ( ! ( $legal_page instanceof WP_Post ) || in_array( $legal_page->ID, $legal_page_ids, true ) ) {
				continue;
			}

			$legal_links[]    = array(
				'label' => $page_label,
				'url'   => get_permalink( $legal_page ),
			);
			$legal_page_ids[] = $legal_page->ID;
		}

		$footer_has_contact = $footer_email || $footer_linkedin_url || $footer_map_url;
		?>
		<footer class="site-footer site-footer--home-v1">
			<div class="site-footer__inner site-footer__inner--home-v1<?php echo $footer_has_contact ? '' : ' site-footer__inner--home-v1-no-contact'; ?>">
				<div class="site-footer__content">
					<div class="site-footer__menus">
						<div class="site-footer__menu-group">
							<p class="site-footer__menu-title"><?php esc_html_e( 'Explore', 'aiagency-wez' ); ?></p>
							<nav class="site-footer__nav" aria-label="<?php esc_attr_e( 'Explore', 'aiagency-wez' ); ?>">
								<?php
								wp_nav_menu(
									array(
										'theme_location' => 'primary',
										'container'      => false,
										'menu_class'     => 'site-footer__menu',
										'fallback_cb'    => false,
									)
								);
								?>
							</nav>
						</div>

						<div class="site-footer__menu-group">
							<p class="site-footer__menu-title"><?php esc_html_e( 'Connect', 'aiagency-wez' ); ?></p>
							<ul class="site-footer__menu">
								<li><a href="<?php echo esc_url( $home_v1_section_links['who-we-are'] ); ?>"><?php esc_html_e( 'Who We Are', 'aiagency-wez' ); ?></a></li>
								<li><a href="<?php echo esc_url( $home_v1_section_links['our-projects'] ); ?>"><?php esc_html_e( 'Projects', 'aiagency-wez' ); ?></a></li>
								<li><a href="<?php echo esc_url( $home_v1_section_links['contact-us'] ); ?>"><?php esc_html_e( 'Contact', 'aiagency-wez' ); ?></a></li>
							</ul>
						</div>

						<div class="site-footer__menu-group">
							<p class="site-footer__menu-title"><?php esc_html_e( 'Legal', 'aiagency-wez' ); ?></p>
							<ul class="site-footer__menu">
								<?php if ( $legal_links ) : ?>
									<?php foreach ( $legal_links as $legal_link ) : ?>
										<li><a href="<?php echo esc_url( $legal_link['url'] ); ?>"><?php echo esc_html( $legal_link['label'] ); ?></a></li>
									<?php endforeach; ?>
								<?php else : ?>
									<li class="site-footer__menu-note"><?php esc_html_e( 'All rights reserved.', 'aiagency-wez' ); ?></li>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>

				<?php if ( $footer_has_contact ) : ?>
					<div class="site-footer__meta">
						<div class="site-footer__contact-card">
							<p class="site-footer__contact-title"><?php esc_html_e( 'Contact', 'aiagency-wez' ); ?></p>

							<div class="site-footer__contact-items">
								<?php if ( $footer_email ) : ?>
									<div class="site-footer__contact-row">
										<span class="site-footer__contact-label"><?php esc_html_e( 'Email', 'aiagency-wez' ); ?></span>
										<a class="site-footer__contact-link" href="<?php echo esc_url( 'mailto:' . $footer_email ); ?>">
											<?php echo esc_html( antispambot( $footer_email ) ); ?>
										</a>
									</div>
								<?php endif; ?>

								<?php if ( $footer_linkedin_url ) : ?>
									<div class="site-footer__contact-row">
										<span class="site-footer__contact-label"><?php esc_html_e( 'LinkedIn', 'aiagency-wez' ); ?></span>
										<a class="site-footer__contact-link" href="<?php echo esc_url( $footer_linkedin_url ); ?>" target="_blank" rel="noreferrer noopener">
											<?php esc_html_e( 'Visit profile', 'aiagency-wez' ); ?>
										</a>
									</div>
								<?php endif; ?>
							</div>

							<?php if ( $footer_map_url ) : ?>
								<div class="site-footer__contact-map">
									<iframe
										src="<?php echo esc_url( $footer_map_url ); ?>"
										title="<?php echo esc_attr( $footer_address ); ?>"
										loading="lazy"
										referrerpolicy="no-referrer-when-downgrade"
										allowfullscreen
									></iframe>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>

				<div class="site-footer__utility">
					<p class="site-footer__legal">
						<?php
						printf(
							/* translators: %s: current year. */
							esc_html__( '© %s aiagency-wez. All rights reserved.', 'aiagency-wez' ),
							esc_html( gmdate( 'Y' ) )
						);
						?>
					</p>
					<?php if ( $uses_home_v1_ui ) : ?>
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
							<label class="screen-reader-text" for="site-footer-language-switcher"><?php esc_html_e( 'Change language', 'aiagency-wez' ); ?></label>
							<select
								id="site-footer-language-switcher"
								class="site-footer__translate-select home-v1-language-switcher"
								data-aiagency-wez-language-switcher
							>
								<option value="en"><?php esc_html_e( 'English', 'aiagency-wez' ); ?></option>
								<option value="vi"><?php esc_html_e( 'Vietnamese', 'aiagency-wez' ); ?></option>
							</select>
							<div
								id="google_translate_element"
								class="site-footer__translate-mount"
								aria-hidden="true"
							></div>
						</div>
					<?php endif; ?>
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
