<?php
/**
 * Hero section template part.
 *
 * @package aiagency-wez
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args        = wp_parse_args(
	$args,
	array(
		'eyebrow'     => '',
		'title'       => '',
		'description' => '',
		'image_url'   => '',
		'image_alt'   => '',
	)
);
$has_image   = ! empty( $args['image_url'] );
$hero_class  = $has_image ? 'hero hero--with-image' : 'hero';

if ( empty( $args['title'] ) && empty( $args['description'] ) && ! $has_image ) {
	return;
}
?>

<section class="section">
	<div class="section__inner">
		<div class="<?php echo esc_attr( $hero_class ); ?>">
			<div class="hero__content">
				<?php if ( $args['eyebrow'] ) : ?>
					<p class="hero__eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></p>
				<?php endif; ?>

				<?php if ( $args['title'] ) : ?>
					<h1 class="hero__title"><?php echo esc_html( $args['title'] ); ?></h1>
				<?php endif; ?>

				<?php if ( $args['description'] ) : ?>
					<p class="hero__description"><?php echo esc_html( $args['description'] ); ?></p>
				<?php endif; ?>
			</div>

			<?php if ( $has_image ) : ?>
				<div class="hero__media">
					<img src="<?php echo esc_url( $args['image_url'] ); ?>" alt="<?php echo esc_attr( $args['image_alt'] ); ?>">
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
