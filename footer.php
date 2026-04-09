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
		$normalize_link_field = static function ( $value ) {
			if ( ! is_array( $value ) ) {
				return null;
			}

			$title = '';
			if ( isset( $value['title'] ) && is_string( $value['title'] ) ) {
				$title = trim( $value['title'] );
			} elseif ( isset( $value['label'] ) && is_string( $value['label'] ) ) {
				$title = trim( $value['label'] );
			}
			$url   = isset( $value['url'] ) && is_string( $value['url'] ) ? trim( $value['url'] ) : '';

			if ( '' === $title || '' === $url ) {
				return null;
			}

			return array(
				'title'  => $title,
				'url'    => $url,
				'target' => isset( $value['target'] ) && is_string( $value['target'] ) && '' !== $value['target'] ? $value['target'] : '',
			);
		};
		$normalize_link_rows = static function ( $rows ) use ( $normalize_link_field ) {
			if ( ! is_array( $rows ) ) {
				return array();
			}

			$links = array();

			foreach ( $rows as $row ) {
				$link_item = $normalize_link_field( $row );

				if ( $link_item ) {
					$links[] = $link_item;
				}
			}

			return $links;
		};

		$footer_copy                 = function_exists( 'get_field' ) ? get_field( 'home_v1_footer_copy', $chrome_page_id ) : '';
		$footer_nav_primary_heading  = function_exists( 'get_field' ) ? get_field( 'home_v1_footer_nav_primary_heading', $chrome_page_id ) : '';
		$footer_nav_secondary_heading = function_exists( 'get_field' ) ? get_field( 'home_v1_footer_nav_secondary_heading', $chrome_page_id ) : '';
		$footer_legal_heading        = function_exists( 'get_field' ) ? get_field( 'home_v1_footer_legal_heading', $chrome_page_id ) : '';
		$footer_linkedin_url         = function_exists( 'get_field' ) ? get_field( 'home_v1_footer_social_linkedin_url', $chrome_page_id ) : '';
		$footer_instagram_url        = function_exists( 'get_field' ) ? get_field( 'home_v1_footer_social_instagram_url', $chrome_page_id ) : '';
		$footer_address              = function_exists( 'get_field' ) ? get_field( 'home_v1_footer_address', $chrome_page_id ) : '';
		$footer_contact_title        = function_exists( 'get_field' ) ? get_field( 'home_v1_footer_contact_title', $chrome_page_id ) : '';
		$contact_section_title       = function_exists( 'get_field' ) ? get_field( 'home_v1_contact_title', $chrome_page_id ) : '';
		$footer_phone_label          = function_exists( 'get_field' ) ? get_field( 'home_v1_contact_phone_label', $chrome_page_id ) : '';
		$footer_phone_value          = function_exists( 'get_field' ) ? get_field( 'home_v1_contact_phone_value', $chrome_page_id ) : '';
		$footer_email_label          = function_exists( 'get_field' ) ? get_field( 'home_v1_contact_email_label', $chrome_page_id ) : '';
		$footer_email_raw            = function_exists( 'get_field' ) ? get_field( 'home_v1_contact_email_value', $chrome_page_id ) : '';
		$footer_email                = '';
		$footer_map_url              = '';
		$footer_copy                 = is_string( $footer_copy ) ? trim( $footer_copy ) : '';
		$footer_nav_primary_heading  = is_string( $footer_nav_primary_heading ) ? trim( $footer_nav_primary_heading ) : '';
		$footer_nav_secondary_heading = is_string( $footer_nav_secondary_heading ) ? trim( $footer_nav_secondary_heading ) : '';
		$footer_legal_heading        = is_string( $footer_legal_heading ) ? trim( $footer_legal_heading ) : '';
		$footer_linkedin_url         = is_string( $footer_linkedin_url ) ? trim( $footer_linkedin_url ) : '';
		$footer_instagram_url        = is_string( $footer_instagram_url ) ? trim( $footer_instagram_url ) : '';
		$footer_address              = is_string( $footer_address ) ? trim( $footer_address ) : '';
		$footer_contact_title        = is_string( $footer_contact_title ) ? trim( $footer_contact_title ) : '';
		$contact_section_title       = is_string( $contact_section_title ) ? trim( $contact_section_title ) : '';
		$footer_phone_label          = is_string( $footer_phone_label ) ? trim( $footer_phone_label ) : '';
		$footer_phone_value          = is_string( $footer_phone_value ) ? trim( $footer_phone_value ) : '';
		$footer_email_label          = is_string( $footer_email_label ) ? trim( $footer_email_label ) : '';
		$footer_email_raw            = is_string( $footer_email_raw ) ? trim( $footer_email_raw ) : '';
		$home_v1_section_links = array(
			'who-we-are'  => $is_home_v1 ? '#who-we-are' : ( function_exists( 'aiagency_wez_get_home_v1_page_url' ) ? aiagency_wez_get_home_v1_page_url( 'who-we-are' ) : home_url( '/#who-we-are' ) ),
			'our-projects' => $is_home_v1 ? '#our-projects' : ( function_exists( 'aiagency_wez_get_home_v1_page_url' ) ? aiagency_wez_get_home_v1_page_url( 'our-projects' ) : home_url( '/#our-projects' ) ),
			'contact-us'  => $is_home_v1 ? '#contact-us' : ( function_exists( 'aiagency_wez_get_home_v1_page_url' ) ? aiagency_wez_get_home_v1_page_url( 'contact-us' ) : home_url( '/#contact-us' ) ),
		);
		$footer_secondary_links = $normalize_link_rows( function_exists( 'get_field' ) ? get_field( 'home_v1_footer_secondary_links', $chrome_page_id ) : array() );
		$footer_legal_custom_links = $normalize_link_rows( function_exists( 'get_field' ) ? get_field( 'home_v1_footer_legal_links', $chrome_page_id ) : array() );

		if ( $footer_email_raw ) {
			$footer_email = sanitize_email( $footer_email_raw );
		}

		if ( empty( $footer_secondary_links ) ) {
			for ( $index = 1; $index <= 3; $index++ ) {
				$field_name = 'home_v1_footer_secondary_link_' . $index;
				$link_value = function_exists( 'get_field' ) ? get_field( $field_name, $chrome_page_id ) : null;
				$link_item  = $normalize_link_field( $link_value );

				if ( $link_item ) {
					$footer_secondary_links[] = $link_item;
				}
			}
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

		if ( empty( $footer_legal_custom_links ) ) {
			for ( $index = 1; $index <= 4; $index++ ) {
				$field_name = 'home_v1_footer_legal_link_' . $index;
				$link_value = function_exists( 'get_field' ) ? get_field( $field_name, $chrome_page_id ) : null;
				$link_item  = $normalize_link_field( $link_value );

				if ( $link_item ) {
					$footer_legal_custom_links[] = $link_item;
				}
			}
		}

		if ( $footer_secondary_links ) {
			$home_v1_section_links = $footer_secondary_links;
		}

		if ( $footer_legal_custom_links ) {
			$legal_links = array_map(
				static function ( $link_item ) {
					return array(
						'label'  => $link_item['title'],
						'url'    => $link_item['url'],
						'target' => $link_item['target'],
					);
				},
				$footer_legal_custom_links
			);
		}

		$footer_has_contact = $footer_email || $footer_phone_value || $footer_linkedin_url || $footer_instagram_url || $footer_map_url;
		?>
		<footer class="site-footer site-footer--home-v1">
			<div class="site-footer__inner site-footer__inner--home-v1<?php echo $footer_has_contact ? '' : ' site-footer__inner--home-v1-no-contact'; ?>">
				<div class="site-footer__content">
					<?php if ( $footer_copy ) : ?>
						<p class="site-footer__copy"><?php echo esc_html( $footer_copy ); ?></p>
					<?php endif; ?>

					<div class="site-footer__menus">
						<div class="site-footer__menu-group">
							<p class="site-footer__menu-title"><?php echo esc_html( $footer_nav_primary_heading ?: __( 'Explore', 'aiagency-wez' ) ); ?></p>
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
							<p class="site-footer__menu-title"><?php echo esc_html( $footer_nav_secondary_heading ?: __( 'Connect', 'aiagency-wez' ) ); ?></p>
							<ul class="site-footer__menu">
								<?php if ( isset( $home_v1_section_links['who-we-are'] ) ) : ?>
									<li><a href="<?php echo esc_url( $home_v1_section_links['who-we-are'] ); ?>"><?php esc_html_e( 'Who We Are', 'aiagency-wez' ); ?></a></li>
									<li><a href="<?php echo esc_url( $home_v1_section_links['our-projects'] ); ?>"><?php esc_html_e( 'Projects', 'aiagency-wez' ); ?></a></li>
									<li><a href="<?php echo esc_url( $home_v1_section_links['contact-us'] ); ?>"><?php esc_html_e( 'Contact', 'aiagency-wez' ); ?></a></li>
								<?php else : ?>
									<?php foreach ( $home_v1_section_links as $footer_link ) : ?>
										<li>
											<a
												href="<?php echo esc_url( $footer_link['url'] ); ?>"
												<?php echo ! empty( $footer_link['target'] ) ? ' target="' . esc_attr( $footer_link['target'] ) . '" rel="noreferrer noopener"' : ''; ?>
											>
												<?php echo esc_html( $footer_link['title'] ); ?>
											</a>
										</li>
									<?php endforeach; ?>
								<?php endif; ?>
							</ul>
						</div>

						<div class="site-footer__menu-group">
							<p class="site-footer__menu-title"><?php echo esc_html( $footer_legal_heading ?: __( 'Legal', 'aiagency-wez' ) ); ?></p>
							<ul class="site-footer__menu">
								<?php if ( $legal_links ) : ?>
									<?php foreach ( $legal_links as $legal_link ) : ?>
										<li>
											<a
												href="<?php echo esc_url( $legal_link['url'] ); ?>"
												<?php echo ! empty( $legal_link['target'] ) ? ' target="' . esc_attr( $legal_link['target'] ) . '" rel="noreferrer noopener"' : ''; ?>
											>
												<?php echo esc_html( $legal_link['label'] ); ?>
											</a>
										</li>
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
							<p class="site-footer__contact-title"><?php echo esc_html( $footer_contact_title ?: $contact_section_title ?: __( 'Contact', 'aiagency-wez' ) ); ?></p>

							<div class="site-footer__contact-items">
								<?php if ( $footer_phone_value ) : ?>
									<div class="site-footer__contact-row">
										<span class="site-footer__contact-label"><?php echo esc_html( $footer_phone_label ?: __( 'Phone', 'aiagency-wez' ) ); ?></span>
										<a class="site-footer__contact-link" href="<?php echo esc_url( 'tel:' . preg_replace( '/[^0-9+]/', '', $footer_phone_value ) ); ?>">
											<?php echo esc_html( $footer_phone_value ); ?>
										</a>
									</div>
								<?php endif; ?>

								<?php if ( $footer_email ) : ?>
									<div class="site-footer__contact-row">
										<span class="site-footer__contact-label"><?php echo esc_html( $footer_email_label ?: __( 'Email', 'aiagency-wez' ) ); ?></span>
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
					<?php if ( $footer_linkedin_url || $footer_instagram_url ) : ?>
						<div class="site-footer__socials" aria-label="<?php esc_attr_e( 'Social links', 'aiagency-wez' ); ?>">
							<?php if ( $footer_linkedin_url ) : ?>
								<a class="site-footer__social-link" href="<?php echo esc_url( $footer_linkedin_url ); ?>" target="_blank" rel="noreferrer noopener" aria-label="<?php esc_attr_e( 'LinkedIn', 'aiagency-wez' ); ?>">
									<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
										<path d="M6.94 8.5H3.56V20h3.38V8.5ZM5.25 3A1.97 1.97 0 1 0 5.3 6.94 1.97 1.97 0 0 0 5.25 3ZM20.44 12.56c0-3.46-1.84-5.06-4.3-5.06-1.98 0-2.87 1.09-3.37 1.86V8.5H9.4c.04.57 0 11.5 0 11.5h3.37v-6.42c0-.34.03-.68.13-.92.27-.68.88-1.38 1.91-1.38 1.35 0 1.89 1.03 1.89 2.54V20H20V13.4c0-.35.44-.84.44-.84Z"/>
									</svg>
								</a>
							<?php endif; ?>
							<?php if ( $footer_instagram_url ) : ?>
								<a class="site-footer__social-link" href="<?php echo esc_url( $footer_instagram_url ); ?>" target="_blank" rel="noreferrer noopener" aria-label="<?php esc_attr_e( 'Instagram', 'aiagency-wez' ); ?>">
									<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
										<path d="M7.75 3h8.5A4.75 4.75 0 0 1 21 7.75v8.5A4.75 4.75 0 0 1 16.25 21h-8.5A4.75 4.75 0 0 1 3 16.25v-8.5A4.75 4.75 0 0 1 7.75 3Zm0 1.75A3 3 0 0 0 4.75 7.75v8.5a3 3 0 0 0 3 3h8.5a3 3 0 0 0 3-3v-8.5a3 3 0 0 0-3-3h-8.5Zm8.88 1.31a1.06 1.06 0 1 1 0 2.13 1.06 1.06 0 0 1 0-2.13ZM12 7.5A4.5 4.5 0 1 1 7.5 12 4.5 4.5 0 0 1 12 7.5Zm0 1.75A2.75 2.75 0 1 0 14.75 12 2.75 2.75 0 0 0 12 9.25Z"/>
									</svg>
								</a>
							<?php endif; ?>
						</div>
					<?php endif; ?>
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
