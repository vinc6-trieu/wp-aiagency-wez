<?php
/**
 * Home V1 team section.
 *
 * @package aiagency-wez
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = wp_parse_args(
	$args,
	array(
		'title'   => '',
		'intro'   => '',
		'members' => array(),
	)
);

if ( empty( $args['members'] ) ) {
	return;
}
?>

<section id="team" class="home-v1-section home-v1-section--team">
	<div class="home-v1-shell">
		<div class="home-v1-split-heading">
			<div class="home-v1-split-heading__main">
				<?php if ( $args['title'] ) : ?>
					<h2><?php echo esc_html( $args['title'] ); ?></h2>
				<?php endif; ?>
				<span class="home-v1-split-heading__line" aria-hidden="true"></span>
			</div>

			<?php if ( $args['intro'] ) : ?>
				<p class="home-v1-split-heading__intro"><?php echo esc_html( $args['intro'] ); ?></p>
			<?php endif; ?>
		</div>

		<div class="home-v1-team-grid">
			<?php foreach ( $args['members'] as $member ) : ?>
				<article class="home-v1-team-card">
					<div class="home-v1-team-card__photo">
						<?php if ( ! empty( $member['image']['url'] ) ) : ?>
							<img src="<?php echo esc_url( $member['image']['url'] ); ?>" alt="<?php echo esc_attr( $member['image']['alt'] ); ?>">
						<?php else : ?>
							<div class="home-v1-team-card__placeholder" aria-hidden="true"></div>
						<?php endif; ?>
					</div>
					<?php if ( ! empty( $member['name'] ) ) : ?>
						<h3><?php echo esc_html( $member['name'] ); ?></h3>
					<?php endif; ?>
					<?php if ( ! empty( $member['role'] ) ) : ?>
						<p><?php echo esc_html( $member['role'] ); ?></p>
					<?php endif; ?>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
