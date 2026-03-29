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

	$team_members = array();
	for ( $index = 1; $index <= 5; $index++ ) {
		$image = aiagency_wez_get_image_data( function_exists( 'get_field' ) ? get_field( 'home_v1_team_member_' . $index . '_image', $page_id ) : '' );
		$name  = function_exists( 'get_field' ) ? get_field( 'home_v1_team_member_' . $index . '_name', $page_id ) : '';
		$role  = function_exists( 'get_field' ) ? get_field( 'home_v1_team_member_' . $index . '_role', $page_id ) : '';

		if ( $name || $role || $image['url'] ) {
			$team_members[] = array(
				'image' => $image,
				'name'  => $name,
				'role'  => $role,
			);
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

		get_template_part(
			'template-parts/sections/home-v1/team',
			null,
			array(
				'title'   => function_exists( 'get_field' ) ? get_field( 'home_v1_team_title', $page_id ) : '',
				'intro'   => function_exists( 'get_field' ) ? get_field( 'home_v1_team_intro', $page_id ) : '',
				'members' => $team_members,
			)
		);

		get_template_part(
			'template-parts/sections/home-v1/contact',
			null,
			array(
				'title'          => function_exists( 'get_field' ) ? get_field( 'home_v1_contact_title', $page_id ) : '',
				'description'    => function_exists( 'get_field' ) ? get_field( 'home_v1_contact_description', $page_id ) : '',
				'phone_label'    => function_exists( 'get_field' ) ? get_field( 'home_v1_contact_phone_label', $page_id ) : '',
				'phone_value'    => function_exists( 'get_field' ) ? get_field( 'home_v1_contact_phone_value', $page_id ) : '',
				'email_label'    => function_exists( 'get_field' ) ? get_field( 'home_v1_contact_email_label', $page_id ) : '',
				'email_value'    => function_exists( 'get_field' ) ? get_field( 'home_v1_contact_email_value', $page_id ) : '',
				'form_shortcode' => function_exists( 'get_field' ) ? get_field( 'home_v1_contact_form_shortcode', $page_id ) : '',
			)
		);

		get_template_part(
			'template-parts/sections/home-v1/final-cta',
			null,
			array(
				'title'       => function_exists( 'get_field' ) ? get_field( 'home_v1_final_cta_title', $page_id ) : '',
				'description' => function_exists( 'get_field' ) ? get_field( 'home_v1_final_cta_description', $page_id ) : '',
				'button_text' => function_exists( 'get_field' ) ? get_field( 'home_v1_final_cta_button_text', $page_id ) : '',
				'button_url'  => function_exists( 'get_field' ) ? get_field( 'home_v1_final_cta_button_url', $page_id ) : '',
			)
		);
		?>
	</div>
<?php endwhile; ?>

<?php get_footer(); ?>
