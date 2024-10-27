<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Snack_Lab
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'snacklab-theme'); ?></a>

		<header id="masthead" class="site-header">
			<nav id="site-navigation" class="main-navigation">
				<div class="site-branding">
					<h1>
						<h1>
							<a href="<?php echo home_url(); ?>">
								<?php the_field('site_title', 31); ?>
							</a>
						</h1>

						<?php
						$snacklab_theme_description = get_bloginfo('description', 'display');
						if ($snacklab_theme_description || is_customize_preview()) :
						?>
							<p class="site-description"><?php echo $snacklab_theme_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
														?></p>
						<?php endif; ?>
				</div><!-- .site-branding -->

				<!-- Marc Initial Commit -->


				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Primary Menu', 'snacklab-theme'); ?></button>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					)
				);
				?>
				<div class="cart-in-nav">
					<?php
					if (function_exists('snacklab_theme_woocommerce_header_cart')) {
						snacklab_theme_woocommerce_header_cart();
					}
					?>
				</div>
			</nav><!-- #site-navigation -->
			<div class="cart-out-nav">
				<?php
				if (function_exists('snacklab_theme_woocommerce_header_cart')) {
					snacklab_theme_woocommerce_header_cart();
				}
				?>
			</div>
		</header><!-- #masthead -->