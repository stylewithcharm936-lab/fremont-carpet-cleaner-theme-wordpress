<?php
/**
 * Style With Charm Customizer settings
 *
 * @package Style_With_Charm
 */

function swc_customize_register($wp_customize) {
    // 1. General & Hero Section
    $wp_customize->add_section('swc_hero_section', array(
        'title'    => esc_html__('Style With Charm: Hero Section', 'style-with-charm'),
        'priority' => 30,
    ));

    // Logo Text (fallback if no image logo uploaded)
    $wp_customize->add_setting('swc_logo_text', array(
        'default'           => 'Style With Charm',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('swc_logo_text', array(
        'label'    => esc_html__('Header Logo Text', 'style-with-charm'),
        'section'  => 'title_tagline',
        'type'     => 'text',
    ));

    // Hero Eyebrow
    $wp_customize->add_setting('swc_hero_eyebrow', array(
        'default'           => 'Home Decor & Interior Inspiration',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('swc_hero_eyebrow', array(
        'label'    => esc_html__('Hero Eyebrow Text', 'style-with-charm'),
        'section'  => 'swc_hero_section',
        'type'     => 'text',
    ));

    // Hero Title
    $wp_customize->add_setting('swc_hero_title', array(
        'default'           => 'Beautiful Ideas for a Home You’ll Love',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('swc_hero_title', array(
        'label'    => esc_html__('Hero Main Headline', 'style-with-charm'),
        'section'  => 'swc_hero_section',
        'type'     => 'text',
    ));

    // Hero Description
    $wp_customize->add_setting('swc_hero_desc', array(
        'default'           => 'Simple, stylish and inspiring home decor ideas to help you create a space that feels uniquely yours.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('swc_hero_desc', array(
        'label'    => esc_html__('Hero Description', 'style-with-charm'),
        'section'  => 'swc_hero_section',
        'type'     => 'textarea',
    ));

    // Hero CTA Text
    $wp_customize->add_setting('swc_hero_cta_text', array(
        'default'           => 'Explore Inspiration',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('swc_hero_cta_text', array(
        'label'    => esc_html__('Hero Button Text', 'style-with-charm'),
        'section'  => 'swc_hero_section',
        'type'     => 'text',
    ));

    // Hero CTA Link
    $wp_customize->add_setting('swc_hero_cta_link', array(
        'default'           => '#latest',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('swc_hero_cta_link', array(
        'label'    => esc_html__('Hero Button Link', 'style-with-charm'),
        'section'  => 'swc_hero_section',
        'type'     => 'url',
    ));

    // Hero Image
    $wp_customize->add_setting('swc_hero_image', array(
        'default'           => get_template_directory_uri() . '/assets/images/hero-living-room.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'swc_hero_image', array(
        'label'    => esc_html__('Hero Background Image', 'style-with-charm'),
        'section'  => 'swc_hero_section',
    )));

    // 2. Section Titles
    $wp_customize->add_section('swc_section_titles', array(
        'title'    => esc_html__('Style With Charm: Homepage Sections', 'style-with-charm'),
        'priority' => 35,
    ));

    // Category Eyebrow & Title
    $wp_customize->add_setting('swc_cat_eyebrow', array(
        'default'           => 'Browse by room & style',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('swc_cat_eyebrow', array(
        'label'    => esc_html__('Category Section Eyebrow', 'style-with-charm'),
        'section'  => 'swc_section_titles',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('swc_cat_title', array(
        'default'           => 'Explore Home Decor Ideas',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('swc_cat_title', array(
        'label'    => esc_html__('Category Section Heading', 'style-with-charm'),
        'section'  => 'swc_section_titles',
        'type'     => 'text',
    ));

    // Editor's Picks Heading
    $wp_customize->add_setting('swc_editors_title', array(
        'default'           => 'Editor’s Picks',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('swc_editors_title', array(
        'label'    => esc_html__('Editor’s Picks Heading', 'style-with-charm'),
        'section'  => 'swc_section_titles',
        'type'     => 'text',
    ));

    // Latest Posts Heading
    $wp_customize->add_setting('swc_latest_title', array(
        'default'           => 'Latest Inspiration',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('swc_latest_title', array(
        'label'    => esc_html__('Latest Posts Feed Heading', 'style-with-charm'),
        'section'  => 'swc_section_titles',
        'type'     => 'text',
    ));

    // Newsletter Section
    $wp_customize->add_setting('swc_newsletter_title', array(
        'default'           => 'Get Beautiful Home Ideas in Your Inbox',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('swc_newsletter_title', array(
        'label'    => esc_html__('Newsletter Heading', 'style-with-charm'),
        'section'  => 'swc_section_titles',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('swc_newsletter_desc', array(
        'default'           => 'Fresh decor inspiration, styling ideas and beautiful spaces delivered to your inbox.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('swc_newsletter_desc', array(
        'label'    => esc_html__('Newsletter Subtitle', 'style-with-charm'),
        'section'  => 'swc_section_titles',
        'type'     => 'textarea',
    ));

    // 3. Social & Footer
    $wp_customize->add_section('swc_social_section', array(
        'title'    => esc_html__('Style With Charm: Social & Footer', 'style-with-charm'),
        'priority' => 40,
    ));

    $wp_customize->add_setting('swc_footer_bio', array(
        'default'           => 'Simple, stylish and inspiring home decor ideas — thoughtfully collected to help you create a space that feels uniquely yours.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('swc_footer_bio', array(
        'label'    => esc_html__('Footer Brand Description', 'style-with-charm'),
        'section'  => 'swc_social_section',
        'type'     => 'textarea',
    ));

    $wp_customize->add_setting('swc_pinterest_url', array(
        'default'           => 'https://www.pinterest.com/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('swc_pinterest_url', array(
        'label'    => esc_html__('Pinterest Profile URL', 'style-with-charm'),
        'section'  => 'swc_social_section',
        'type'     => 'url',
    ));

    $wp_customize->add_setting('swc_instagram_url', array(
        'default'           => 'https://www.instagram.com/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('swc_instagram_url', array(
        'label'    => esc_html__('Instagram Profile URL', 'style-with-charm'),
        'section'  => 'swc_social_section',
        'type'     => 'url',
    ));

    $wp_customize->add_setting('swc_facebook_url', array(
        'default'           => 'https://www.facebook.com/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('swc_facebook_url', array(
        'label'    => esc_html__('Facebook Page URL', 'style-with-charm'),
        'section'  => 'swc_social_section',
        'type'     => 'url',
    ));
}
add_action('customize_register', 'swc_customize_register');
