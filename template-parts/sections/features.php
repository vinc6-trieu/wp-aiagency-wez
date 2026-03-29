<?php
/**
 * Features section template part.
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
	)
);

if ( empty( $args['items'] ) || ! is_array( $args['items'] ) ) {
	return;
}
?>

<section class="section">
	<div class="section__inner">
		<?php if ( $args['title'] ) : ?>
			<h2 class="section__title"><?php echo esc_html( $args['title'] ); ?></h2>
		<?php endif; ?>

		<ul class="feature-list">
			<?php foreach ( $args['items'] as $item ) : ?>
				<li><?php echo esc_html( $item ); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
