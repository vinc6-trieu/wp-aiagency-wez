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
		'eyebrow'           => '',
		'visual_image'      => array(),
		'status_kicker'     => '',
		'status_line'       => '',
		'status_badge'      => '',
		'title'             => '',
		'description'       => '',
		'form_shortcode'    => '',
	)
);

$visual = is_array( $args['visual_image'] ) ? $args['visual_image'] : array();

$shortcode_output = '';
if ( ! empty( $args['form_shortcode'] ) && is_string( $args['form_shortcode'] ) ) {
	$shortcode_output = do_shortcode( trim( $args['form_shortcode'] ) );
}

$status_kicker = is_string( $args['status_kicker'] ) ? trim( $args['status_kicker'] ) : '';
$status_line   = is_string( $args['status_line'] ) ? trim( $args['status_line'] ) : '';
$status_badge  = is_string( $args['status_badge'] ) ? trim( $args['status_badge'] ) : '';

if ( $status_kicker === '' ) {
	$status_kicker = __( 'System status', 'aiagency-wez' );
}
if ( $status_line === '' ) {
	$status_line = __( 'Agent is online', 'aiagency-wez' );
}
if ( $status_badge === '' ) {
	$status_badge = __( 'Stable', 'aiagency-wez' );
}
?>

<section id="contact-us" class="home-v1-section home-v1-section--contact">
	<div class="home-v1-shell home-v1-contact">
		<div class="home-v1-contact__visual">
			<div class="home-v1-contact__visual-inner">
				<div class="home-v1-contact__visual-card">
					<div class="home-v1-contact__visual-photo">
						<?php if ( ! empty( $visual['url'] ) ) : ?>
							<img src="<?php echo esc_url( $visual['url'] ); ?>" alt="<?php echo esc_attr( $visual['alt'] ); ?>" loading="lazy" decoding="async">
						<?php else : ?>
							<div class="home-v1-contact__visual-placeholder" aria-hidden="true"></div>
						<?php endif; ?>

						<div class="home-v1-contact__status">
							<div class="home-v1-contact__status-copy">
								<p class="home-v1-contact__status-kicker"><?php echo esc_html( $status_kicker ); ?></p>
								<p class="home-v1-contact__status-line"><?php echo esc_html( $status_line ); ?></p>
							</div>
							<div class="home-v1-contact__status-badge">
								<span class="home-v1-contact__status-dot" aria-hidden="true"></span>
								<span class="home-v1-contact__status-badge-text"><?php echo esc_html( $status_badge ); ?></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="home-v1-contact__column">
			<div class="home-v1-contact__intro">
				<?php if ( ! empty( $args['eyebrow'] ) ) : ?>
					<p class="home-v1-contact__eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></p>
				<?php endif; ?>

				<?php if ( ! empty( $args['title'] ) ) : ?>
					<h2 class="home-v1-contact__title"><?php echo esc_html( $args['title'] ); ?></h2>
				<?php endif; ?>

				<?php if ( ! empty( $args['description'] ) ) : ?>
					<p class="home-v1-contact__description"><?php echo esc_html( $args['description'] ); ?></p>
				<?php endif; ?>
			</div>

			<div class="home-v1-form-shell home-v1-form-shell--contact">
				<?php if ( $shortcode_output ) : ?>
					<?php echo $shortcode_output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<?php else : ?>
					<div class="home-v1-form-placeholder home-v1-form-placeholder--contact">
						<div class="home-v1-form-placeholder__row">
							<div class="home-v1-form-placeholder__field">
								<label><?php esc_html_e( 'Full Name', 'aiagency-wez' ); ?></label>
								<span><?php esc_html_e( 'John Doe', 'aiagency-wez' ); ?></span>
							</div>
							<div class="home-v1-form-placeholder__field">
								<label><?php esc_html_e( 'Work Email', 'aiagency-wez' ); ?></label>
								<span><?php esc_html_e( 'john@company.com', 'aiagency-wez' ); ?></span>
							</div>
						</div>
						<div class="home-v1-form-placeholder__row">
							<div class="home-v1-form-placeholder__field">
								<label><?php esc_html_e( 'Company', 'aiagency-wez' ); ?></label>
								<span><?php esc_html_e( 'Acme Corp', 'aiagency-wez' ); ?></span>
							</div>
							<div class="home-v1-form-placeholder__field">
								<label><?php esc_html_e( 'Phone Number', 'aiagency-wez' ); ?></label>
								<span><?php esc_html_e( '+1 (555) 000-0000', 'aiagency-wez' ); ?></span>
							</div>
						</div>
						<div class="home-v1-form-placeholder__field home-v1-form-placeholder__field--full">
							<label><?php esc_html_e( 'Message', 'aiagency-wez' ); ?></label>
							<span class="home-v1-form-placeholder__message"><?php esc_html_e( 'Tell us about your AI goals…', 'aiagency-wez' ); ?></span>
						</div>
						<div class="home-v1-form-placeholder__actions">
							<div class="home-v1-form-placeholder__submit"><?php esc_html_e( 'Submit', 'aiagency-wez' ); ?></div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
