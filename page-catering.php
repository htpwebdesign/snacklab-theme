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
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
			</header><!-- .entry-header -->

	        <?php if (has_post_thumbnail()) : ?>
            <?php $thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>
            <div class="hero-picture" style="--hero-bg-image: url('<?php echo esc_url($thumbnail_url); ?>');">
                
            </div>
        	<?php endif; ?>
			<div class="entry-content">
				<?php
				the_content();
				?>
				<div class="catering-gallery">
					<?php
					$images = get_field('catering_gallery');
					if ($images) {
						foreach ($images as $image) {
							echo '<div class="catering-item">';
							echo wp_get_attachment_image($image['ID'], 'full');
							if (!empty($image['description'])) {
								echo '<div class="catering-text-wrapper"><p>' . esc_html($image['description']) . '</div></p>';
							}
							echo '</div>';
						}
					}
					?>
				</div>

				<div class="form-catering">
					<?php
					echo do_shortcode('[gravityform id="1" title="true"]');
					?>
				</div>
			</div><!-- .entry-content -->

		</article>
	<?php
	endwhile; // End of the loop.
	?>

</main><!-- #main -->

<?php
get_footer();
