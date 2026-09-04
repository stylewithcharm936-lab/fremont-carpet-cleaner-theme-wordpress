<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package Style_With_Charm
 */
?>
<div class="no-posts-found" style="text-align: center; padding: 4rem 1rem;">
    <p class="eyebrow"><?php esc_html_e('No articles found', 'style-with-charm'); ?></p>
    <h2 style="font-size: 2rem; margin-top: 0.5rem; margin-bottom: 1rem;"><?php esc_html_e('Inspiration is on the way', 'style-with-charm'); ?></h2>
    <p style="color: var(--swc-muted); max-width: 28rem; margin: 0 auto 2rem auto;">
        <?php esc_html_e('We couldn\'t find any articles matching this request. Try searching for a different room, color palette, or aesthetic.', 'style-with-charm'); ?>
    </p>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-swc"><?php esc_html_e('Back to Home', 'style-with-charm'); ?></a>
</div>
