<?php
/**
 * Template part for displaying a Pinterest-style post card
 *
 * @package Style_With_Charm
 */

$categories = get_the_category();
$category_name = !empty($categories) ? $categories[0]->name : '';
$category_link = !empty($categories) ? get_category_link($categories[0]->term_id) : '';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('masonry-item post-card'); ?>>
    <a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
        <?php if (has_post_thumbnail()) : ?>
            <div class="post-card-thumb">
                <?php the_post_thumbnail('swc-card', array('loading' => 'lazy', 'alt' => get_the_title())); ?>
            </div>
        <?php endif; ?>

        <div class="post-card-body">
            <?php if ($category_name) : ?>
                <p class="eyebrow post-card-category"><?php echo esc_html($category_name); ?></p>
            <?php endif; ?>

            <h3 class="post-card-title">
                <span class="link-underline"><?php the_title(); ?></span>
            </h3>

            <?php if (has_excerpt() || get_the_excerpt()) : ?>
                <div class="post-card-excerpt">
                    <?php the_excerpt(); ?>
                </div>
            <?php endif; ?>

            <p class="post-card-meta">
                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time>
            </p>
        </div>
    </a>
</article>
