<?php
/**
 * Template Name: Landing Page
 * Template Post Type: page
 *
 * @package aiagency-wez
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	$hero_title       = function_exists( 'get_field' ) ? get_field( 'hero_title' ) : '';
	$hero_description = function_exists( 'get_field' ) ? get_field( 'hero_description' ) : '';
	$hero_image       = function_exists( 'get_field' ) ? get_field( 'hero_image' ) : '';
	$cta_text         = function_exists( 'get_field' ) ? get_field( 'cta_text' ) : '';
	$cta_link         = function_exists( 'get_field' ) ? get_field( 'cta_link' ) : '';
	$features_items   = function_exists( 'get_field' ) ? get_field( 'features_items' ) : '';

	$image_data    = aiagency_wez_get_image_data( $hero_image );
	$feature_lines = aiagency_wez_get_lines( $features_items );
	$has_intro     = $hero_title || $hero_description || $image_data['url'];
	?>

	<?php
	if ( $has_intro ) {
		get_template_part(
			'template-parts/sections/hero',
			null,
			array(
				'eyebrow'     => __( 'Landing Page', 'aiagency-wez' ),
				'title'       => $hero_title,
				'description' => $hero_description,
				'image_url'   => $image_data['url'],
				'image_alt'   => $image_data['alt'],
			)
		);
	}
	?>

	<?php
	if ( ! empty( $feature_lines ) ) {
		get_template_part(
			'template-parts/sections/features',
			null,
			array(
				'title' => __( 'Features', 'aiagency-wez' ),
				'items' => $feature_lines,
			)
		);
	}
	?>

	<?php
	if ( $cta_text && $cta_link ) {
		get_template_part(
			'template-parts/sections/cta',
			null,
			array(
				'text' => $cta_text,
				'link' => $cta_link,
			)
		);
	}
	?>
<?php endwhile; ?>

<?php
get_footer();
