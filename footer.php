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
		<section>
			<?php the_custom_logo(); ?>
			<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
		</section> <!-- Logo / link to home -->

		<section>
			<div class="footer-nav-menu">
				<h2>Navigate The Lab</h2>
				<nav class='footer-navigation'>
					<?php
						wp_nav_menu( array( 'theme_location' => 'footer-navigation' ) );
						?>
				</nav>
			</div>
			<div class='footer-social-menu'>
				<h2>Stay Connected</h2>
				<nav class='footer-navigation'>
					<?php
						wp_nav_menu( array( 'theme_location' => 'footer-social-links' ) );
						?>
				</nav>
			</div>
		</section> <!-- .footer-menus -->

		<section class="site-info">
			<?php
			printf( esc_html__( '©2024 Snack Lab. All rights reserved | ', 'snacklab-theme' ), 'snacklab-theme' );
			the_privacy_policy_link();
			printf( esc_html__( ' | Created by Marc, Gustavo, Haw Haw and Kaleb!', 'snacklab-theme' ), 'snacklab-theme' );
			?>
		</section><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>