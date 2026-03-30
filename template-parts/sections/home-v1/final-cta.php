<?php
/**
 * Home V1 final CTA section.
 *
 * @package aiagency-wez
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	$args,
	array(
		'title'       => '',
		'description' => '',
		'email'       => '',
		'button_text' => '',
		'button_url'  => '',
	)
);

$email_raw = is_string( $args['email'] ) ? trim( $args['email'] ) : '';
$email     = $email_raw ? sanitize_email( $email_raw ) : '';

$has_copy     = (bool) ( $args['title'] || $args['description'] || ( $email_raw && $email ) );
$has_button   = (bool) ( $args['button_text'] && $args['button_url'] );
$show_section = $has_copy || $has_button;

if ( ! $show_section ) {
	return;
}
?>

<section id="final-cta" class="home-v1-section home-v1-section--final-cta">
	<div class="home-v1-shell home-v1-shell--final-cta">
		<div class="home-v1-final-cta">
			<div class="home-v1-final-cta__content">
				<?php if ( $has_copy ) : ?>
					<div class="home-v1-final-cta__copy">
						<?php if ( ! empty( $args['title'] ) ) : ?>
							<h2 class="home-v1-final-cta__title"><?php echo esc_html( $args['title'] ); ?></h2>
						<?php endif; ?>
						<?php if ( ! empty( $args['description'] ) ) : ?>
							<p class="home-v1-final-cta__lede"><?php echo esc_html( $args['description'] ); ?></p>
						<?php endif; ?>
						<?php if ( $email ) : ?>
							<p class="home-v1-final-cta__email">
								<a href="<?php echo esc_url( 'mailto:' . $email ); ?>"><?php echo esc_html( $email ); ?></a>
							</p>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<?php if ( $has_button ) : ?>
					<div class="home-v1-final-cta__action">
						<a class="home-v1-final-cta__button" href="<?php echo esc_url( $args['button_url'] ); ?>">
							<?php echo esc_html( $args['button_text'] ); ?>
						</a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
