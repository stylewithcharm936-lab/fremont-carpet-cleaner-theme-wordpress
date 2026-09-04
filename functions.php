<?php
/**
 * Style With Charm functions and definitions
 *
 * @package Style_With_Charm
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function swc_theme_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title.
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');

    // Custom image sizes for editorial layouts
    add_image_size('swc-card', 600, 750, false);
    add_image_size('swc-lead', 1200, 825, true);
    add_image_size('swc-category', 400, 500, true);

    // Register navigation menus.
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'style-with-charm'),
        'footer'  => esc_html__('Footer Menu', 'style-with-charm'),
    ));

    // Switch default core markup for search form, comment form, etc. to HTML5.
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Add support for core custom logo.
    add_theme_support('custom-logo', array(
        'height'      => 80,
        'width'       => 300,
        'flex-width'  => true,
        'flex-height' => true,
    ));

    // Responsive embedded content
    add_theme_support('responsive-embeds');

    // Align wide support
    add_theme_support('align-wide');
}
add_action('after_setup_theme', 'swc_theme_setup');

/**
 * Enqueue scripts and styles.
 */
function swc_scripts() {
    // Google Fonts: Cormorant Garamond & Jost
    wp_enqueue_style(
        'swc-google-fonts',
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Jost:wght@300;400;500;600&display=swap',
        array(),
        null
    );

    // Theme Main Stylesheet
    wp_enqueue_style('swc-style', get_stylesheet_uri(), array('swc-google-fonts'), '1.0.0');

    // Theme Main JavaScript
    wp_enqueue_script(
        'swc-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        '1.0.0',
        true
    );

    // Pass AJAX parameters to script
    wp_localize_script('swc-main', 'swc_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('swc_load_more_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'swc_scripts');

/**
 * AJAX handler for Load More posts.
 */
function swc_ajax_load_more() {
    check_ajax_referer('swc_load_more_nonce', 'nonce');

    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $category_id = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;
    $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';

    $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 12,
        'paged'          => $page,
    );

    if ($category_id > 0) {
        $args['cat'] = $category_id;
    }

    if (!empty($search)) {
        $args['s'] = $search;
    }

    $query = new WP_Query($args);
    ob_start();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/content-card');
        }
        wp_reset_postdata();
    }

    $html = ob_get_clean();

    wp_send_json_success(array(
        'html'      => $html,
        'max_pages' => $query->max_num_pages,
        'page'      => $page,
    ));
}
add_action('wp_ajax_swc_load_more', 'swc_ajax_load_more');
add_action('wp_ajax_nopriv_swc_load_more', 'swc_ajax_load_more');

/**
 * Helper to get a cover image for a category.
 * Looks for the latest post with a thumbnail in that category.
 */
function swc_get_category_cover($cat_id) {
    $q = new WP_Query(array(
        'cat'            => $cat_id,
        'posts_per_page' => 1,
        'meta_key'       => '_thumbnail_id',
    ));

    if ($q->have_posts()) {
        $q->the_post();
        $thumb = get_the_post_thumbnail_url(get_the_ID(), 'swc-category');
        wp_reset_postdata();
        if ($thumb) return $thumb;
    }

    return get_template_directory_uri() . '/assets/images/category-fallback.jpg';
}

/**
 * Filter excerpt length.
 */
function swc_custom_excerpt_length($length) {
    return 18;
}
add_filter('excerpt_length', 'swc_custom_excerpt_length', 999);

/**
 * Filter excerpt more string.
 */
function swc_excerpt_more($more) {
    return '…';
}
add_filter('excerpt_more', 'swc_excerpt_more');

/**
 * Customizer additions.
 */
require_once get_template_directory() . '/inc/customizer.php';
