<?php
/**
 * Header template for Style With Charm theme
 *
 * @package Style_With_Charm
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site-wrap">
    <header class="site-header">
        <div class="container">
            <div class="header-inner">
                <!-- Mobile Menu Button -->
                <button type="button" class="icon-btn mobile-toggle" id="mobile-menu-open" aria-label="<?php esc_attr_e('Open menu', 'style-with-charm'); ?>">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="4" y1="6" x2="20" y2="6"></line>
                        <line x1="4" y1="12" x2="20" y2="12"></line>
                        <line x1="4" y1="18" x2="20" y2="18"></line>
                    </svg>
                </button>

                <!-- Site Branding / Logo -->
                <div class="site-branding">
                    <?php
                    if (has_custom_logo()) {
                        the_custom_logo();
                    } else {
                        $site_title = get_theme_mod('swc_logo_text', get_bloginfo('name'));
                        if (empty($site_title)) $site_title = 'Style With Charm';
                        ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" rel="home">
                            <?php echo esc_html($site_title); ?>
                        </a>
                        <?php
                    }
                    ?>
                </div>

                <!-- Desktop Primary Navigation -->
                <nav class="desktop-nav" aria-label="<?php esc_attr_e('Primary Navigation', 'style-with-charm'); ?>">
                    <?php
                    if (has_nav_menu('primary')) {
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'container'      => false,
                            'menu_class'     => 'desktop-nav',
                            'fallback_cb'    => false,
                            'depth'          => 1,
                        ));
                    } else {
                        // Clean default fallback navigation
                        ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="link-underline"><?php esc_html_e('Home', 'style-with-charm'); ?></a>
                        <a href="<?php echo esc_url(home_url('/about-us/')); ?>" class="link-underline"><?php esc_html_e('About Us', 'style-with-charm'); ?></a>
                        <a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="link-underline"><?php esc_html_e('Contact Us', 'style-with-charm'); ?></a>
                        <?php
                    }
                    ?>
                </nav>

                <!-- Header Actions (Search Modal Trigger) -->
                <div class="header-actions">
                    <button type="button" class="icon-btn" id="search-modal-open" aria-label="<?php esc_attr_e('Search', 'style-with-charm'); ?>">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Menu -->
        <div class="mobile-nav-drawer" id="mobile-nav-drawer">
            <ul class="mobile-nav-list">
                <?php
                if (has_nav_menu('primary')) {
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'items_wrap'     => '%3$s',
                        'depth'          => 1,
                    ));
                } else {
                    ?>
                    <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'style-with-charm'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/about-us/')); ?>"><?php esc_html_e('About Us', 'style-with-charm'); ?></a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact-us/')); ?>"><?php esc_html_e('Contact Us', 'style-with-charm'); ?></a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </header>

    <!-- Fullscreen Search Modal -->
    <div class="search-modal" id="search-modal" role="dialog" aria-modal="true" aria-hidden="true">
        <div class="search-modal-content">
            <div class="search-modal-close">
                <button type="button" class="icon-btn" id="search-modal-close" aria-label="<?php esc_attr_e('Close search', 'style-with-charm'); ?>">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <form role="search" method="get" class="search-modal-form" action="<?php echo esc_url(home_url('/')); ?>">
                <p class="eyebrow"><?php esc_html_e('Search inspiration', 'style-with-charm'); ?></p>
                <input type="search" class="search-modal-input" placeholder="<?php esc_attr_e('Living room, cozy bedroom, entryway…', 'style-with-charm'); ?>" value="<?php echo get_search_query(); ?>" name="s" id="search-modal-input" autocomplete="off" />
                <button type="submit" class="search-modal-submit"><?php esc_html_e('Search →', 'style-with-charm'); ?></button>
            </form>
        </div>
    </div>

    <main id="primary" class="site-main">
