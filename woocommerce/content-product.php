<?php

/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || ! $product->is_visible()) {
	return;
}

// Get product categories
$terms = get_the_terms(get_the_ID(), 'product_cat');
$category_classes = 'product-item'; // Base class for Isotope

if ($terms && ! is_wp_error($terms)) {
	foreach ($terms as $term) {
		$category_classes .= ' ' . sanitize_html_class($term->slug);
	}
}

?>

<li <?php wc_product_class($category_classes, $product); ?>>
    <?php
     
     /**
      * Hook: woocommerce_before_shop_loop_item.
      *
      * @hooked woocommerce_template_loop_product_link_open - 10
      */
      do_action('woocommerce_before_shop_loop_item');
      
      // Display the product thumbnail with the custom size
      echo woocommerce_get_product_thumbnail('product-thumb');
      
      /**
       * Hook: woocommerce_shop_loop_item_title.
       *
       * @hooked woocommerce_template_loop_product_title - 10
       */
      do_action('woocommerce_shop_loop_item_title');

    /**
     * Hook: woocommerce_after_shop_loop_item_title.
     *
     * @hooked woocommerce_template_loop_rating - 5
     * @hooked woocommerce_template_loop_price - 10
     */
    do_action('woocommerce_after_shop_loop_item_title');

    /**
     * Hook: woocommerce_after_shop_loop_item.
     *
     * @hooked woocommerce_template_loop_product_link_close - 5
     * @hooked woocommerce_template_loop_add_to_cart - 10
     */
    do_action('woocommerce_after_shop_loop_item');
    ?>
</li>
