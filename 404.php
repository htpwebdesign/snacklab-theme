<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Snack_Lab
 */

get_header();
?>

<main id="primary" class="site-main">

	<section class="error-404 not-found">
		<header class="page-header">
			<h1 class="page-title"><?php esc_html_e('You are not supposed to be here!', 'snacklab-theme'); ?></h1>
		</header><!-- .page-header -->
		
		<div class="page-content">
			<img src="https://snacklab.bcitwebdeveloper.ca/wp-content/uploads/2024/10/donut-404-nobackground.png" alt="404 Donut Image">
			<p><a href="<?php echo home_url(); ?>">Go get some<br>SNACK<span class="color-orange">LAB</span></p></a>
		</div><!-- .page-content -->
	</section><!-- .error-404 -->

</main><!-- #main -->

<?php
get_footer();
