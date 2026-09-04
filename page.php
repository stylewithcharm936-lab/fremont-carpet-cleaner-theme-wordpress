<?php
/**
 * Default Page template for Style With Charm theme
 *
 * @package Style_With_Charm
 */

get_header();

while (have_posts()) :
    the_post();
?>

<div class="container section-padding">
    <header class="section-header" style="max-width: 44rem; margin-left: auto; margin-right: auto; text-align: center;">
        <h1 class="section-title" style="font-size: 3rem;"><?php the_title(); ?></h1>
    </header>

    <?php if (has_post_thumbnail()) : ?>
        <div class="single-post-featured-image" style="margin-bottom: 3rem;">
            <?php the_post_thumbnail('full'); ?>
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
</div>

<?php
endwhile;

get_footer();
