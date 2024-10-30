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
    while (have_posts()) :
        the_post();
        ?>
        <header class="entry-header">
             <?php the_title('<h1 class="entry-title-hero">', '</h1>'); ?>
             <?php if (has_post_thumbnail()) : ?>
                <div class="hero-picture" >
                    <?php the_post_thumbnail(); ?>
                </div>
                <?php endif; ?>
        </header>
        <div class ="hero-img-overlay"></div>
            

        <div class="content-wrapper">
            <?php the_content();?>
        <?php
            $args = array(
                'post_type' => 'snacklab-careers', // Custom post type
                'posts_per_page' => -1,   // Fetch all career posts
            );
            $careers_query = new WP_Query($args);
        if ($careers_query->have_posts()) :
            ?>
        <div class="accordion-list">
            <?php
                while ($careers_query->have_posts()) : $careers_query->the_post();
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
      
    <?php endwhile;?>
        </div>
        <?php
        wp_reset_postdata();?> 
        <div class="form-career">
            <?php echo do_shortcode("[gravityform id=3 title=true]");?>
        </div>
    <?php else :
        echo '<p>No careers found.</p>';
        endif;
    endwhile; // End of the loop.
    ?>
  </div>
</main>
<?php

get_footer();
