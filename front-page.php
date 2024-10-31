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


get_header();
?>

<main id="primary" class="site-main">

	<?php

	while (have_posts()) :
		the_post();
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
					echo '<div class="swiper-slide" data-swiper-autoplay="3500">';
					echo '<img src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '">';
					echo '</div>';
				}
				echo '</div>';

				// Navigation buttons
				echo '<button class="swiper-button-prev"></button>';
				echo '<button class="swiper-button-next"></button>';
				// Scrollbar
				echo '<div class="swiper-scrollbar"></div>';
				echo '</div>';
			}



			//ACF hero_title field
			$hero_title = get_field('hero_text');

			echo '<div class="hero-text-container">';

			if ($hero_title) {

				echo '<h1 class="hero-text">' .  $hero_title . '</h1>';
			}

			// ACF Hero Description 
			$hero_description = get_field('hero_description');

			if ($hero_description) {
				echo '<p class="hero-description">' . esc_html($hero_description) . '</p>';
			}

			echo '<div class="cta-buttons">';

			// ACF Link field 'cta_home_one'
			$cta_home_one = get_field('cta_home_one');

			if ($cta_home_one) {


				echo '<a href="' . esc_url($cta_home_one) . '" class="cta-home-one">View Menu</a>';
			}

			// ACF Link field 'cta_home_two'
			$cta_home_two = get_field('cta_home_two');

			if ($cta_home_two) {


				echo '<a href="' . esc_url($cta_home_two) . '" class="cta-home-two">See Our Locations</a>';
			}

			echo '</div>';

			echo '</div>';

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
		if (function_exists('have_rows') && have_rows('cards')) {
			echo '<section class="cards">';
			while (have_rows('cards')) {
				the_row();
				if (function_exists('get_sub_field')) {
					$card_image_id = get_sub_field('card_image');
					$card_title = get_sub_field('card_title');
					$card_description = get_sub_field('card_description');
					$card_link = get_sub_field('card_link');
				}

				echo '<div class="card">';
				if (!empty($card_image_id)) {  // Ensure that card_image_id is not empty
					$image_url = wp_get_attachment_image_url($card_image_id, 'medium');
					if ($image_url) {
						echo '<img loading="lazy" src="' . esc_url($image_url) . '" alt="' . esc_attr($card_title) . '">';
					}
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
				echo '</div>'; // Close the card div
			}
			echo '</section>'; // Close the section
		}


		// ACF repeater field 'announcement_repeater'

		if (have_rows('announcement_repeater')) {
			echo '<section class="announcement-repeater">';
			while (have_rows('announcement_repeater')) {
				the_row();
				$announcement_image_id = get_sub_field('announcement_image');
				$announcement_title = get_sub_field('announcement_title');
				$announcement_description = get_sub_field('announcement_description');


		?>

		<?php


				echo '<div class="announcement" data-aos="fade-up">';
				if (!empty($announcement_image_id)) {
					$image_url = wp_get_attachment_image_url($announcement_image_id, 'medium');
					if ($image_url) {
						echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($announcement_title) . '">';
					}
				}
				echo '<div class="announcement-content">';
				if ($announcement_title) {
					echo '<h2>' . esc_html($announcement_title) . '</h2>';
				}
				if ($announcement_description) {
					echo '<p>' . esc_html($announcement_description) . '</p>';
				}
				echo '</div>'; // Close the announcement-content div
				echo '</div>'; // Close the announcement div
			}
			echo '</section>'; // Close the section
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
				echo '<article class="reviews reviews-row-1">';
				while (have_rows('reviews')) {
					the_row();
					$review_name = get_sub_field('review_name');
					$review_stars = get_sub_field('review_stars');

					echo '<div class="review">';
					if ($review_name) {
						echo '<h3>' . esc_html($review_name) . '</h3>';
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

				// duplicate here for the infinite loop effect of row one
				while (have_rows('reviews')) {
					the_row();
					$review_name = get_sub_field('review_name');
					$review_stars = get_sub_field('review_stars');

					echo '<div class="review">';
					if ($review_name) {
						echo '<h3>' . esc_html($review_name) . '</h3>';
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

			if (have_rows('reviews')) {
				echo '<article class="reviews reviews-row-2">';
				while (have_rows('reviews')) {
					the_row();
					$review_name = get_sub_field('review_name');
					$review_stars = get_sub_field('review_stars');

					echo '<div class="review">';
					if ($review_name) {
						echo '<h3>' . esc_html($review_name) . '</h3>';
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

				// duplicate here for the infinite loop effect of row two!
				while (have_rows('reviews')) {
					the_row();
					$review_name = get_sub_field('review_name');
					$review_stars = get_sub_field('review_stars');

					echo '<div class="review">';
					if ($review_name) {
						echo '<h3>' . esc_html($review_name) . '</h3>';
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
				echo '<a href="' . esc_html($review_cta) . '"><h2>Order Now!</h2></a>';
				echo '</div>';
			}
			?>

		</section>

	<?php


		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()) :
			comments_template();
		endif;

	endwhile; // End of the loop.
	?>

	<?php


	?>

</main><!-- #main -->

<?php
get_footer();
?>