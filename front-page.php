<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Snack_Lab
 */

// Ensure ACF plugin is active
if (!function_exists('get_field')) {
	echo 'ACF plugin is not active. Please activate the plugin.';
	get_footer();
	exit;
}

get_header();
?>

<main id="primary" class="site-main">

	<?php

	//ACF hero_gallery field
	$hero_gallery = get_field('hero_gallery');
	if ($hero_gallery) {
		echo '<div class="hero-slider-container">';
		foreach ($hero_gallery as $image) {
			echo '<div class="hero-slide">';
			echo '<img src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '">';
			echo '</div>';
		}
		echo '</div>';
		// Pagination
		echo '<div class="swiper-pagination"></div>';
		echo '<div class="swiper-button-next"></div>';
		echo '<div class="swiper-button-prev"></div>';
	}


	//ACF hero_title field
	$hero_title = get_field('hero_text');

	if ($hero_title) {
		echo '<div class="hero-text">';
		echo '<h1>' . esc_html($hero_title) . '</h1>';
		echo '</div>';
	}

	// ACF Hero Description 
	$hero_description = get_field('hero_description');

	if ($hero_description) {
		echo '<div class="hero-description">';
		echo '<p>' . esc_html($hero_description) . '</p>';
		echo '</div>';
	}

	?>

	<?php

	while (have_posts()) :
		the_post();

		get_template_part('template-parts/content', 'page');

		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()) :
			comments_template();
		endif;

	endwhile; // End of the loop.
	?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
?>