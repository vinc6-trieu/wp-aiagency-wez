<?php
/**
 * Home V1 competencies section.
 *
 * @package aiagency-wez
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	$args,
	array(
		'eyebrow'    => '',
		'title'      => '',
		'intro'      => '',
		'items'      => array(),
		'cta_text'   => '',
		'cta_url'    => '',
		'disclaimer' => '',
	)
);

$section_title = isset( $args['title'] ) ? trim( (string) $args['title'] ) : '';
if ( $section_title === '' ) {
	return;
}
?>

<section id="core-competencies" class="home-v1-section home-v1-section--competencies">
	<div class="home-v1-shell home-v1-competencies">
		<div class="home-v1-section-heading home-v1-section-heading--centered">
			<?php if ( $args['eyebrow'] ) : ?>
				<p class="home-v1-section-heading__eyebrow"><?php echo esc_html( $args['eyebrow'] ); ?></p>
			<?php endif; ?>

			<h2 class="home-v1-section-heading__title"><?php echo esc_html( $section_title ); ?></h2>

			<span class="home-v1-section-heading__bar" aria-hidden="true"></span>
		</div>
		<?php if ( $args['intro'] ) : ?>
			<p class="home-v1-competencies__intro"><?php echo esc_html( $args['intro'] ); ?></p>
		<?php endif; ?>

		<?php if ( ! empty( $args['items'] ) ) : ?>
			<div class="home-v1-competencies__list">
				<?php
				foreach ( $args['items'] as $index => $item ) :
					$icon       = isset( $item['icon'] ) ? $item['icon'] : array( 'url' => '', 'alt' => '' );
					$icon_url   = is_array( $icon ) && ! empty( $icon['url'] ) ? $icon['url'] : '';
					$icon_class = 'home-v1-competency__icon' . ( $icon_url ? ' home-v1-competency__icon--image' : ' home-v1-competency__icon--svg' );
					$icon_svg   = aiagency_wez_home_v1_competency_default_icon_svg( $index );
					?>
					<article class="home-v1-competency">
						<span class="<?php echo esc_attr( $icon_class ); ?>" aria-hidden="true">
							<?php if ( $icon_url ) : ?>
								<img src="<?php echo esc_url( $icon_url ); ?>" alt="" width="40" height="40" loading="lazy" decoding="async" />
							<?php else : ?>
								<?php echo $icon_svg; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- theme-owned inline SVG markup. ?>
							<?php endif; ?>
						</span>
						<div class="home-v1-competency__copy">
							<?php if ( ! empty( $item['title'] ) ) : ?>
								<h3><?php echo esc_html( $item['title'] ); ?></h3>
							<?php endif; ?>
							<?php if ( ! empty( $item['description'] ) ) : ?>
								<p><?php echo esc_html( $item['description'] ); ?></p>
							<?php endif; ?>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<div class="home-v1-competencies__footer">
			<?php if ( $args['cta_text'] && $args['cta_url'] ) : ?>
				<a class="home-v1-button home-v1-button--compact" href="<?php echo esc_url( $args['cta_url'] ); ?>">
					<?php
					echo '<svg xmlns="http://www.w3.org/2000/svg" class="home-v1-button__icon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.65" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M22 17V4a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v13"/><path d="M15 9H5a2 2 0 0 0-2 2v7l4-4h8a2 2 0 0 0 2-2Z"/></svg>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- inline SVG; paths are static.
					echo esc_html( $args['cta_text'] );
					?>
				</a>
			<?php endif; ?>

			<?php if ( $args['disclaimer'] ) : ?>
				<div class="home-v1-competencies__notes">
					<p class="home-v1-competencies__disclaimer"><?php echo esc_html( $args['disclaimer'] ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
