<?php
/**
 * Template Name: Home Page - Version 1
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

		get_template_part(
			'template-parts/sections/home-v1/competencies',
			null,
			array(
				'eyebrow'     => function_exists( 'get_field' ) ? get_field( 'home_v1_competencies_eyebrow', $page_id ) : '',
				'title'       => function_exists( 'get_field' ) ? get_field( 'home_v1_competencies_title', $page_id ) : '',
				'intro'       => function_exists( 'get_field' ) ? get_field( 'home_v1_competencies_intro', $page_id ) : '',
				'items'       => $competencies,
				'cta_text'    => function_exists( 'get_field' ) ? get_field( 'home_v1_competencies_cta_text', $page_id ) : '',
				'cta_url'     => function_exists( 'get_field' ) ? get_field( 'home_v1_competencies_cta_url', $page_id ) : '',
				'disclaimer'  => function_exists( 'get_field' ) ? get_field( 'home_v1_competencies_disclaimer', $page_id ) : '',
			)
		);

		$problems_title = function_exists( 'get_field' ) ? get_field( 'home_v1_problems_title', $page_id ) : '';
		$problems_quote = function_exists( 'get_field' ) ? get_field( 'home_v1_problems_quote', $page_id ) : '';
		if ( ! is_string( $problems_title ) ) {
			$problems_title = '';
		}
		if ( ! is_string( $problems_quote ) ) {
			$problems_quote = '';
		}
		if ( $problems_title || $problem_lines || $problems_quote ) {
			get_template_part(
				'template-parts/sections/home-v1/problems-we-solve',
				null,
				array(
					'title' => $problems_title,
					'items' => $problem_lines,
					'quote' => $problems_quote,
				)
			);
		}

		get_template_part(
			'template-parts/sections/home-v1/projects',
			null,
			array(
				'title'         => function_exists( 'get_field' ) ? get_field( 'home_v1_projects_title', $page_id ) : '',
				'intro'         => function_exists( 'get_field' ) ? get_field( 'home_v1_projects_intro', $page_id ) : '',
				'all_link_text' => function_exists( 'get_field' ) ? get_field( 'home_v1_projects_all_link_text', $page_id ) : '',
				'all_link_url'  => function_exists( 'get_field' ) ? get_field( 'home_v1_projects_all_link_url', $page_id ) : '',
				'projects'      => $projects,
			)
		);

		get_template_part(
			'template-parts/sections/home-v1/who-we-are',
			null,
			array(
				'title'          => function_exists( 'get_field' ) ? get_field( 'home_v1_who_title', $page_id ) : '',
				'image'          => aiagency_wez_get_image_data( function_exists( 'get_field' ) ? get_field( 'home_v1_who_image', $page_id ) : '' ),
				'visual_caption' => function_exists( 'get_field' ) ? get_field( 'home_v1_who_visual_caption', $page_id ) : '',
				'paragraph_one'  => function_exists( 'get_field' ) ? get_field( 'home_v1_who_paragraph_one', $page_id ) : '',
				'paragraph_two'  => function_exists( 'get_field' ) ? get_field( 'home_v1_who_paragraph_two', $page_id ) : '',
				'highlight'      => function_exists( 'get_field' ) ? get_field( 'home_v1_who_highlight', $page_id ) : '',
			)
		);

		$team_title              = function_exists( 'get_field' ) ? get_field( 'home_v1_team_title', $page_id ) : '';
		$team_intro              = function_exists( 'get_field' ) ? get_field( 'home_v1_team_intro', $page_id ) : '';
		$team_expertise_heading  = function_exists( 'get_field' ) ? get_field( 'home_v1_team_expertise_heading', $page_id ) : '';
		if ( ! is_string( $team_title ) ) {
			$team_title = '';
		}
		if ( ! is_string( $team_intro ) ) {
			$team_intro = '';
		}
		if ( ! is_string( $team_expertise_heading ) ) {
			$team_expertise_heading = '';
		}
		if ( $team_title || $team_intro || $team_featured_image['url'] || $team_expertise ) {
			get_template_part(
				'template-parts/sections/home-v1/team',
				null,
				array(
					'title'             => $team_title,
					'intro'             => $team_intro,
					'featured_image'    => $team_featured_image,
					'expertise_heading' => $team_expertise_heading,
					'expertise_items'   => $team_expertise,
				)
			);
		}

		get_template_part(
			'template-parts/sections/home-v1/contact',
			null,
			array(
				'eyebrow'        => function_exists( 'get_field' ) ? get_field( 'home_v1_contact_eyebrow', $page_id ) : '',
				'visual_image'   => aiagency_wez_get_image_data( function_exists( 'get_field' ) ? get_field( 'home_v1_contact_visual_image', $page_id ) : '' ),
				'status_kicker'  => function_exists( 'get_field' ) ? get_field( 'home_v1_contact_status_kicker', $page_id ) : '',
				'status_line'    => function_exists( 'get_field' ) ? get_field( 'home_v1_contact_status_line', $page_id ) : '',
				'status_badge'   => function_exists( 'get_field' ) ? get_field( 'home_v1_contact_status_badge', $page_id ) : '',
				'title'          => function_exists( 'get_field' ) ? get_field( 'home_v1_contact_title', $page_id ) : '',
				'description'    => function_exists( 'get_field' ) ? get_field( 'home_v1_contact_description', $page_id ) : '',
				'email_label'    => function_exists( 'get_field' ) ? get_field( 'home_v1_contact_email_label', $page_id ) : '',
				'email_value'    => function_exists( 'get_field' ) ? get_field( 'home_v1_contact_email_value', $page_id ) : '',
				'form_shortcode' => function_exists( 'get_field' ) ? get_field( 'home_v1_contact_form_shortcode', $page_id ) : '',
			)
		);
		?>
	</div>
<?php endwhile; ?>

<?php get_footer(); ?>
