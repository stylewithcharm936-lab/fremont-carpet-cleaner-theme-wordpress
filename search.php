<?php
/**
 * Search results template for Style With Charm theme
 *
 * @package Style_With_Charm
 */

get_header();
global $wp_query;
$query_string = get_search_query();
$total_results = $wp_query->found_posts;
?>

<div class="container section-padding">
    <nav class="breadcrumbs" aria-label="<?php esc_attr_e('Breadcrumbs', 'style-with-charm'); ?>">
        <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'style-with-charm'); ?></a>
        <span>/</span>
        <span><?php esc_html_e('Search', 'style-with-charm'); ?></span>
    </nav>

    <header class="section-header" style="text-align: left; max-width: 44rem; margin-top: 2rem; margin-bottom: 3.5rem;">
        <h1 class="section-title" style="font-size: 3rem;"><?php esc_html_e('Search', 'style-with-charm'); ?></h1>

        <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" style="margin-top: 2rem;">
            <input type="search" name="s" value="<?php echo esc_attr($query_string); ?>" placeholder="<?php esc_attr_e('Living room, cozy bedroom, entryway…', 'style-with-charm'); ?>" class="search-modal-input" style="font-size: 1.8rem;" />
        </form>

        <?php if (!empty($query_string)) : ?>
            <p class="post-card-meta" style="margin-top: 1.5rem; font-size: 0.85rem;">
                <?php printf(esc_html(_n('%d result for', '%d results for', $total_results, 'style-with-charm')), $total_results); ?>
                <strong style="color: var(--swc-charcoal);"> “<?php echo esc_html($query_string); ?>”</strong>
            </p>
        <?php endif; ?>
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
                    data-search="<?php echo esc_attr($query_string); ?>">
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
