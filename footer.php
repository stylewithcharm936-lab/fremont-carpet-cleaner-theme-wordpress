<?php
/**
 * Footer template for Style With Charm theme
 *
 * @package Style_With_Charm
 */
?>
    </main><!-- #primary -->

    <footer class="site-footer">
        <div class="container">
            <div class="footer-inner">
                <!-- Brand Column -->
                <div class="footer-brand">
                    <p class="site-logo">
                        <?php echo esc_html(get_theme_mod('swc_logo_text', 'Style With Charm')); ?>
                    </p>
                    <p>
                        <?php echo esc_html(get_theme_mod('swc_footer_bio', 'Simple, stylish and inspiring home decor ideas — thoughtfully collected to help you create a space that feels uniquely yours.')); ?>
                    </p>
                    <div class="social-links">
                        <?php $pinterest = get_theme_mod('swc_pinterest_url', 'https://www.pinterest.com/'); ?>
                        <?php if ($pinterest) : ?>
                            <a href="<?php echo esc_url($pinterest); ?>" target="_blank" rel="noopener noreferrer" aria-label="Pinterest">
                                <svg width="19" height="19" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2a10 10 0 0 0-3.65 19.31c-.09-.78-.17-1.98.04-2.83.19-.78 1.2-4.98 1.2-4.98s-.3-.61-.3-1.51c0-1.42.82-2.48 1.85-2.48.87 0 1.29.66 1.29 1.44 0 .88-.56 2.19-.85 3.41-.24 1.02.51 1.85 1.52 1.85 1.82 0 3.22-1.92 3.22-4.7 0-2.46-1.76-4.18-4.28-4.18-2.92 0-4.63 2.19-4.63 4.45 0 .88.34 1.83.76 2.34.08.1.09.19.07.29-.08.32-.25.98-.28 1.11-.04.19-.15.23-.34.14-1.26-.59-2.05-2.43-2.05-3.91 0-3.18 2.31-6.1 6.66-6.1 3.5 0 6.22 2.49 6.22 5.82 0 3.47-2.19 6.27-5.23 6.27-1.02 0-1.98-.53-2.31-1.16l-.63 2.4c-.23.87-.84 1.96-1.25 2.63A10 10 0 1 0 12 2Z" />
                                </svg>
                            </a>
                        <?php endif; ?>

                        <?php $instagram = get_theme_mod('swc_instagram_url', 'https://www.instagram.com/'); ?>
                        <?php if ($instagram) : ?>
                            <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                                <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                            </a>
                        <?php endif; ?>

                        <?php $facebook = get_theme_mod('swc_facebook_url', 'https://www.facebook.com/'); ?>
                        <?php if ($facebook) : ?>
                            <a href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                                <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Explore Links -->
                <div>
                    <p class="eyebrow"><?php esc_html_e('Explore', 'style-with-charm'); ?></p>
                    <ul class="footer-links">
                        <?php
                        if (has_nav_menu('footer')) {
                            wp_nav_menu(array(
                                'theme_location' => 'footer',
                                'container'      => false,
                                'items_wrap'     => '%3$s',
                                'depth'          => 1,
                            ));
                        } else {
                            ?>
                            <li><a href="<?php echo esc_url(home_url('/')); ?>" class="link-underline"><?php esc_html_e('Home', 'style-with-charm'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/about-us/')); ?>" class="link-underline"><?php esc_html_e('About Us', 'style-with-charm'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="link-underline"><?php esc_html_e('Contact Us', 'style-with-charm'); ?></a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>

                <!-- Legal Information -->
                <div>
                    <p class="eyebrow"><?php esc_html_e('Information', 'style-with-charm'); ?></p>
                    <ul class="footer-links">
                        <li><a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>" class="link-underline"><?php esc_html_e('Privacy Policy', 'style-with-charm'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/disclaimer/')); ?>" class="link-underline"><?php esc_html_e('Disclaimer', 'style-with-charm'); ?></a></li>
                        <li><a href="<?php echo esc_url(home_url('/terms-and-conditions/')); ?>" class="link-underline"><?php esc_html_e('Terms & Conditions', 'style-with-charm'); ?></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>© <?php echo date('Y'); ?> <?php echo esc_html(get_theme_mod('swc_logo_text', 'Style With Charm')); ?>. <?php esc_html_e('All rights reserved.', 'style-with-charm'); ?></p>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
