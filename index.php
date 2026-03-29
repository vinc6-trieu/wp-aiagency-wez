<?php
/**
 * Fallback template.
 *
 * @package aiagency-wez
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<article <?php post_class( 'entry-content' ); ?>>
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>

			<div class="entry-body">
				<?php the_content(); ?>
			</div>
		</article>
	<?php endwhile; ?>
<?php else : ?>
	<section class="entry-content">
		<h1 class="entry-title"><?php esc_html_e( 'Nothing found', 'aiagency-wez' ); ?></h1>
		<p><?php esc_html_e( 'There is no content to display yet.', 'aiagency-wez' ); ?></p>
	</section>
<?php endif; ?>

<?php
get_footer();
