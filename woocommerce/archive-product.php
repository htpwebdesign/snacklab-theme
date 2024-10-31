<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined('ABSPATH') || exit;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');

/**
 * Hook: woocommerce_shop_loop_header.
 *
 * @since 8.6.0
 *
 * @hooked woocommerce_product_taxonomy_archive_header - 10
 */
// do_action('woocommerce_shop_loop_header');

// Add the filter menu here
?>
<!-- Filter Menu -->
<?php
// if (is_post_type_archive('product')) {
// 	$product_page_id = wc_get_page_id('shop'); // Get the ID of the shop page
// 	if (has_post_thumbnail($product_page_id)) {
// 		echo '<div class="products-page-banner">';
// 		echo get_the_post_thumbnail($product_page_id, 'full'); // Change 'full' to your desired image size
// 		echo '</div>';
// 	}
// }
?>
<header class="entry-header">
	<h1 class="entry-title-hero"><?php echo get_the_title(124) ?></h1>
		<?php if (is_post_type_archive('product')): 
			$product_page_id = wc_get_page_id('shop');?>
		<div class="hero-picture" >
			<?php echo get_the_post_thumbnail($product_page_id, 'full') ?>
			<div class ="hero-img-overlay"></div>
		</div>
		<?php endif; ?>
</header> 



<?php

if (woocommerce_product_loop()) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action('woocommerce_before_shop_loop');

	?><div class="products-container"><?php ?>

		<div class="filter-menu">
			<!-- Dropdown toggle button for small screens -->
			<button id="dropdown-toggle" class="dropdown-button">Filter Menu</button>
			
			<!-- Dropdown content (buttons) -->
			<div id="dropdown-content" class="dropdown-content">
				<button class="filter-button" data-filter="*">All Items</button>
				<?php
				$terms = get_terms(array(
					'taxonomy' => 'product_cat',
					'hide_empty' => true,
					'exclude' => array(), // Add slugs to exclude if necessary
				));

				if (! empty($terms) && ! is_wp_error($terms)) {
					foreach ($terms as $term) {
						echo '<button class="filter-button" data-filter=".' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</button>';
					}
				}
				?>
			</div>
		</div>
	<?php
	// Add the products-grid container
	echo '<ul class="products-grid">';

	if (wc_get_loop_prop('total')) {
		while (have_posts()) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action('woocommerce_shop_loop');

			wc_get_template_part('content', 'product');
		}
	}

	?></div><?php

	echo '</ul>'; // Close products-grid

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action('woocommerce_after_shop_loop');
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action('woocommerce_no_products_found');
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
// do_action('woocommerce_sidebar');

get_footer('shop');
