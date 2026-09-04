<?php
/**
 * Template Name: About Us
 *
 * @package Style_With_Charm
 */

get_header();

while (have_posts()) :
    the_post();
    $about_img = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : get_template_directory_uri() . '/assets/images/about-hero.jpg';
    $content = get_the_content();
?>

<div>
    <div class="page-hero">
        <img src="<?php echo esc_url($about_img); ?>" alt="<?php the_title_attribute(); ?>" loading="eager" />
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="container" style="text-align: center;">
                <p class="eyebrow"><?php esc_html_e('Our Story', 'style-with-charm'); ?></p>
                <h1 class="hero-title" style="font-size: 3.25rem; margin-top: 0.5rem;"><?php the_title(); ?></h1>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: 4rem; margin-bottom: 6rem;">
        <div class="article-content">
            <?php
            if (!empty(trim($content))) {
                the_content();
            } else {
                // Default editorial copy when page body is empty
                ?>
                <p>
                    <strong>Style With Charm</strong> is a home decor journal for anyone who believes a home should feel as good as it looks. We gather simple, beautiful ideas — soft neutrals, natural textures and quiet details — and turn them into inspiration you can actually use.
                </p>
                <h2>What we believe</h2>
                <p>
                    A beautiful home isn’t about expensive furniture or perfect rooms. It’s about warmth, light, and small thoughtful choices that make a space feel like yours.
                </p>
                <h2>What you’ll find here</h2>
                <ul>
                    <li>Room-by-room decorating ideas for every corner of your home</li>
                    <li>Seasonal styling, entryway and porch inspiration</li>
                    <li>Budget-friendly DIY details and small-space solutions</li>
                    <li>Calm, editorial photography to spark your next project</li>
                </ul>
                <p>
                    Thank you for being here — we hope you leave with at least one idea you can’t wait to try.
                </p>
                <?php
            }
            ?>
        </div>
    </div>
</div>

<?php
endwhile;

get_footer();
