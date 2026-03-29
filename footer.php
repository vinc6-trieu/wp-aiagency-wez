<?php
/**
 * Theme footer.
 *
 * @package aiagency-wez
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	</main>

	<footer class="site-footer">
		<div class="site-footer__inner">
			<p>
				<?php
				printf(
					/* translators: %s: current year. */
					esc_html__( '© %s aiagency-wez. Built for Local development.', 'aiagency-wez' ),
					esc_html( gmdate( 'Y' ) )
				);
				?>
			</p>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>
</body>
</html>
