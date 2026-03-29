<?php
/**
 * Template Name: Contact Page
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

	$contact_title       = function_exists( 'get_field' ) ? get_field( 'contact_title' ) : '';
	$contact_description = function_exists( 'get_field' ) ? get_field( 'contact_description' ) : '';
	$contact_email       = function_exists( 'get_field' ) ? get_field( 'contact_email' ) : '';
	$contact_phone       = function_exists( 'get_field' ) ? get_field( 'contact_phone' ) : '';
	$contact_address     = function_exists( 'get_field' ) ? get_field( 'contact_address' ) : '';
	$contact_map_embed   = function_exists( 'get_field' ) ? get_field( 'contact_map_embed' ) : '';
	$page_heading        = $contact_title ? $contact_title : get_the_title();
	?>

	<section class="section">
		<div class="section__inner">
			<article class="contact-card">
				<header class="entry-header">
					<p class="section__eyebrow"><?php esc_html_e( 'Contact Page', 'aiagency-wez' ); ?></p>
					<h1 class="entry-title"><?php echo esc_html( $page_heading ); ?></h1>

					<?php if ( $contact_description ) : ?>
						<p class="entry-intro"><?php echo esc_html( $contact_description ); ?></p>
					<?php endif; ?>
				</header>

				<div class="contact-details">
					<?php if ( $contact_email ) : ?>
						<div class="contact-details__item">
							<strong><?php esc_html_e( 'Email', 'aiagency-wez' ); ?></strong>
							<a href="<?php echo esc_url( 'mailto:' . sanitize_email( $contact_email ) ); ?>">
								<?php echo esc_html( antispambot( $contact_email ) ); ?>
							</a>
						</div>
					<?php endif; ?>

					<?php if ( $contact_phone ) : ?>
						<div class="contact-details__item">
							<strong><?php esc_html_e( 'Phone', 'aiagency-wez' ); ?></strong>
							<a href="<?php echo esc_url( 'tel:' . preg_replace( '/[^0-9+]/', '', (string) $contact_phone ) ); ?>">
								<?php echo esc_html( $contact_phone ); ?>
							</a>
						</div>
					<?php endif; ?>

					<?php if ( $contact_address ) : ?>
						<div class="contact-details__item">
							<strong><?php esc_html_e( 'Address', 'aiagency-wez' ); ?></strong>
							<div><?php echo nl2br( esc_html( $contact_address ) ); ?></div>
						</div>
					<?php endif; ?>
				</div>

				<?php if ( $contact_map_embed ) : ?>
					<div class="contact-map">
						<?php echo wp_kses( $contact_map_embed, aiagency_wez_allowed_iframe_html() ); ?>
					</div>
				<?php endif; ?>
			</article>
		</div>
	</section>
<?php endwhile; ?>

<?php
get_footer();
