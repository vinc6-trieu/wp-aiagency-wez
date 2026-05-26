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
$projects = array_values(
	array_filter(
		(array) $args['projects'],
		static function ( $project ) {
			if ( ! is_array( $project ) ) {
				return false;
			}

			$project_title = isset( $project['title'] ) ? trim( (string) $project['title'] ) : '';
			return $project_title !== '';
		}
	)
);

if ( $section_title === '' || empty( $projects ) ) {
	return;
}

$projects_count      = count( $projects );
$projects_grid_class = array(
	'home-v1-projects-grid',
	'home-v1-projects-grid--count-' . $projects_count,
);
$projects_grid_style = 'grid-template-columns: repeat(' . $projects_count . ', minmax(0, 1fr));';
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
			<div class="<?php echo esc_attr( implode( ' ', $projects_grid_class ) ); ?>" style="<?php echo esc_attr( $projects_grid_style ); ?>">
				<?php foreach ( $projects as $project_index => $project ) : ?>
					<?php
					$project_title       = ! empty( $project['title'] ) ? trim( (string) $project['title'] ) : '';
					$project_category    = ! empty( $project['category'] ) ? trim( (string) $project['category'] ) : '';
					$project_description = ! empty( $project['description'] ) ? trim( (string) $project['description'] ) : '';
					$project_description_id = 'home-v1-project-popup-description-source-' . (string) $project_index;
					?>
					<article class="home-v1-project-card">
						<div class="home-v1-project-card__media">
							<?php if ( ! empty( $project['image']['url'] ) ) : ?>
								<img src="<?php echo esc_url( $project['image']['url'] ); ?>" alt="<?php echo esc_attr( $project['image']['alt'] ); ?>">
							<?php else : ?>
								<div class="home-v1-project-card__placeholder" aria-hidden="true"></div>
							<?php endif; ?>

							<?php if ( $project_description !== '' ) : ?>
								<div id="<?php echo esc_attr( $project_description_id ); ?>" class="home-v1-project-card__popup-content" hidden>
									<?php echo wp_kses_post( $project_description ); ?>
								</div>
								<button
									type="button"
									class="home-v1-project-card__popup-trigger"
									data-aiagency-wez-project-popup-trigger="true"
									data-project-title="<?php echo esc_attr( $project_title ); ?>"
									data-project-category="<?php echo esc_attr( $project_category ); ?>"
									data-project-description-id="<?php echo esc_attr( $project_description_id ); ?>"
								>
									<span class="screen-reader-text">
										<?php
										echo esc_html(
											sprintf(
												/* translators: %s: project title */
												__( 'Open project details: %s', 'aiagency-wez' ),
												$project_title !== '' ? $project_title : __( 'Project', 'aiagency-wez' )
											)
										);
										?>
									</span>
								</button>
							<?php endif; ?>
						</div>

						<div class="home-v1-project-card__overlay">
							<?php if ( $project_category !== '' ) : ?>
								<p class="home-v1-project-card__category"><?php echo esc_html( $project_category ); ?></p>
							<?php endif; ?>

							<?php if ( $project_title !== '' ) : ?>
								<h3><?php echo esc_html( $project_title ); ?></h3>
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

		<div class="home-v1-project-popup" data-aiagency-wez-project-popup="true" hidden>
			<div class="home-v1-project-popup__backdrop" data-aiagency-wez-project-popup-close="true" aria-hidden="true"></div>
			<div
				class="home-v1-project-popup__dialog"
				role="dialog"
				aria-modal="true"
				aria-labelledby="home-v1-project-popup-title"
				aria-describedby="home-v1-project-popup-description"
			>
				<button
					type="button"
					class="home-v1-project-popup__close"
					data-aiagency-wez-project-popup-close="true"
				>
					<span aria-hidden="true">&times;</span>
					<span class="screen-reader-text"><?php esc_html_e( 'Close project details', 'aiagency-wez' ); ?></span>
				</button>

				<p class="home-v1-project-popup__category" id="home-v1-project-popup-category"></p>
				<h3 class="home-v1-project-popup__title" id="home-v1-project-popup-title"></h3>
				<div class="home-v1-project-popup__description" id="home-v1-project-popup-description"></div>
			</div>
		</div>
	</div>
</section>
