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
        if ( $careers_query->have_posts() ) :
            while ( $careers_query->have_posts() ) : $careers_query->the_post();
        ?>

        <div class="accordion">
            <!-- Accordion button (click to expand/collapse content) -->
            <button class="accordion-btn">
                <h2><?php the_title(); ?></h2>
            </button>

            <!-- Accordion content (initially hidden) -->
            <div class="accordion-content">
                <div class="entry-content">
                    <?php if (function_exists('get_field')) : ?>
                        <?php if (get_field('job_description')) : ?>
                            <p><?php the_field('job_description'); ?></p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php
            endwhile;
            wp_reset_postdata(); // Restore global post data
            echo do_shortcode("[gravityform id=3 title=true]");
        else :
            echo '<p>No careers found.</p>';
        endif;
    endwhile; // End of the loop.
    ?>

</main>
<?php
// get_sidebar();
get_footer();
