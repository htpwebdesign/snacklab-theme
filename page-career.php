<?php
/**
 * The template for displaying Careers pages
 *
 * @package Snack_Lab
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );
			$args = array(
				'post_type' => 'snacklab-careers', // Custom post type
				'posts_per_page' => -1,   // Fetch all career posts
			);
			$careers_query = new WP_Query( $args );
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			if ( $careers_query->have_posts() ) :
				while ( $careers_query->have_posts() ) : $careers_query->the_post();
			?>
		
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<h2 class="entry-title"><?php the_title(); ?></h2>
						</header><!-- .entry-header -->
		
						<div class="entry-content">
							<?php if (function_exists('get_field')) :

							if (get_field('job_description_')) :
							?>
								<p><?php the_field('job_description_'); ?></p>
							<?php
							endif;

						endif; ?>
							
						</div><!-- .entry-content -->
					</article><!-- #post-<?php the_ID(); ?> -->
		
			<?php
				endwhile;
				wp_reset_postdata(); // Restore global post data
			else :
				echo '<p>No careers found.</p>';
			endif;
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
