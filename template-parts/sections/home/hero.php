<?php
/**
 * Home hero section.
 *
 * @package aiagency-wez
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	$args,
	array(
		'eyebrow'        => '',
		'title'          => '',
		'image'          => array(),
		'primary_text'   => '',
		'primary_link'   => '',
		'secondary_text' => '',
		'secondary_link' => '',
	)
);

if ( empty( $args['title'] ) && empty( $args['image']['url'] ) ) {
	return;
}
?>

<section class="home-section home-hero-section">
	<div class="home-shell home-hero-grid">
		<div class="home-hero-copy">
			<?php if ( $args['eyebrow'] ) : ?>
				<p class="home-eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></p>
			<?php endif; ?>

			<?php if ( $args['title'] ) : ?>
				<h1 class="home-hero-title"><?php echo esc_html( $args['title'] ); ?></h1>
			<?php endif; ?>

			<div class="home-hero-actions">
				<?php if ( $args['primary_text'] && $args['primary_link'] ) : ?>
					<a class="home-button home-button--light" href="<?php echo esc_url( $args['primary_link'] ); ?>">
						<?php echo esc_html( $args['primary_text'] ); ?>
					</a>
				<?php endif; ?>

				<?php if ( $args['secondary_text'] && $args['secondary_link'] ) : ?>
					<a class="home-button home-button--ghost" href="<?php echo esc_url( $args['secondary_link'] ); ?>">
						<?php echo esc_html( $args['secondary_text'] ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>

		<?php if ( ! empty( $args['image']['url'] ) ) : ?>
			<div class="home-hero-visual">
				<div class="home-hero-portrait">
					<img src="<?php echo esc_url( $args['image']['url'] ); ?>" alt="<?php echo esc_attr( $args['image']['alt'] ); ?>">
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>
