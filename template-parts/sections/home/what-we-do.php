<?php
/**
 * Home what we do section.
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
		'image'       => array(),
		'intro_text'  => '',
		'cta_text'    => '',
		'cta_link'    => '',
		'cards'       => array(),
		'banner_text' => '',
	)
);

if ( empty( $args['title'] ) && empty( $args['cards'] ) && empty( $args['intro_text'] ) ) {
	return;
}
?>

<section id="what-we-do" class="home-section home-section--surface">
	<div class="home-shell">
		<div class="home-section-heading">
			<h2><?php echo esc_html( $args['title'] ? $args['title'] : __( 'What We Do', 'aiagency-wez' ) ); ?></h2>
		</div>

		<div class="home-feature-story">
			<?php if ( ! empty( $args['image']['url'] ) ) : ?>
				<div class="home-feature-story__image">
					<img src="<?php echo esc_url( $args['image']['url'] ); ?>" alt="<?php echo esc_attr( $args['image']['alt'] ); ?>">
				</div>
			<?php endif; ?>

			<div class="home-feature-story__content">
				<?php if ( $args['intro_text'] ) : ?>
					<p><?php echo esc_html( $args['intro_text'] ); ?></p>
				<?php endif; ?>

				<?php if ( $args['cta_text'] && $args['cta_link'] ) : ?>
					<a class="home-button home-button--primary" href="<?php echo esc_url( $args['cta_link'] ); ?>">
						<?php echo esc_html( $args['cta_text'] ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>

		<?php if ( ! empty( $args['cards'] ) && is_array( $args['cards'] ) ) : ?>
			<div class="home-services-grid">
				<?php foreach ( $args['cards'] as $card ) : ?>
					<article class="home-service-card">
						<?php if ( ! empty( $card['image']['url'] ) ) : ?>
							<div class="home-service-card__image">
								<img src="<?php echo esc_url( $card['image']['url'] ); ?>" alt="<?php echo esc_attr( $card['image']['alt'] ); ?>">
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $card['title'] ) ) : ?>
							<h3><?php echo esc_html( $card['title'] ); ?></h3>
						<?php endif; ?>

						<?php if ( ! empty( $card['text'] ) ) : ?>
							<p><?php echo esc_html( $card['text'] ); ?></p>
						<?php endif; ?>
					</article>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<?php if ( $args['banner_text'] ) : ?>
			<div class="home-info-banner">
				<p><?php echo esc_html( $args['banner_text'] ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</section>
