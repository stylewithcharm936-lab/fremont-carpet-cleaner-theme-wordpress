<?php
/**
 * Main template file for Style With Charm theme
 *
 * @package Style_With_Charm
 */

get_header();
?>

<div class="container section-padding">
    <header class="section-header">
        <p class="eyebrow"><?php esc_html_e('Inspiration & Ideas', 'style-with-charm'); ?></p>
        <h1 class="section-title"><?php esc_html_e('All Articles', 'style-with-charm'); ?></h1>
    </header>

    <?php if (have_posts()) : ?>
        <div class="masonry-feed" id="post-feed-grid">
            <?php
            while (have_posts()) :
                the_post();
                get_template_part('template-parts/content-card');
            endwhile;
            ?>
        </div>

        <?php if ($wp_query->max_num_pages > 1) : ?>
            <div class="load-more-wrap">
                <button type="button" class="btn-swc" id="load-more-btn"
                    data-page="1"
                    data-max-pages="<?php echo esc_attr($wp_query->max_num_pages); ?>"
                    data-category="0"
                    data-search="">
                    <?php esc_html_e('Load More', 'style-with-charm'); ?>
                </button>
                <p class="load-more-status" id="load-more-status" style="display: none;"></p>
            </div>
        <?php endif; ?>

    <?php else : ?>
        <?php get_template_part('template-parts/content-none'); ?>
    <?php endif; ?>
</div>

<?php
get_footer();
