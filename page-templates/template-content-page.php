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
				<nav class="content-page__breadcrumb" aria-label="<?php esc_attr_e( 'Breadcrumb', 'aiagency-wez' ); ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'aiagency-wez' ); ?></a>
					<span class="content-page__breadcrumb-separator" aria-hidden="true">/</span>
					<span aria-current="page"><?php the_title(); ?></span>
				</nav>
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
