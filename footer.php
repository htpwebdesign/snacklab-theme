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
		<div>
			<?php the_custom_logo(); ?>
			<h2 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h2>
		</div> <!-- Logo / link to home -->

		<div>
			<section class="footer-nav-menu">
				<h3>Navigate The Lab</h3>
				<nav class='footer-navigation'>
					<?php
						wp_nav_menu( array( 'theme_location' => 'footer-navigation' ) );
						?>
				</nav>
			</section>
			<section class='footer-social-menu'>
				<h3>Stay Connected</h3>
				<nav class='footer-navigation'>
					<?php
						wp_nav_menu( array( 'theme_location' => 'footer-social-links' ) );
						?>
				</nav>
			</section>
		</div> <!-- .footer-menus -->

		<div class="site-info">
			<?php
			printf( esc_html__( '©2024 Snack Lab. All rights reserved | ', 'snacklab-theme' ), 'snacklab-theme' );
			the_privacy_policy_link();
			printf( esc_html__( ' | Created by ', 'snacklab-theme' ), 'snacklab-theme' );
			?>
			<p>
				<a href="https://www.marcsapa.com/" target="_blank"><?php esc_html_e('Marc', 'snacklab-theme') ?></a>, 
				<a href="" target="_blank"><?php esc_html_e('Gustavo', 'snacklab-theme') ?></a>, 
				<a href="https://hawhawtan.com/" target="_blank"><?php esc_html_e('Haw Haw', 'snacklab-theme') ?></a>, and
				<a href="https://kaleblink.com/" target="_blank"><?php esc_html_e('Kaleb!', 'snacklab-theme') ?></a>
			</p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>