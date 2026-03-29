<?php
/**
 * CTA section template part.
 *
 * @package aiagency-wez
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	$args,
	array(
		'text' => '',
		'link' => '',
	)
);

if ( empty( $args['text'] ) || empty( $args['link'] ) ) {
	return;
}
?>

<section class="section">
	<div class="section__inner">
		<div class="cta-banner">
			<p><?php echo esc_html( $args['text'] ); ?></p>
			<a class="button" href="<?php echo esc_url( $args['link'] ); ?>">
				<?php esc_html_e( 'Learn More', 'aiagency-wez' ); ?>
			</a>
		</div>
	</div>
</section>
