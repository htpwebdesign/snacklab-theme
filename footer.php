<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Snack_Lab
 */

?>

	<footer id="colophon" class="site-footer">
		
		<div class="site-branding-footer">
			<h2>
				<a href="<?php echo home_url(); ?>">
					<?php the_field('site_title', 31); ?>
				</a>
			</h2>
		</div><!-- .site-branding -->

		<div class="footer-nav-menu">
			<h3>Navigate The Lab</h3>
			<nav class='footer-navigation'>
				<?php
					wp_nav_menu( array( 'theme_location' => 'footer-navigation' ) );
					?>
			</nav>
		</div>
		<div class='footer-social-menu'>
			<h3>Stay Connected</h3>
			<nav class='footer-navigation'>
				<?php
					wp_nav_menu( array( 'theme_location' => 'footer-social-links' ) );
					?>
			</nav>
			</div>

		<div class="site-info">
			<?php
			printf( esc_html__( '©2024 Snack Lab. All rights reserved | ', 'snacklab-theme' ), 'snacklab-theme' );
			the_privacy_policy_link();
			printf( esc_html__( ' | Created by ', 'snacklab-theme' ), 'snacklab-theme' );
			?>
			<a href="https://www.marcsapa.com/" target="_blank"><?php esc_html_e('Marc', 'snacklab-theme') ?></a>, 
			<a href="https://ghyamamoto.com/" target="_blank"><?php esc_html_e('Gustavo', 'snacklab-theme') ?></a>, 
			<a href="https://hawhawtan.com/" target="_blank"><?php esc_html_e('Haw Haw', 'snacklab-theme') ?></a>, and
			<a href="https://kaleblink.com/" target="_blank"><?php esc_html_e('Kaleb!', 'snacklab-theme') ?></a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>