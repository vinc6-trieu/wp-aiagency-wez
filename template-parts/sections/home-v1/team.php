<?php
/**
 * Home V1 team section.
 *
 * @package aiagency-wez
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	$args,
	array(
		'title'             => '',
		'intro'             => '',
		'featured_image'    => array(),
		'expertise_heading' => '',
		'expertise_items'   => array(),
	)
);

$section_title = isset( $args['title'] ) ? trim( (string) $args['title'] ) : '';
if ( $section_title === '' ) {
	return;
}

$featured = is_array( $args['featured_image'] ) ? $args['featured_image'] : array();
$items    = array_values(
	array_filter(
		array_map(
			static function ( $line ) {
				return is_string( $line ) ? trim( $line ) : '';
			},
			is_array( $args['expertise_items'] ) ? $args['expertise_items'] : array()
		)
	)
);

$expertise_title = is_string( $args['expertise_heading'] ) ? trim( $args['expertise_heading'] ) : '';
if ( $expertise_title === '' && $items ) {
	$expertise_title = __( 'Our Expertise', 'aiagency-wez' );
}

$has_featured          = ! empty( $featured['url'] );
$has_expertise_content = (bool) $items;
$show_media_column     = $has_featured || $has_expertise_content;
$layout_classes        = 'home-v1-team-layout';
if ( $has_featured && ! $has_expertise_content ) {
	$layout_classes .= ' home-v1-team-layout--media-only';
}
?>

<section id="team" class="home-v1-section home-v1-section--team">
	<div class="home-v1-shell">
		<div class="home-v1-split-heading home-v1-split-heading--team">
			<div class="home-v1-split-heading__main">
				<h2>
					<span class="home-v1-split-heading__title-highlight"><?php echo esc_html( $section_title ); ?></span>
				</h2>
				<span class="home-v1-split-heading__line" aria-hidden="true"></span>
			</div>

			<?php if ( $args['intro'] ) : ?>
				<p class="home-v1-split-heading__intro"><?php echo esc_html( $args['intro'] ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $show_media_column ) : ?>
			<div class="<?php echo esc_attr( $layout_classes ); ?>">
				<?php if ( $show_media_column ) : ?>
					<div class="home-v1-team-layout__media">
						<div class="home-v1-team-layout__frame">
							<?php if ( $has_featured ) : ?>
								<img src="<?php echo esc_url( $featured['url'] ); ?>" alt="<?php echo esc_attr( $featured['alt'] ); ?>" loading="lazy" decoding="async">
							<?php else : ?>
								<div class="home-v1-team-layout__placeholder" aria-hidden="true"></div>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( $has_expertise_content ) : ?>
					<div class="home-v1-team-layout__expertise">
						<?php if ( $expertise_title ) : ?>
							<h3 class="home-v1-team-expertise__heading"><?php echo esc_html( $expertise_title ); ?></h3>
						<?php endif; ?>

						<ul class="home-v1-team-expertise__list">
							<?php foreach ( $items as $line ) : ?>
								<li class="home-v1-team-expertise__item">
									<span class="home-v1-team-expertise__check" aria-hidden="true">
										<svg width="10" height="8" viewBox="0 0 10 8" fill="none" xmlns="http://www.w3.org/2000/svg" focusable="false">
											<path d="M1 3.8L3.6 6.4L9 1" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
										</svg>
									</span>
									<span class="home-v1-team-expertise__text"><?php echo esc_html( $line ); ?></span>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
