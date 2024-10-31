<?php

/**
 * Snack Lab functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Snack_Lab
 */

if (! defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function snacklab_theme_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Snack Lab, use a find and replace
		* to change 'snacklab-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('snacklab-theme', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// Cropping to banner image in Catering/Products Page
	add_image_size('hero-banner', 1792, 550, array('center', 'center'));
	add_image_size('product-thumb', 320, 320, true);

	// This theme uses wp_nav_menu() in one location, and two menus in the footer.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'snacklab-theme'),
			'footer-navigation' => esc_html__('Footer Navigation', 'snacklab-theme'),
			'footer-social-links' => esc_html__('Footer Social Links', 'snacklab-theme'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'snacklab_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'snacklab_theme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function snacklab_theme_content_width()
{
	$GLOBALS['content_width'] = apply_filters('snacklab_theme_content_width', 640);
}
add_action('after_setup_theme', 'snacklab_theme_content_width', 0);



/**
 * Enqueue scripts and styles.
 */
function snacklab_theme_scripts()
{
	wp_enqueue_style('snacklab-theme-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('snacklab-theme-style', 'rtl', 'replace');

	wp_enqueue_script('snacklab-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, array('strategy' => 'defer'));
	wp_enqueue_script('accordion-script', get_template_directory_uri() . '/js/accordion.js', array(), _S_VERSION, array('strategy' => 'defer'));

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	if (is_front_page()) {
		wp_enqueue_style('swiper-styles', get_template_directory_uri() . '/css/swiper-bundle.css', array(), '7.4.1');
		wp_enqueue_script('swiper-scripts', get_template_directory_uri() . '/js/swiper-bundle.min.js', array(), '7.4.1', array('strategy' => 'defer'));
		wp_enqueue_script('swiper-settings', get_template_directory_uri() . '/js/swiper-settings.js', array('swiper-scripts'), _S_VERSION, array('strategy' => 'defer'));
	}

	// Enqueue IsotopeJS
	wp_enqueue_script(
		'isotope-js',
		get_stylesheet_directory_uri() . '/js/isotope.pkgd.min.js',
		array('jquery'), // Dependencies
		'3.0.6', // Version of IsotopeJS
		array('strategy' => 'defer')
	);

	// Enqueue custom filter script
	wp_enqueue_script(
		'snacklab-filter',
		get_stylesheet_directory_uri() . '/js/filter.js',
		array('isotope-js', 'jquery'), // Dependencies
		'1.0',
		array('strategy' => 'defer')
	);

	//Enqueue filter dropdown menu in products
	wp_enqueue_script(
		'filter-dropdown',
		get_template_directory_uri() . '/js/filter-dropdown.js',
		array(),
		'24.10.18',
		array('strategy' => 'defer')
	);


	wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap', null);

	// Enqueue AOS JS
	wp_enqueue_script(
		'aos-js',
		get_stylesheet_directory_uri() . '/js/aos.js',
		array(),
		'2.3.4',
		array('strategy' => 'defer')
	);

	// Enqueue AOS CSS
	wp_enqueue_style(
		'aos-css',
		get_stylesheet_directory_uri() . '/css/aos.css',
		array(),
		'2.3.4'
	);

	wp_add_inline_script('aos-js', 'AOS.init();');
}
add_action('wp_enqueue_scripts', 'snacklab_theme_scripts');

function snacklab_add_cart_count_to_menu($items, $args)
{
	if ($args->theme_location == 'menu-1') {
		$item_count = WC()->cart->get_cart_contents_count();

		if ($item_count > 0) {
			$item_count_text = ' (' . $item_count . ')';
		} else {
			$item_count_text = '';
		}
		$items = str_replace('>Cart<', '>' . $item_count_text . '<', $items);
	}

	return $items;
}
add_filter('wp_nav_menu_items', 'snacklab_add_cart_count_to_menu', 10, 2);

// custom logo to the WordPress login page
function snacklab_custom_login_logo()
{
	echo '<style type="text/css">
		h1 a {
			background-image: url(https://snacklab.bcitwebdeveloper.ca/wp-content/uploads/2024/10/cropped-snacklab.png) !important;
			background-size: contain !important;
			width: 100% !important;
			height: 100px !important;
		}
	</style>';
}
add_action('login_head', 'snacklab_custom_login_logo');

// custom logo URL to the WordPress login page

function snacklab_custom_login_logo_url()
{
	return home_url();
}
add_filter('login_headerurl', 'snacklab_custom_login_logo_url');

// custom logo URL title to the WordPress login page

function snacklab_custom_login_logo_url_title()
{
	return get_bloginfo('name');
}

add_filter('login_headertitle', 'snacklab_custom_login_logo_url_title');






/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Custom Post Types
 */
require get_template_directory() . '/inc/cpt.php';


// Remove the result count (e.g. "Showing 1–10 of 50 results")
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

// Remove the product sorting dropdown
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);


function add_custom_dashboard_widget() {
    wp_add_dashboard_widget(
        'custom_help_widget', // Widget ID
        'If you need help! Check these vidoes!',  // Widget title
        'custom_dashboard_help' // Callback function
    );
}

// function custom_dashboard_help() {
//     echo '<p>Watch the video below to learn how to edit posts:</p>';
//     echo '<iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';

// }

function custom_dashboard_help() {
    $storelocator_url  = "http://localhost/wordpress-snackLab/wp-content/uploads/2024/10/how-to-use-storeLocator.mp4";
    $job_post_url  = "http://localhost/wordpress-snackLab/wp-content/uploads/2024/10/Add-Job-Post.mp4";
    $acf_url  = "http://localhost/wordpress-snackLab/wp-content/uploads/2024/10/Where-to-edit-content.mp4";
    $product_url  = "http://localhost/wordpress-snackLab/wp-content/uploads/2024/10/Adding-product.mp4";

    echo '<p>Watch the video below to learn how to edit job posts:</p>';
    echo '<video width="560" height="315" controls>
            <source src="' . esc_url($job_post_url) . '" type="video/mp4">
            Your browser does not support the video tag.
          </video>';

	echo '<p>Watch the video below to learn how to edit content on each pages:</p>';
	echo '<video width="560" height="315" controls>
			<source src="' . esc_url($acf_url) . '" type="video/mp4">
			Your browser does not support the video tag.
		</video>';

	echo '<p>Watch the video below to learn how to add products:</p>';
	echo '<video width="560" height="315" controls>
			<source src="' . esc_url($product_url) . '" type="video/mp4">
			Your browser does not support the video tag.
		</video>';

	echo '<p>Watch the video below to learn how to add new location:</p>';
	echo '<video width="560" height="315" controls>
			<source src="' . esc_url($storelocator_url) . '" type="video/mp4">
			Your browser does not support the video tag.
		</video>';
}

add_action('wp_dashboard_setup', 'add_custom_dashboard_widget');