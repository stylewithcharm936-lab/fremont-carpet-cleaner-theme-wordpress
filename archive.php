<?php
/**
 * Generic Archive template for Style With Charm theme
 *
 * @package Style_With_Charm
 */

get_header();
?>

<div class="container section-padding">
    <nav class="breadcrumbs" aria-label="<?php esc_attr_e('Breadcrumbs', 'style-with-charm'); ?>">
        <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'style-with-charm'); ?></a>
        <span>/</span>
        <span><?php esc_html_e('Archive', 'style-with-charm'); ?></span>
    </nav>

    <header class="section-header" style="text-align: left; max-width: 44rem; margin-top: 2rem; margin-bottom: 4rem;">
        <h1 class="section-title" style="font-size: 3rem; text-transform: capitalize;">
            <?php the_archive_title(); ?>
        </h1>
        <?php the_archive_description('<div style="margin-top: 1rem; font-size: 0.95rem; color: var(--swc-muted); line-height: 1.75;">', '</div>'); ?>
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
