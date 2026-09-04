<?php
/**
 * Single post template for Style With Charm theme
 *
 * @package Style_With_Charm
 */

get_header();

while (have_posts()) :
    the_post();
    $categories = get_the_category();
    $primary_cat = !empty($categories) ? $categories[0] : null;
    $post_url = get_permalink();
    $post_title = get_the_title();
    $thumb_url = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : '';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
    <div class="single-post-header">
        <!-- Breadcrumbs -->
        <nav class="breadcrumbs" aria-label="<?php esc_attr_e('Breadcrumbs', 'style-with-charm'); ?>">
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'style-with-charm'); ?></a>
            <?php if ($primary_cat) : ?>
                <span>/</span>
                <a href="<?php echo esc_url(get_category_link($primary_cat->term_id)); ?>"><?php echo esc_html($primary_cat->name); ?></a>
            <?php endif; ?>
        </nav>

        <?php if ($primary_cat) : ?>
            <p class="eyebrow">
                <a href="<?php echo esc_url(get_category_link($primary_cat->term_id)); ?>" class="link-underline">
                    <?php echo esc_html($primary_cat->name); ?>
                </a>
            </p>
        <?php endif; ?>

        <h1 class="single-post-title"><?php the_title(); ?></h1>

        <p class="post-card-meta">
            <?php echo esc_html(get_the_date()); ?>
            <span> · <?php esc_html_e('By', 'style-with-charm'); ?> <?php the_author(); ?></span>
        </p>
    </div>

    <?php if (has_post_thumbnail()) : ?>
        <div class="single-post-featured-image">
            <?php the_post_thumbnail('full', array('loading' => 'eager', 'alt' => get_the_title())); ?>
        </div>
    <?php endif; ?>

    <div class="article-content">
        <?php the_content(); ?>

        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'style-with-charm'),
            'after'  => '</div>',
        ));
        ?>
    </div>

    <!-- Social Share Buttons -->
    <div class="article-share">
        <p class="eyebrow"><?php esc_html_e('Share this story', 'style-with-charm'); ?></p>
        <div class="share-links">
            <a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode($post_url); ?>&media=<?php echo urlencode($thumb_url); ?>&description=<?php echo urlencode($post_title); ?>" target="_blank" rel="noopener noreferrer" class="link-underline">
                Pinterest
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($post_url); ?>" target="_blank" rel="noopener noreferrer" class="link-underline">
                Facebook
            </a>
            <a href="mailto:?subject=<?php echo rawurlencode($post_title); ?>&body=<?php echo rawurlencode($post_url); ?>" class="link-underline">
                Email
            </a>
        </div>
    </div>

    <!-- Related Posts -->
    <?php
    $related_args = array(
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'post__not_in'   => array(get_the_ID()),
        'post_status'    => 'publish',
    );

    if ($primary_cat) {
        $related_args['cat'] = $primary_cat->term_id;
    }

    $related_query = new WP_Query($related_args);

    if ($related_query->have_posts()) :
    ?>
    <section class="section-padding bg-ivory" style="margin-top: 6rem;">
        <div class="container">
            <h2 class="section-title" style="text-align: center; margin-bottom: 3.5rem;"><?php esc_html_e('You May Also Like', 'style-with-charm'); ?></h2>
            <div style="display: grid; gap: 2.5rem; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));">
                <?php
                while ($related_query->have_posts()) :
                    $related_query->the_post();
                    get_template_part('template-parts/content-card');
                endwhile;
                ?>
            </div>
        </div>
    </section>
    <?php
    wp_reset_postdata();
    endif;
    ?>

    <!-- Comments -->
    <?php
    if (comments_open() || get_comments_number()) :
    ?>
    <div class="container" style="max-width: 44rem; margin: 4rem auto;">
        <?php comments_template(); ?>
    </div>
    <?php endif; ?>

</article>

<?php
endwhile;

get_footer();
