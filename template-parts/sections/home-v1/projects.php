<?php
/**
 * Home V1 projects section.
 *
 * @package aiagency-wez
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	$args,
	array(
		'title'         => '',
		'intro'         => '',
		'all_link_text' => '',
		'all_link_url'  => '',
		'projects'      => array(),
	)
);

$section_title = isset( $args['title'] ) ? trim( (string) $args['title'] ) : '';
if ( $section_title === '' || empty( $args['projects'] ) ) {
	return;
}
?>

<section id="our-projects" class="home-v1-section home-v1-section--projects">
	<div class="home-v1-shell">
		<div class="home-v1-split-heading">
			<div class="home-v1-split-heading__main">
				<h2><?php echo esc_html( $section_title ); ?></h2>
				<span class="home-v1-split-heading__line" aria-hidden="true"></span>
				<?php if ( $args['all_link_text'] && $args['all_link_url'] ) : ?>
					<a class="home-v1-inline-link" href="<?php echo esc_url( $args['all_link_url'] ); ?>"><?php echo esc_html( $args['all_link_text'] ); ?></a>
				<?php endif; ?>
			</div>

			<?php if ( $args['intro'] ) : ?>
				<p class="home-v1-split-heading__intro"><?php echo esc_html( $args['intro'] ); ?></p>
			<?php endif; ?>
		</div>

		<p class="screen-reader-text" id="home-v1-projects-scroll-hint">
			<?php esc_html_e( 'Scroll horizontally to see more projects.', 'aiagency-wez' ); ?>
		</p>
		<div
			class="home-v1-projects-scroll"
			role="region"
			aria-labelledby="home-v1-projects-scroll-hint"
		>
			<div class="home-v1-projects-grid">
				<?php foreach ( $args['projects'] as $project ) : ?>
					<article class="home-v1-project-card">
						<div class="home-v1-project-card__media">
							<?php if ( ! empty( $project['image']['url'] ) ) : ?>
								<img src="<?php echo esc_url( $project['image']['url'] ); ?>" alt="<?php echo esc_attr( $project['image']['alt'] ); ?>">
							<?php else : ?>
								<div class="home-v1-project-card__placeholder" aria-hidden="true"></div>
							<?php endif; ?>
						</div>

						<div class="home-v1-project-card__overlay">
							<?php if ( ! empty( $project['category'] ) ) : ?>
								<p class="home-v1-project-card__category"><?php echo esc_html( $project['category'] ); ?></p>
							<?php endif; ?>

							<?php if ( ! empty( $project['title'] ) ) : ?>
								<h3><?php echo esc_html( $project['title'] ); ?></h3>
							<?php endif; ?>

							<?php if ( ! empty( $project['link_text'] ) && ! empty( $project['link_url'] ) ) : ?>
								<a class="home-v1-project-card__link" href="<?php echo esc_url( $project['link_url'] ); ?>">
									<?php echo esc_html( $project['link_text'] ); ?>
								</a>
							<?php endif; ?>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
