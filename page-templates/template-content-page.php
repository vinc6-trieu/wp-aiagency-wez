<?php
/**
 * Template Name: Content Page
 * Template Post Type: page
 *
 * @package aiagency-wez
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<?php while ( have_posts() ) : ?>
	<?php the_post(); ?>
	<article <?php post_class( 'content-page' ); ?>>
		<div class="content-page__inner">
			<header class="content-page__header">
				<p class="content-page__eyebrow"><?php esc_html_e( 'Content Page', 'aiagency-wez' ); ?></p>
				<h1 class="content-page__title"><?php the_title(); ?></h1>
			</header>

			<div class="content-page__content">
				<?php the_content(); ?>
			</div>
		</div>
	</article>
<?php endwhile; ?>

<?php
get_footer();
