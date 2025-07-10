<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     Opal  Team <opalwordpress@gmail.com>
 * @copyright  Copyright (C) 2017 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/questions/
 */
/**
 * Enable/distable share box
 */

$heading = apply_filters('ridez_social_heading', esc_html__('Share:', 'ridez'));

if (ridez_get_theme_option('social_share')) {
    ?>
    <div class="ridez-social-share">
        <?php if (is_singular('post')): ?>
            <?php echo '<span class="social-share-header">' . esc_html($heading) . '</span>'; ?>
        <?php endif; ?>
        <?php if (ridez_get_theme_option('social_share_facebook')): ?>
            <a class="social-facebook"
               href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&display=page"
               target="_blank" title="<?php esc_html_e('Share on facebook', 'ridez'); ?>">
                <i class="ridez-icon-facebook"></i>
                <span><?php esc_html_e('Facebook', 'ridez'); ?></span>
            </a>
        <?php endif; ?>

        <?php if (ridez_get_theme_option('social_share_twitter')): ?>
            <a class="social-twitter"
               href="https://twitter.com/home?status=<?php esc_url(get_the_title()); ?> <?php the_permalink(); ?>" target="_blank"
               title="<?php esc_html_e('Share on Twitter', 'ridez'); ?>">
                <i class="ridez-icon-twitter"></i>
                <span><?php esc_html_e('Twitter', 'ridez'); ?></span>
            </a>
        <?php endif; ?>

        <?php if (ridez_get_theme_option('social_share_linkedin')): ?>
            <a class="social-linkedin"
               href="https://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>"
               target="_blank" title="<?php esc_html_e('Share on LinkedIn', 'ridez'); ?>">
                <i class="ridez-icon-linkedin"></i>
                <span><?php esc_html_e('Linkedin', 'ridez'); ?></span>
            </a>
        <?php endif; ?>

        <?php if (ridez_get_theme_option('social_share_google-plus')): ?>
            <a class="social-google" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank"
               title="<?php esc_html_e('Share on Google plus', 'ridez'); ?>">
                <i class="ridez-icon-google-plus"></i>
                <span><?php esc_html_e('Google+', 'ridez'); ?></span>
            </a>
        <?php endif; ?>

        <?php if (ridez_get_theme_option('social_share_pinterest')): ?>
            <a class="social-pinterest"
               href="https://pinterest.com/pin/create/button/?url=<?php echo esc_url(urlencode(get_permalink())); ?>&amp;description=<?php echo esc_url(urlencode(get_the_title())); ?>&amp;; ?>"
               target="_blank" title="<?php esc_html_e('Share on Pinterest', 'ridez'); ?>">
                <i class="ridez-icon-pinterest-p"></i>
                <span><?php esc_html_e('Pinterest', 'ridez'); ?></span>
            </a>
        <?php endif; ?>

        <?php if (ridez_get_theme_option('social_share_email')): ?>
            <a class="social-envelope" href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>"
               title="<?php esc_html_e('Email to a Friend', 'ridez'); ?>">
                <i class="ridez-icon-envelope"></i>
                <span><?php esc_html_e('Email', 'ridez'); ?></span>
            </a>
        <?php endif; ?>
    </div>
    <?php
}
?>
