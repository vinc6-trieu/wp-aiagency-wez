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
		'button_text' => '',
		'button_url'  => '',
	)
);

if ( ! $args['title'] && ! $args['description'] && ! $args['button_text'] ) {
	return;
}
?>

<section class="home-v1-section home-v1-section--final-cta">
	<div class="home-v1-shell">
		<div class="home-v1-final-cta">
			<div class="home-v1-final-cta__content">
				<?php if ( $args['title'] ) : ?>
					<h2><?php echo esc_html( $args['title'] ); ?></h2>
				<?php endif; ?>
				<?php if ( $args['description'] ) : ?>
					<p><?php echo esc_html( $args['description'] ); ?></p>
				<?php endif; ?>
				<?php if ( $args['button_text'] && $args['button_url'] ) : ?>
					<a class="home-v1-button home-v1-button--inverse" href="<?php echo esc_url( $args['button_url'] ); ?>">
						<?php echo esc_html( $args['button_text'] ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
