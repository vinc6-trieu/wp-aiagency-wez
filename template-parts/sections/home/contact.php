<?php
/**
 * Home contact section.
 *
 * @package aiagency-wez
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	$args,
	array(
		'title'     => '',
		'label'     => '',
		'link_text' => '',
		'link_url'  => '',
		'visual'    => array(),
	)
);

if ( empty( $args['title'] ) && empty( $args['link_text'] ) && empty( $args['visual']['url'] ) ) {
	return;
}
?>

<section id="contact-us" class="home-section home-section--contact">
	<div class="home-shell">
		<div class="home-contact-panel">
			<div class="home-contact-copy">
				<?php if ( $args['title'] ) : ?>
					<h2><?php echo esc_html( $args['title'] ); ?></h2>
				<?php endif; ?>

				<?php if ( $args['label'] ) : ?>
					<p class="home-contact-label"><?php echo esc_html( $args['label'] ); ?></p>
				<?php endif; ?>

				<?php if ( $args['link_text'] && $args['link_url'] ) : ?>
					<a class="home-contact-link" href="<?php echo esc_url( $args['link_url'] ); ?>">
						<?php echo esc_html( $args['link_text'] ); ?>
					</a>
				<?php endif; ?>
			</div>

			<?php if ( ! empty( $args['visual']['url'] ) ) : ?>
				<div class="home-contact-visual">
					<div class="home-contact-visual__frame">
						<img src="<?php echo esc_url( $args['visual']['url'] ); ?>" alt="<?php echo esc_attr( $args['visual']['alt'] ); ?>">
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
