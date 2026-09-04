<?php
/**
 * Front Page template for Style With Charm theme
 *
 * @package Style_With_Charm
 */

get_header();

// Hero settings from Customizer
$hero_bg = get_theme_mod('swc_hero_image', get_template_directory_uri() . '/assets/images/hero-living-room.jpg');
$hero_eyebrow = get_theme_mod('swc_hero_eyebrow', 'Home Decor & Interior Inspiration');
$hero_title = get_theme_mod('swc_hero_title', 'Beautiful Ideas for a Home You’ll Love');
$hero_desc = get_theme_mod('swc_hero_desc', 'Simple, stylish and inspiring home decor ideas to help you create a space that feels uniquely yours.');
$hero_cta_text = get_theme_mod('swc_hero_cta_text', 'Explore Inspiration');
$hero_cta_link = get_theme_mod('swc_hero_cta_link', '#latest');
?>

<!-- 1. HERO SECTION -->
<section class="hero-section">
    <img src="<?php echo esc_url($hero_bg); ?>" alt="<?php echo esc_attr($hero_title); ?>" class="hero-bg" loading="eager" />
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="container">
            <div class="hero-box">
                <p class="eyebrow"><?php echo esc_html($hero_eyebrow); ?></p>
                <h1 class="hero-title"><?php echo esc_html($hero_title); ?></h1>
                <p class="hero-desc"><?php echo esc_html($hero_desc); ?></p>
                <?php if ($hero_cta_text) : ?>
                    <a href="<?php echo esc_url($hero_cta_link); ?>" class="btn-swc"><?php echo esc_html($hero_cta_text); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- 2. CATEGORY INSPIRATION SECTION -->
<?php
$categories = get_categories(array(
    'orderby'    => 'count',
    'order'      => 'DESC',
    'hide_empty' => false,
    'number'     => 10,
    'exclude'    => array(get_option('default_category')), // Exclude Uncategorized
));

if (!empty($categories)) :
?>
<section class="section-padding">
    <div class="container">
        <div class="section-header">
            <p class="eyebrow"><?php echo esc_html(get_theme_mod('swc_cat_eyebrow', 'Browse by room & style')); ?></p>
            <h2 class="section-title"><?php echo esc_html(get_theme_mod('swc_cat_title', 'Explore Home Decor Ideas')); ?></h2>
        </div>
        <div class="category-grid">
            <?php foreach ($categories as $cat) :
                $cover_img = swc_get_category_cover($cat->term_id);
            ?>
                <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="category-card">
                    <div class="category-image-wrap">
                        <img src="<?php echo esc_url($cover_img); ?>" alt="<?php echo esc_attr($cat->name); ?>" loading="lazy" />
                    </div>
                    <p class="category-name">
                        <span class="link-underline"><?php echo esc_html($cat->name); ?></span>
                    </p>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- 3. FEATURED INSPIRATION / EDITOR'S PICKS -->
<?php
// Query for sticky or featured posts, fallback to latest 4 posts
$sticky = get_option('sticky_posts');
$featured_args = array(
    'posts_per_page'      => 4,
    'ignore_sticky_posts' => 1,
    'post_status'         => 'publish',
);

if (!empty($sticky)) {
    $featured_args['post__in'] = $sticky;
}

$featured_query = new WP_Query($featured_args);

if ($featured_query->have_posts()) :
    $featured_posts = $featured_query->posts;
    $lead_post = array_shift($featured_posts);
?>
<section class="section-padding bg-ivory">
    <div class="container">
        <div class="section-header">
            <p class="eyebrow"><?php esc_html_e('Featured Inspiration', 'style-with-charm'); ?></p>
            <h2 class="section-title"><?php echo esc_html(get_theme_mod('swc_editors_title', 'Editor’s Picks')); ?></h2>
        </div>

        <div class="editors-picks-layout">
            <!-- Lead Featured Post -->
            <?php
            $post = $lead_post;
            setup_postdata($post);
            $lead_cats = get_the_category($post->ID);
            $lead_cat_name = !empty($lead_cats) ? $lead_cats[0]->name : '';
            ?>
            <article class="lead-pick">
                <a href="<?php echo esc_url(get_permalink($post->ID)); ?>">
                    <?php if (has_post_thumbnail($post->ID)) : ?>
                        <div class="lead-image-wrap">
                            <?php echo get_the_post_thumbnail($post->ID, 'swc-lead', array('loading' => 'lazy', 'alt' => get_the_title($post->ID))); ?>
                        </div>
                    <?php endif; ?>
                    <div class="lead-pick-info">
                        <?php if ($lead_cat_name) : ?>
                            <p class="eyebrow"><?php echo esc_html($lead_cat_name); ?></p>
                        <?php endif; ?>
                        <h3 class="lead-pick-title">
                            <span class="link-underline"><?php echo esc_html(get_the_title($post->ID)); ?></span>
                        </h3>
                        <p class="lead-pick-excerpt"><?php echo wp_trim_words(get_the_excerpt($post->ID), 25); ?></p>
                        <p class="post-card-meta"><?php echo get_the_date('', $post->ID); ?></p>
                    </div>
                </a>
            </article>

            <!-- Secondary Featured Posts -->
            <div class="editors-secondary">
                <?php
                foreach ($featured_posts as $post) :
                    setup_postdata($post);
                    get_template_part('template-parts/content-card');
                endforeach;
                ?>
            </div>
        </div>
    </div>
</section>
<?php
wp_reset_postdata();
endif;
?>

<!-- 4. LATEST HOME DECOR POSTS (DYNAMIC FEED) -->
<section id="latest" class="section-padding">
    <div class="container">
        <div class="section-header">
            <p class="eyebrow"><?php esc_html_e('Fresh from the blog', 'style-with-charm'); ?></p>
            <h2 class="section-title"><?php echo esc_html(get_theme_mod('swc_latest_title', 'Latest Inspiration')); ?></h2>
        </div>

        <?php
        $latest_args = array(
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => 12,
            'paged'          => 1,
        );

        $latest_query = new WP_Query($latest_args);

        if ($latest_query->have_posts()) :
        ?>
            <div class="masonry-feed" id="post-feed-grid">
                <?php
                while ($latest_query->have_posts()) :
                    $latest_query->the_post();
                    get_template_part('template-parts/content-card');
                endwhile;
                ?>
            </div>

            <?php if ($latest_query->max_num_pages > 1) : ?>
                <div class="load-more-wrap">
                    <button type="button" class="btn-swc" id="load-more-btn"
                        data-page="1"
                        data-max-pages="<?php echo esc_attr($latest_query->max_num_pages); ?>"
                        data-category="0"
                        data-search="">
                        <?php esc_html_e('Load More', 'style-with-charm'); ?>
                    </button>
                    <p class="load-more-status" id="load-more-status" style="display: none;"></p>
                </div>
            <?php endif; ?>

        <?php
            wp_reset_postdata();
        else :
            get_template_part('template-parts/content-none');
        endif;
        ?>
    </div>
</section>

<!-- 5. NEWSLETTER SECTION -->
<section class="newsletter-section" aria-labelledby="newsletter-heading">
    <div class="newsletter-box">
        <p class="eyebrow"><?php esc_html_e('Newsletter', 'style-with-charm'); ?></p>
        <h2 id="newsletter-heading" class="newsletter-title">
            <?php echo esc_html(get_theme_mod('swc_newsletter_title', 'Get Beautiful Home Ideas in Your Inbox')); ?>
        </h2>
        <p class="newsletter-desc">
            <?php echo esc_html(get_theme_mod('swc_newsletter_desc', 'Fresh decor inspiration, styling ideas and beautiful spaces delivered to your inbox.')); ?>
        </p>

        <form class="newsletter-form" id="swc-newsletter-form" onsubmit="event.preventDefault(); document.getElementById('newsletter-status').innerText = 'Thank you — you’re on the list.'; this.reset();">
            <label for="newsletter-email" class="screen-reader-text"><?php esc_html_e('Email address', 'style-with-charm'); ?></label>
            <input type="email" id="newsletter-email" class="newsletter-input" placeholder="<?php esc_attr_e('Your email address', 'style-with-charm'); ?>" required />
            <button type="submit" class="btn-swc"><?php esc_html_e('Subscribe', 'style-with-charm'); ?></button>
        </form>
        <p class="newsletter-msg" id="newsletter-status" aria-live="polite"></p>
    </div>
</section>

<?php
get_footer();
