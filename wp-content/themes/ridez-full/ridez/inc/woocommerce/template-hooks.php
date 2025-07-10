<?php
/**
 * =================================================
 * Hook ridez_page
 * =================================================
 */

/**
 * =================================================
 * Hook ridez_single_post_top
 * =================================================
 */

/**
 * =================================================
 * Hook ridez_single_post
 * =================================================
 */

/**
 * =================================================
 * Hook ridez_single_post_bottom
 * =================================================
 */

/**
 * =================================================
 * Hook ridez_loop_post
 * =================================================
 */

/**
 * =================================================
 * Hook ridez_footer
 * =================================================
 */

/**
 * =================================================
 * Hook ridez_after_footer
 * =================================================
 */
add_action('ridez_after_footer', 'ridez_sticky_single_add_to_cart', 999);

/**
 * =================================================
 * Hook wp_footer
 * =================================================
 */
add_action('wp_footer', 'ridez_render_woocommerce_shop_canvas', 1);

/**
 * =================================================
 * Hook wp_head
 * =================================================
 */

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
add_action('ridez_content_top', 'ridez_shop_messages', 10);

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

/**
 * =================================================
 * Hook ridez_loop_after
 * =================================================
 */

/**
 * =================================================
 * Hook ridez_page_after
 * =================================================
 */

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
add_action('ridez_woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 40);

/**
 * =================================================
 * Hook ridez_woocommerce_shop_loop_item_title
 * =================================================
 */
add_action('ridez_woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 5);

/**
 * =================================================
 * Hook ridez_woocommerce_after_shop_loop_item_title
 * =================================================
 */
add_action('ridez_woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 15);
add_action('ridez_woocommerce_after_shop_loop_item_title', 'ridez_woocommerce_get_product_description', 20);
add_action('ridez_woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 25);
add_action('ridez_woocommerce_after_shop_loop_item_title', 'ridez_wishlist_button', 30);
add_action('ridez_woocommerce_after_shop_loop_item_title', 'ridez_compare_button', 35);
add_action('ridez_woocommerce_after_shop_loop_item_title', 'ridez_quickview_button', 40);

/**
 * =================================================
 * Hook ridez_woocommerce_after_shop_loop_item
 * =================================================
 */
