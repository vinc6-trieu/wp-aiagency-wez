<?php
/**
 * Template Name: Home Page
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

	$home_hero_eyebrow        = function_exists( 'get_field' ) ? get_field( 'home_hero_eyebrow' ) : '';
	$home_hero_title          = function_exists( 'get_field' ) ? get_field( 'home_hero_title' ) : '';
	$home_hero_image          = function_exists( 'get_field' ) ? get_field( 'home_hero_image' ) : '';
	$home_hero_primary_text   = function_exists( 'get_field' ) ? get_field( 'home_hero_primary_text' ) : '';
	$home_hero_primary_link   = function_exists( 'get_field' ) ? get_field( 'home_hero_primary_link' ) : '';
	$home_hero_secondary_text = function_exists( 'get_field' ) ? get_field( 'home_hero_secondary_text' ) : '';
	$home_hero_secondary_link = function_exists( 'get_field' ) ? get_field( 'home_hero_secondary_link' ) : '';
	$home_services_title      = function_exists( 'get_field' ) ? get_field( 'home_services_title' ) : '';
	$home_services_image      = function_exists( 'get_field' ) ? get_field( 'home_services_intro_image' ) : '';
	$home_services_text       = function_exists( 'get_field' ) ? get_field( 'home_services_intro_text' ) : '';
	$home_services_cta_text   = function_exists( 'get_field' ) ? get_field( 'home_services_cta_text' ) : '';
	$home_services_cta_link   = function_exists( 'get_field' ) ? get_field( 'home_services_cta_link' ) : '';
	$home_services_banner     = function_exists( 'get_field' ) ? get_field( 'home_services_banner_text' ) : '';
	$home_projects_title      = function_exists( 'get_field' ) ? get_field( 'home_projects_title' ) : '';
	$home_about_title         = function_exists( 'get_field' ) ? get_field( 'home_about_title' ) : '';
	$home_about_image         = function_exists( 'get_field' ) ? get_field( 'home_about_image' ) : '';
	$home_about_intro         = function_exists( 'get_field' ) ? get_field( 'home_about_intro' ) : '';
	$home_about_points        = function_exists( 'get_field' ) ? get_field( 'home_about_points' ) : '';
	$home_team_title          = function_exists( 'get_field' ) ? get_field( 'home_team_title' ) : '';
	$home_contact_title       = function_exists( 'get_field' ) ? get_field( 'home_contact_title' ) : '';
	$home_contact_label       = function_exists( 'get_field' ) ? get_field( 'home_contact_label' ) : '';
	$home_contact_link_text   = function_exists( 'get_field' ) ? get_field( 'home_contact_link_text' ) : '';
	$home_contact_link_url    = function_exists( 'get_field' ) ? get_field( 'home_contact_link_url' ) : '';
	$home_contact_visual      = function_exists( 'get_field' ) ? get_field( 'home_contact_visual_image' ) : '';

	$hero_image_data     = aiagency_wez_get_image_data( $home_hero_image );
	$services_image_data = aiagency_wez_get_image_data( $home_services_image );
	$about_image_data    = aiagency_wez_get_image_data( $home_about_image );
	$contact_image_data  = aiagency_wez_get_image_data( $home_contact_visual );
	$about_points        = aiagency_wez_get_lines( $home_about_points );

	$service_cards = array();
	$project_cards = array();
	$team_members  = array();

	for ( $index = 1; $index <= 3; $index++ ) {
		$image = function_exists( 'get_field' ) ? get_field( 'service_' . $index . '_image' ) : '';
		$title = function_exists( 'get_field' ) ? get_field( 'service_' . $index . '_title' ) : '';
		$text  = function_exists( 'get_field' ) ? get_field( 'service_' . $index . '_text' ) : '';

		if ( $image || $title || $text ) {
			$service_cards[] = array(
				'image' => aiagency_wez_get_image_data( $image ),
				'title' => $title,
				'text'  => $text,
			);
		}
	}

	for ( $index = 1; $index <= 5; $index++ ) {
		$image = function_exists( 'get_field' ) ? get_field( 'project_' . $index . '_image' ) : '';
		$title = function_exists( 'get_field' ) ? get_field( 'project_' . $index . '_title' ) : '';

		if ( $image || $title ) {
			$project_cards[] = array(
				'image' => aiagency_wez_get_image_data( $image ),
				'title' => $title,
			);
		}
	}

	for ( $index = 1; $index <= 4; $index++ ) {
		$image = function_exists( 'get_field' ) ? get_field( 'team_member_' . $index . '_image' ) : '';
		$name  = function_exists( 'get_field' ) ? get_field( 'team_member_' . $index . '_name' ) : '';
		$role  = function_exists( 'get_field' ) ? get_field( 'team_member_' . $index . '_role' ) : '';

		if ( $image || $name || $role ) {
			$team_members[] = array(
				'image' => aiagency_wez_get_image_data( $image ),
				'name'  => $name,
				'role'  => $role,
			);
		}
	}
	?>

	<div class="home-page">
		<?php
		get_template_part(
			'template-parts/sections/home/hero',
			null,
			array(
				'eyebrow'        => $home_hero_eyebrow,
				'title'          => $home_hero_title,
				'image'          => $hero_image_data,
				'primary_text'   => $home_hero_primary_text,
				'primary_link'   => $home_hero_primary_link,
				'secondary_text' => $home_hero_secondary_text,
				'secondary_link' => $home_hero_secondary_link,
			)
		);

		get_template_part(
			'template-parts/sections/home/what-we-do',
			null,
			array(
				'title'       => $home_services_title,
				'image'       => $services_image_data,
				'intro_text'  => $home_services_text,
				'cta_text'    => $home_services_cta_text,
				'cta_link'    => $home_services_cta_link,
				'cards'       => $service_cards,
				'banner_text' => $home_services_banner,
			)
		);

		get_template_part(
			'template-parts/sections/home/projects',
			null,
			array(
				'title'    => $home_projects_title,
				'projects' => $project_cards,
			)
		);

		get_template_part(
			'template-parts/sections/home/who-we-are',
			null,
			array(
				'title'       => $home_about_title,
				'image'       => $about_image_data,
				'intro'       => $home_about_intro,
				'points'      => $about_points,
				'team_title'  => $home_team_title,
				'team_members'=> $team_members,
			)
		);

		get_template_part(
			'template-parts/sections/home/contact',
			null,
			array(
				'title'       => $home_contact_title,
				'label'       => $home_contact_label,
				'link_text'   => $home_contact_link_text,
				'link_url'    => $home_contact_link_url,
				'visual'      => $contact_image_data,
			)
		);
		?>
	</div>
<?php endwhile; ?>

<?php
get_footer();
