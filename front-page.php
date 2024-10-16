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

	while (have_posts()) :
		the_post();

		get_template_part('template-parts/content', 'page');

		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()) :
			comments_template();
		endif;

	endwhile; // End of the loop.
	?>

	<section class="hero">
		<?php

		echo '<article class="hero-article">';

		//ACF hero_gallery field
		$hero_gallery = get_field('hero_gallery');
		if ($hero_gallery) {
			echo '<div class="swiper">';
			echo '<div class="swiper-wrapper">';
			foreach ($hero_gallery as $image) {
				echo '<div class="swiper-slide">';
				echo '<img src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '">';
				echo '</div>';
			}
			echo '</div>';
			// Pagination
			echo '<div class="swiper-pagination"></div>';
			// Navigation buttons
			echo '<div class="swiper-button-prev"></div>';
			echo '<div class="swiper-button-next"></div>';
			// Scrollbar
			echo '<div class="swiper-scrollbar"></div>';
			echo '</div>';
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
		echo '</article>';
		?>

	</section>

	<?php

	// Announcement Scroller

	$announcement_scroller = get_field('announcement_scroller');

	if ($announcement_scroller) {
		echo '<div class="announcement-scroller">';
		echo '<p>' . esc_html($announcement_scroller) . '</p>';
		echo '</div>';
	}

	// ACF repeater field 'cards'
	if (have_rows('cards')) {
		echo '<section class="cards">';
		while (have_rows('cards')) {
			the_row();
			$card_image = get_sub_field('card_image');
			$card_title = get_sub_field('card_title');
			$card_description = get_sub_field('card_description');
			$card_link = get_sub_field('card_link');

			echo '<article class="card">';
			if ($card_image) {
				echo '<img src="' . esc_url($card_image['url']) . '" alt="' . esc_attr($card_image['alt']) . '">';
			}
			if ($card_title) {
				echo '<h2>' . esc_html($card_title) . '</h2>';
			}
			if ($card_description) {
				echo '<p>' . esc_html($card_description) . '</p>';
			}
			if ($card_link) {
				echo '<a href="' . esc_url($card_link['url']) . '">' . esc_html($card_link['title']) . '</a>';
			}
			echo '</article>';
		}
		echo '</section>';
	}

	// Announcement Scroller

	$announcement_scroller = get_field('announcement_scroller');

	if ($announcement_scroller) {
		echo '<div class="announcement-scroller">';
		echo '<p>' . esc_html($announcement_scroller) . '</p>';

		echo '</div>';
	}

	?>

	<section class="review-section">

		<?php

		// ACF repeater field 'testimonials'

		// ACF field 'review_section_title'
		$review_section_title = get_field('review_section_title');

		if ($review_section_title) {
			echo '<div class="review-section-title">';
			echo '<h2>' . esc_html($review_section_title) . '</h2>';
			echo '</div>';
		}


		if (have_rows('reviews')) {
			echo '<article class="reviews">';
			while (have_rows('reviews')) {
				the_row();
				$review_name = get_sub_field('review_name');
				$review_content = get_sub_field('review_content');
				$review_stars = get_sub_field('review_stars');

				echo '<div class="review">';
				if ($review_name) {
					echo '<h3>' . esc_html($review_name) . '</h3>';
				}
				if ($review_content) {
					echo '<p>' . esc_html($review_content) . '</p>';
				}
				if ($review_stars) {
					echo '<div class="review-stars">';
					for ($i = 0; $i < $review_stars; $i++) {
						echo '<span class="star">&#9733;</span>'; // Unicode star character
					}
					echo '</div>';
				}
				echo '</div>';
			}
			echo '</article>';
		}

		// ACF CTA
		$review_cta = get_field('review_cta');

		if ($review_cta) {
			echo '<div class="review-cta">';
			echo '<h2>' . esc_html($review_cta) . '</h2>';
			echo '</div>';
		}
		?>

	</section>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
?>