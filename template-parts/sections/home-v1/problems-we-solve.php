<?php
/**
 * Home V1 "Problems we solve" section.
 *
 * @package aiagency-wez
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	$args,
	array(
		'title' => '',
		'items' => array(),
		'quote' => '',
	)
);

$items = array_values(
	array_filter(
		array_map(
			static function ( $line ) {
				return is_string( $line ) ? trim( $line ) : '';
			},
			$args['items']
		)
	)
);

if ( ! $args['title'] && ! $items && ! $args['quote'] ) {
	return;
}
?>

<section id="problems-we-solve" class="home-v1-section home-v1-section--problems-we-solve">
	<div class="home-v1-shell home-v1-problems-we-solve__inner">
		<?php if ( $args['title'] ) : ?>
			<div class="home-v1-section-heading home-v1-section-heading--centered">
				<h2 class="home-v1-section-heading__title"><?php echo esc_html( $args['title'] ); ?></h2>
				<span class="home-v1-section-heading__bar" aria-hidden="true"></span>
			</div>
		<?php endif; ?>

		<?php if ( $items ) : ?>
			<ul class="home-v1-problems-we-solve__list">
				<?php foreach ( $items as $line ) : ?>
					<li class="home-v1-problems-we-solve__item">
						<span class="home-v1-problems-we-solve__bullet" aria-hidden="true"></span>
						<span class="home-v1-problems-we-solve__text"><?php echo esc_html( $line ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<?php if ( $args['quote'] ) : ?>
			<div class="home-v1-problems-we-solve__footer">
				<p class="home-v1-problems-we-solve__quote"><?php echo esc_html( $args['quote'] ); ?></p>
			</div>
		<?php endif; ?>
	</div>
</section>
