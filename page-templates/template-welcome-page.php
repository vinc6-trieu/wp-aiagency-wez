<?php
/**
 * Template Name: Welcome Page
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

	$page_id = get_the_ID();

	$hero_image            = aiagency_wez_get_image_data( function_exists( 'get_field' ) ? get_field( 'home_v1_hero_image', $page_id ) : '' );
	$hero_background_image = aiagency_wez_get_image_data( function_exists( 'get_field' ) ? get_field( 'home_v1_hero_background_image', $page_id ) : '' );

	$competencies = array();
	for ( $index = 1; $index <= 3; $index++ ) {
		$title       = function_exists( 'get_field' ) ? get_field( 'home_v1_competency_' . $index . '_title', $page_id ) : '';
		$description = function_exists( 'get_field' ) ? get_field( 'home_v1_competency_' . $index . '_description', $page_id ) : '';

		if ( $title || $description ) {
			$competencies[] = array(
				'title'       => $title,
				'description' => $description,
				'icon'        => aiagency_wez_get_image_data( function_exists( 'get_field' ) ? get_field( 'home_v1_competency_' . $index . '_icon', $page_id ) : '' ),
			);
		}
	}

	$problem_lines = array();
	for ( $index = 1; $index <= 6; $index++ ) {
		$line = function_exists( 'get_field' ) ? get_field( 'home_v1_problem_' . $index . '_text', $page_id ) : '';
		if ( is_string( $line ) && $line !== '' ) {
			$problem_lines[] = $line;
		}
	}

	$projects = array();
	for ( $index = 1; $index <= 4; $index++ ) {
		$category  = function_exists( 'get_field' ) ? get_field( 'home_v1_project_' . $index . '_category', $page_id ) : '';
		$title     = function_exists( 'get_field' ) ? get_field( 'home_v1_project_' . $index . '_title', $page_id ) : '';
		$image     = aiagency_wez_get_image_data( function_exists( 'get_field' ) ? get_field( 'home_v1_project_' . $index . '_image', $page_id ) : '' );
		$link_text = function_exists( 'get_field' ) ? get_field( 'home_v1_project_' . $index . '_link_text', $page_id ) : '';
		$link_url  = function_exists( 'get_field' ) ? get_field( 'home_v1_project_' . $index . '_link_url', $page_id ) : '';

		if ( $category || $title || $image['url'] ) {
			$projects[] = array(
				'category'  => $category,
				'title'     => $title,
				'image'     => $image,
				'link_text' => $link_text,
				'link_url'  => $link_url,
			);
		}
	}

	$team_featured_image = aiagency_wez_get_image_data( function_exists( 'get_field' ) ? get_field( 'home_v1_team_featured_image', $page_id ) : '' );
	$team_expertise      = array();
	for ( $index = 1; $index <= 6; $index++ ) {
		$line = function_exists( 'get_field' ) ? get_field( 'home_v1_team_expertise_' . $index . '_text', $page_id ) : '';
		if ( is_string( $line ) && $line !== '' ) {
			$team_expertise[] = $line;
		}
	}
	?>

	<div class="home-v1-page">
		<script>
		(function () {
			try {
				if ( window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches ) {
					return;
				}
				document.documentElement.classList.add( 'home-v1-reveal-js' );
			} catch ( e ) {}
		}());
		</script>
		<?php
		get_template_part(
			'template-parts/sections/home-v1/hero',
			null,
			array(
				'eyebrow'        => function_exists( 'get_field' ) ? get_field( 'home_v1_hero_eyebrow', $page_id ) : '',
				'title'          => function_exists( 'get_field' ) ? get_field( 'home_v1_hero_title', $page_id ) : '',
				'description'    => function_exists( 'get_field' ) ? get_field( 'home_v1_hero_description', $page_id ) : '',
				'primary_text'   => function_exists( 'get_field' ) ? get_field( 'home_v1_hero_primary_text', $page_id ) : '',
				'primary_url'    => function_exists( 'get_field' ) ? get_field( 'home_v1_hero_primary_url', $page_id ) : '',
				'secondary_text' => function_exists( 'get_field' ) ? get_field( 'home_v1_hero_secondary_text', $page_id ) : '',
				'secondary_url'  => function_exists( 'get_field' ) ? get_field( 'home_v1_hero_secondary_url', $page_id ) : '',
				'image'          => $hero_image,
				'background_image' => $hero_background_image,
				'stat_label'     => function_exists( 'get_field' ) ? get_field( 'home_v1_hero_stat_label', $page_id ) : '',
				'stat_value'     => function_exists( 'get_field' ) ? get_field( 'home_v1_hero_stat_value', $page_id ) : '',
			)
		);
		?>
	</div>
<?php endwhile; ?>

<?php get_footer(); ?>
