<?php
/**
 * Default page template.
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
	<article <?php post_class( 'entry-content' ); ?>>
		<header class="entry-header">
			<p class="section__eyebrow"><?php esc_html_e( 'Page', 'aiagency-wez' ); ?></p>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>

		<div class="entry-body">
			<?php the_content(); ?>
		</div>
	</article>
<?php endwhile; ?>

<?php
get_footer();
