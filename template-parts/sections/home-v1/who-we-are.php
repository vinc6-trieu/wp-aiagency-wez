<?php
/**
 * Home V1 who we are section.
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
		'image'          => array(),
		'visual_caption' => '',
		'paragraph_one'  => '',
		'paragraph_two'  => '',
		'highlight'      => '',
	)
);

$section_title = isset( $args['title'] ) ? trim( (string) $args['title'] ) : '';
if ( $section_title === '' ) {
	return;
}
?>

<section id="who-we-are" class="home-v1-section home-v1-section--about">
	<div class="home-v1-shell home-v1-about">
		<div class="home-v1-about__visual-card">
			<?php if ( ! empty( $args['image']['url'] ) ) : ?>
				<div class="home-v1-about__image">
					<img src="<?php echo esc_url( $args['image']['url'] ); ?>" alt="<?php echo esc_attr( $args['image']['alt'] ); ?>">
				</div>
			<?php else : ?>
				<div class="home-v1-network-visual" aria-hidden="true">
					<span class="home-v1-network-visual__core"></span>
					<span class="home-v1-network-visual__node home-v1-network-visual__node--top"></span>
					<span class="home-v1-network-visual__node home-v1-network-visual__node--right"></span>
					<span class="home-v1-network-visual__node home-v1-network-visual__node--bottom"></span>
					<span class="home-v1-network-visual__node home-v1-network-visual__node--left"></span>
					<span class="home-v1-network-visual__label home-v1-network-visual__label--top"><?php esc_html_e( 'DATA', 'aiagency-wez' ); ?></span>
					<span class="home-v1-network-visual__label home-v1-network-visual__label--right"><?php esc_html_e( 'CUSTOMERS', 'aiagency-wez' ); ?></span>
					<span class="home-v1-network-visual__label home-v1-network-visual__label--bottom"><?php esc_html_e( 'DECISIONS', 'aiagency-wez' ); ?></span>
					<span class="home-v1-network-visual__label home-v1-network-visual__label--left"><?php esc_html_e( 'OPERATIONS', 'aiagency-wez' ); ?></span>
				</div>
			<?php endif; ?>

			<?php if ( $args['visual_caption'] ) : ?>
				<p class="home-v1-about__visual-caption"><?php echo esc_html( $args['visual_caption'] ); ?></p>
			<?php endif; ?>
		</div>

		<div class="home-v1-about__content">
			<div class="home-v1-split-heading home-v1-split-heading--tight">
				<div class="home-v1-split-heading__main">
					<h2><?php echo esc_html( $section_title ); ?></h2>
					<span class="home-v1-split-heading__line" aria-hidden="true"></span>
				</div>
			</div>

			<div class="home-v1-about__copy">
				<?php if ( $args['paragraph_one'] ) : ?>
					<p><?php echo esc_html( $args['paragraph_one'] ); ?></p>
				<?php endif; ?>

				<?php if ( $args['paragraph_two'] ) : ?>
					<p><?php echo esc_html( $args['paragraph_two'] ); ?></p>
				<?php endif; ?>

				<?php if ( $args['highlight'] ) : ?>
					<p class="home-v1-about__highlight"><?php echo esc_html( $args['highlight'] ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
