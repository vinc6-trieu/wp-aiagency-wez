<?php
/**
 * Home V1 hero section.
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
		'description'    => '',
		'primary_text'   => '',
		'primary_url'    => '',
		'secondary_text' => '',
		'secondary_url'  => '',
		'image'          => array(),
		'background_image' => array(),
		'stat_label'     => '',
		'stat_value'     => '',
	)
);

$hero_title = isset( $args['title'] ) ? trim( (string) $args['title'] ) : '';
if ( $hero_title === '' ) {
	return;
}

$hero_style = '';
if ( 'Meet Lina, Our AI Business Agent' === $hero_title ) {
	$hero_title = "Meet Lina,\nOur AI Business Agent";
}

if ( ! empty( $args['background_image']['url'] ) ) {
	$hero_style = sprintf(
		'--aiagency-wez-home-v1-hero-image: url("%s");',
		esc_url_raw( $args['background_image']['url'] )
	);
}
?>

<section class="home-v1-section home-v1-section--hero"<?php echo $hero_style ? ' style="' . esc_attr( $hero_style ) . '"' : ''; ?>>
	<div class="home-v1-shell home-v1-hero">
		<div class="home-v1-hero__content">
			<?php if ( $args['eyebrow'] ) : ?>
				<p class="home-v1-pill-label">
					<span class="home-v1-pill-label__dot"></span>
					<?php echo esc_html( $args['eyebrow'] ); ?>
				</p>
			<?php endif; ?>

			<?php if ( $hero_title ) : ?>
				<h1 class="home-v1-hero__title"><?php echo nl2br( esc_html( $hero_title ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></h1>
			<?php endif; ?>

			<?php if ( $args['description'] ) : ?>
				<p class="home-v1-hero__description"><?php echo esc_html( $args['description'] ); ?></p>
			<?php endif; ?>

			<?php if ( ( $args['primary_text'] && $args['primary_url'] ) || ( $args['secondary_text'] && $args['secondary_url'] ) ) : ?>
				<div class="home-v1-hero__actions">
					<?php if ( $args['primary_text'] && $args['primary_url'] ) : ?>
						<a class="home-v1-button home-v1-button--primary" href="<?php echo esc_url( $args['primary_url'] ); ?>">
							<?php echo esc_html( $args['primary_text'] ); ?>
						</a>
					<?php endif; ?>

					<?php if ( $args['secondary_text'] && $args['secondary_url'] ) : ?>
						<a class="home-v1-button home-v1-button--ghost" href="<?php echo esc_url( $args['secondary_url'] ); ?>">
							<?php echo esc_html( $args['secondary_text'] ); ?>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="home-v1-hero__visual">
			<div class="home-v1-hero__visual-frame">
				<div class="home-v1-hero__portrait">
					<?php if ( ! empty( $args['image']['url'] ) ) : ?>
						<img src="<?php echo esc_url( $args['image']['url'] ); ?>" alt="<?php echo esc_attr( $args['image']['alt'] ); ?>">
					<?php else : ?>
						<div class="home-v1-hero__image-placeholder" aria-hidden="true"></div>
					<?php endif; ?>
				</div>

				<?php if ( $args['stat_label'] || $args['stat_value'] ) : ?>
					<div class="home-v1-stat-card">
						<div class="home-v1-stat-card__copy">
							<?php if ( $args['stat_label'] ) : ?>
								<p class="home-v1-stat-card__label"><?php echo esc_html( $args['stat_label'] ); ?></p>
							<?php endif; ?>

							<?php if ( $args['stat_value'] ) : ?>
								<p class="home-v1-stat-card__value"><?php echo esc_html( $args['stat_value'] ); ?></p>
							<?php endif; ?>
						</div>

						<div class="home-v1-stat-card__avatars" aria-hidden="true">
							<span></span>
							<span></span>
							<span></span>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
