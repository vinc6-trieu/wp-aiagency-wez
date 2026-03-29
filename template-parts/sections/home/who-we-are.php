<?php
/**
 * Home who we are section.
 *
 * @package aiagency-wez
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	$args,
	array(
		'title'        => '',
		'image'        => array(),
		'intro'        => '',
		'points'       => array(),
		'team_title'   => '',
		'team_members' => array(),
	)
);

if ( empty( $args['title'] ) && empty( $args['intro'] ) && empty( $args['team_members'] ) ) {
	return;
}
?>

<section id="who-we-are" class="home-section home-section--soft">
	<div class="home-shell">
		<div class="home-section-heading">
			<h2><?php echo esc_html( $args['title'] ? $args['title'] : __( 'Who We Are', 'aiagency-wez' ) ); ?></h2>
		</div>

		<div class="home-about-grid">
			<?php if ( ! empty( $args['image']['url'] ) ) : ?>
				<div class="home-about-visual">
					<img src="<?php echo esc_url( $args['image']['url'] ); ?>" alt="<?php echo esc_attr( $args['image']['alt'] ); ?>">
				</div>
			<?php endif; ?>

			<div class="home-about-copy">
				<?php if ( $args['intro'] ) : ?>
					<p class="home-about-copy__lead"><?php echo esc_html( $args['intro'] ); ?></p>
				<?php endif; ?>

				<?php if ( ! empty( $args['points'] ) && is_array( $args['points'] ) ) : ?>
					<ul class="home-about-list">
						<?php foreach ( $args['points'] as $point ) : ?>
							<li><?php echo esc_html( $point ); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>

		<?php if ( ! empty( $args['team_members'] ) && is_array( $args['team_members'] ) ) : ?>
			<div class="home-section-heading home-section-heading--spaced">
				<h2><?php echo esc_html( $args['team_title'] ? $args['team_title'] : __( 'Our Team', 'aiagency-wez' ) ); ?></h2>
			</div>

			<div class="home-team-grid">
				<?php foreach ( $args['team_members'] as $member ) : ?>
					<article class="home-team-card">
						<?php if ( ! empty( $member['image']['url'] ) ) : ?>
							<div class="home-team-card__image">
								<img src="<?php echo esc_url( $member['image']['url'] ); ?>" alt="<?php echo esc_attr( $member['image']['alt'] ); ?>">
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $member['name'] ) ) : ?>
							<h3><?php echo esc_html( $member['name'] ); ?></h3>
						<?php endif; ?>

						<?php if ( ! empty( $member['role'] ) ) : ?>
							<p><?php echo esc_html( $member['role'] ); ?></p>
						<?php endif; ?>
					</article>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
