<?php
/**
 * =================================================
 * Hook ridez_page
 * =================================================
 */
add_action('ridez_page', 'ridez_page_header', 10);
add_action('ridez_page', 'ridez_page_content', 20);

/**
 * =================================================
 * Hook ridez_single_post_top
 * =================================================
 */
add_action('ridez_single_post_top', 'ridez_post_thumbnail', 10);

/**
 * =================================================
 * Hook ridez_single_post
 * =================================================
 */
add_action('ridez_single_post', 'ridez_post_header', 10);
add_action('ridez_single_post', 'ridez_post_content', 30);

/**
 * =================================================
 * Hook ridez_single_post_bottom
 * =================================================
 */
add_action('ridez_single_post_bottom', 'ridez_post_taxonomy', 5);
add_action('ridez_single_post_bottom', 'ridez_post_nav', 10);
add_action('ridez_single_post_bottom', 'ridez_display_comments', 20);

/**
 * =================================================
 * Hook ridez_loop_post
 * =================================================
 */
add_action('ridez_loop_post', 'ridez_post_header', 15);
add_action('ridez_loop_post', 'ridez_post_content', 30);

/**
 * =================================================
 * Hook ridez_footer
 * =================================================
 */
add_action('ridez_footer', 'ridez_footer_default', 20);

/**
 * =================================================
 * Hook ridez_after_footer
 * =================================================
 */

/**
 * =================================================
 * Hook wp_footer
 * =================================================
 */
add_action('wp_footer', 'ridez_template_account_dropdown', 1);
add_action('wp_footer', 'ridez_mobile_nav', 1);

/**
 * =================================================
 * Hook wp_head
 * =================================================
 */
add_action('wp_head', 'ridez_pingback_header', 1);

/**
 * =================================================
 * Hook ridez_before_header
 * =================================================
 */

/**
 * =================================================
 * Hook ridez_before_content
 * =================================================
 */

/**
 * =================================================
 * Hook ridez_content_top
 * =================================================
 */

/**
 * =================================================
 * Hook ridez_post_content_before
 * =================================================
 */

/**
 * =================================================
 * Hook ridez_post_content_after
 * =================================================
 */

/**
 * =================================================
 * Hook ridez_sidebar
 * =================================================
 */
add_action('ridez_sidebar', 'ridez_get_sidebar', 10);

/**
 * =================================================
 * Hook ridez_loop_after
 * =================================================
 */
add_action('ridez_loop_after', 'ridez_paging_nav', 10);

/**
 * =================================================
 * Hook ridez_page_after
 * =================================================
 */
add_action('ridez_page_after', 'ridez_display_comments', 10);

/**
 * =================================================
 * Hook ridez_woocommerce_before_shop_loop_item
 * =================================================
 */

/**
 * =================================================
 * Hook ridez_woocommerce_before_shop_loop_item_title
 * =================================================
 */

/**
 * =================================================
 * Hook ridez_woocommerce_shop_loop_item_title
 * =================================================
 */

/**
 * =================================================
 * Hook ridez_woocommerce_after_shop_loop_item_title
 * =================================================
 */

/**
 * =================================================
 * Hook ridez_woocommerce_after_shop_loop_item
 * =================================================
 */
