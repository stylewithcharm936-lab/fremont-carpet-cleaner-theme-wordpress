<?php
/**
 * Category Archive template for Style With Charm theme
 *
 * @package Style_With_Charm
 */

get_header();

$current_cat = get_queried_object();
$cat_name = single_cat_title('', false);
$cat_desc = category_description();
$cat_id = $current_cat->term_id;
$total_posts = $current_cat->count;
?>

<div class="container section-padding">
    <nav class="breadcrumbs" aria-label="<?php esc_attr_e('Breadcrumbs', 'style-with-charm'); ?>">
        <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'style-with-charm'); ?></a>
        <span>/</span>
        <span><?php echo esc_html($cat_name); ?></span>
    </nav>

    <header class="section-header" style="text-align: left; max-width: 44rem; margin-top: 2rem; margin-bottom: 4rem;">
        <h1 class="section-title" style="font-size: 3rem; text-transform: capitalize;"><?php echo esc_html($cat_name); ?></h1>
        <?php if ($cat_desc) : ?>
            <div style="margin-top: 1rem; font-size: 0.95rem; color: var(--swc-muted); line-height: 1.75;">
                <?php echo wp_kses_post($cat_desc); ?>
            </div>
        <?php endif; ?>
        <p class="post-card-meta" style="margin-top: 1rem;">
            <?php printf(esc_html(_n('%d Article', '%d Articles', $total_posts, 'style-with-charm')), $total_posts); ?>
        </p>
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
                    data-category="<?php echo esc_attr($cat_id); ?>"
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
