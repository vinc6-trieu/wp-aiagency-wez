<?php
/**
 * Template Name: About Page
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

	$about_title         = function_exists( 'get_field' ) ? get_field( 'about_title' ) : '';
	$about_content       = function_exists( 'get_field' ) ? get_field( 'about_content' ) : '';
	$team_section_title  = function_exists( 'get_field' ) ? get_field( 'team_section_title' ) : '';
	$team_members        = function_exists( 'get_field' ) ? get_field( 'team_members' ) : '';
	$team_member_lines   = aiagency_wez_get_lines( $team_members );
	$page_heading        = $about_title ? $about_title : get_the_title();
	?>

	<section class="section">
		<div class="section__inner">
			<article class="entry-content">
				<header class="entry-header">
					<p class="section__eyebrow"><?php esc_html_e( 'About Page', 'aiagency-wez' ); ?></p>
					<h1 class="entry-title"><?php echo esc_html( $page_heading ); ?></h1>
				</header>

				<?php if ( $about_content ) : ?>
					<div class="entry-body">
						<?php echo wp_kses_post( $about_content ); ?>
					</div>
				<?php elseif ( get_the_content() ) : ?>
					<div class="entry-body">
						<?php the_content(); ?>
					</div>
				<?php endif; ?>
			</article>
		</div>
	</section>

	<?php if ( $team_section_title || ! empty( $team_member_lines ) ) : ?>
		<section class="section">
			<div class="section__inner">
				<?php if ( $team_section_title ) : ?>
					<h2 class="section__title"><?php echo esc_html( $team_section_title ); ?></h2>
				<?php endif; ?>

				<?php if ( ! empty( $team_member_lines ) ) : ?>
					<ul class="team-list">
						<?php foreach ( $team_member_lines as $team_member ) : ?>
							<li><?php echo esc_html( $team_member ); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>
<?php endwhile; ?>

<?php
get_footer();
