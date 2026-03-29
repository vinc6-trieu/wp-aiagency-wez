<?php
/**
 * Home V1 contact section.
 *
 * @package aiagency-wez
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	$args,
	array(
		'title'          => '',
		'description'    => '',
		'phone_label'    => '',
		'phone_value'    => '',
		'email_label'    => '',
		'email_value'    => '',
		'form_shortcode' => '',
	)
);

$phone_href = '';
if ( ! empty( $args['phone_value'] ) ) {
	$phone_href = preg_replace( '/[^0-9+]/', '', $args['phone_value'] );
}

$shortcode_output = '';
if ( ! empty( $args['form_shortcode'] ) && is_string( $args['form_shortcode'] ) ) {
	$shortcode_output = do_shortcode( trim( $args['form_shortcode'] ) );
}
?>

<section id="contact-us" class="home-v1-section home-v1-section--contact">
	<div class="home-v1-shell home-v1-contact">
		<div class="home-v1-contact__info">
			<?php if ( $args['title'] ) : ?>
				<h2><?php echo esc_html( $args['title'] ); ?></h2>
			<?php endif; ?>

			<?php if ( $args['description'] ) : ?>
				<p class="home-v1-contact__description"><?php echo esc_html( $args['description'] ); ?></p>
			<?php endif; ?>

			<div class="home-v1-contact__methods">
				<?php if ( $args['phone_label'] || $args['phone_value'] ) : ?>
					<div class="home-v1-contact__method">
						<span class="home-v1-contact__icon" aria-hidden="true">
							<svg viewBox="0 0 24 24" focusable="false">
								<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07A19.5 19.5 0 0 1 5.15 12.8 19.8 19.8 0 0 1 2.08 4.09 2 2 0 0 1 4.06 2h3a2 2 0 0 1 2 1.72c.12.9.34 1.78.65 2.62a2 2 0 0 1-.45 2.11L8 9.91a16 16 0 0 0 6.09 6.09l1.46-1.26a2 2 0 0 1 2.11-.45c.84.31 1.72.53 2.62.65A2 2 0 0 1 22 16.92"/>
							</svg>
						</span>
						<div>
							<?php if ( $args['phone_label'] ) : ?>
								<p class="home-v1-contact__label"><?php echo esc_html( $args['phone_label'] ); ?></p>
							<?php endif; ?>
							<?php if ( $args['phone_value'] ) : ?>
								<?php if ( $phone_href ) : ?>
									<a href="tel:<?php echo esc_attr( $phone_href ); ?>"><?php echo esc_html( $args['phone_value'] ); ?></a>
								<?php else : ?>
									<span><?php echo esc_html( $args['phone_value'] ); ?></span>
								<?php endif; ?>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( $args['email_label'] || $args['email_value'] ) : ?>
					<div class="home-v1-contact__method">
						<span class="home-v1-contact__icon" aria-hidden="true">
							<svg viewBox="0 0 24 24" focusable="false">
								<path d="M4 4h16a2 2 0 0 1 2 2v.4l-10 6.67L2 6.4V6a2 2 0 0 1 2-2m18 4.4V18a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8.4l10 6.67z"/>
							</svg>
						</span>
						<div>
							<?php if ( $args['email_label'] ) : ?>
								<p class="home-v1-contact__label"><?php echo esc_html( $args['email_label'] ); ?></p>
							<?php endif; ?>
							<?php if ( $args['email_value'] ) : ?>
								<a href="mailto:<?php echo antispambot( esc_attr( $args['email_value'] ) ); ?>"><?php echo esc_html( $args['email_value'] ); ?></a>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="home-v1-form-shell">
			<?php if ( $shortcode_output ) : ?>
				<?php echo $shortcode_output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php else : ?>
				<div class="home-v1-form-placeholder">
					<div class="home-v1-form-placeholder__row">
						<div>
							<label><?php esc_html_e( 'Full Name', 'aiagency-wez' ); ?></label>
							<span><?php esc_html_e( 'John Doe', 'aiagency-wez' ); ?></span>
						</div>
						<div>
							<label><?php esc_html_e( 'Work Email', 'aiagency-wez' ); ?></label>
							<span><?php esc_html_e( 'john@company.com', 'aiagency-wez' ); ?></span>
						</div>
					</div>
					<div>
						<label><?php esc_html_e( 'Area of Interest', 'aiagency-wez' ); ?></label>
						<span><?php esc_html_e( 'Select a service', 'aiagency-wez' ); ?></span>
					</div>
					<div>
						<label><?php esc_html_e( 'Message', 'aiagency-wez' ); ?></label>
						<span><?php esc_html_e( 'Add a form shortcode in ACF to render your live form here.', 'aiagency-wez' ); ?></span>
					</div>
					<div class="home-v1-form-placeholder__submit">
						<?php esc_html_e( 'SEND MESSAGE', 'aiagency-wez' ); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
