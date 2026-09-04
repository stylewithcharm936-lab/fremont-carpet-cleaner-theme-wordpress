<?php
/**
 * Template Name: Contact Us
 *
 * @package Style_With_Charm
 */

get_header();

while (have_posts()) :
    the_post();
?>

<div class="container section-padding">
    <header style="max-width: 38rem;">
        <p class="eyebrow"><?php esc_html_e('Say Hello', 'style-with-charm'); ?></p>
        <h1 class="section-title" style="font-size: 3.25rem; margin-top: 0.5rem;"><?php the_title(); ?></h1>
        <p style="margin-top: 1rem; color: var(--swc-muted); font-size: 0.95rem; line-height: 1.7;">
            <?php esc_html_e('Questions, collaborations or a decorating dilemma you’d like us to cover? Send a note and we’ll get back to you soon.', 'style-with-charm'); ?>
        </p>
    </header>

    <div class="contact-grid">
        <!-- Contact Form -->
        <form id="swc-contact-form" method="post" action="" onsubmit="event.preventDefault(); var name = document.getElementById('contact-name').value; var email = document.getElementById('contact-email').value; var msg = document.getElementById('contact-message').value; window.location.href = 'mailto:hello@stylewithcharm.com?subject=Message from ' + encodeURIComponent(name) + '&body=' + encodeURIComponent(msg + '\n\n— ' + name + ' (' + email + ')'); document.getElementById('contact-status').innerText = 'Thank you — your email application has opened to send the message.'; this.reset();">
            <div style="margin-bottom: 2rem;">
                <label for="contact-name" class="eyebrow"><?php esc_html_e('Your name', 'style-with-charm'); ?></label>
                <input type="text" id="contact-name" class="form-field" required />
            </div>
            <div style="margin-bottom: 2rem;">
                <label for="contact-email" class="eyebrow"><?php esc_html_e('Email address', 'style-with-charm'); ?></label>
                <input type="email" id="contact-email" class="form-field" required />
            </div>
            <div style="margin-bottom: 2.5rem;">
                <label for="contact-message" class="eyebrow"><?php esc_html_e('Message', 'style-with-charm'); ?></label>
                <textarea id="contact-message" rows="5" class="form-field" style="resize: none;" required></textarea>
            </div>
            <button type="submit" class="btn-swc"><?php esc_html_e('Send Message', 'style-with-charm'); ?></button>
            <p id="contact-status" class="post-card-meta" style="margin-top: 1rem; text-transform: none; color: var(--swc-muted);"></p>
        </form>

        <!-- Aside Information -->
        <aside style="font-size: 0.9rem; color: var(--swc-muted); line-height: 1.8;">
            <?php
            $content = get_the_content();
            if (!empty(trim($content))) {
                the_content();
            } else {
                ?>
                <p class="eyebrow"><?php esc_html_e('Email', 'style-with-charm'); ?></p>
                <p style="margin-top: 0.5rem; margin-bottom: 2.5rem; color: var(--swc-charcoal);">
                    <a href="mailto:hello@stylewithcharm.com" class="link-underline">hello@stylewithcharm.com</a>
                </p>

                <p class="eyebrow"><?php esc_html_e('Follow', 'style-with-charm'); ?></p>
                <ul style="list-style: none; margin-top: 0.5rem; display: flex; flex-direction: column; gap: 0.5rem;">
                    <li><a href="https://www.pinterest.com/" target="_blank" rel="noopener noreferrer" class="link-underline">Pinterest</a></li>
                    <li><a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer" class="link-underline">Instagram</a></li>
                    <li><a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer" class="link-underline">Facebook</a></li>
                </ul>
                <?php
            }
            ?>
        </aside>
    </div>
</div>

<?php
endwhile;

get_footer();
