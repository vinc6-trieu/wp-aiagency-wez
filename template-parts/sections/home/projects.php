<?php
/**
 * Home projects section.
 *
 * @package aiagency-wez
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	$args,
	array(
		'title'    => '',
		'projects' => array(),
	)
);

if ( empty( $args['projects'] ) || ! is_array( $args['projects'] ) ) {
	return;
}
?>

<section id="our-projects" class="home-section">
	<div class="home-shell">
		<div class="home-section-heading">
			<h2><?php echo esc_html( $args['title'] ? $args['title'] : __( 'Our Projects', 'aiagency-wez' ) ); ?></h2>
		</div>

		<div class="home-project-grid">
			<?php foreach ( $args['projects'] as $index => $project ) : ?>
				<article class="home-project-card home-project-card--<?php echo esc_attr( (string) ( $index + 1 ) ); ?>">
					<?php if ( ! empty( $project['image']['url'] ) ) : ?>
						<img src="<?php echo esc_url( $project['image']['url'] ); ?>" alt="<?php echo esc_attr( $project['image']['alt'] ); ?>">
					<?php endif; ?>

					<?php if ( ! empty( $project['title'] ) ) : ?>
						<div class="home-project-card__label"><?php echo esc_html( $project['title'] ); ?></div>
					<?php endif; ?>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
