<?php

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}
?>
<li <?php wc_product_class('product-list', $product); ?>>
    <?php
    /**
     * Functions hooked in to ridez_woocommerce_before_shop_loop_item action
     *
     */
    do_action('ridez_woocommerce_before_shop_loop_item');


    ?>
    <div class="product-image">
        <?php
        /**
         *
         * Functions hooked in to ridez_woocommerce_before_shop_loop_item_title action
         *
         * @see woocommerce_template_loop_product_thumbnail - 40 - woo
         */
        do_action('ridez_woocommerce_before_shop_loop_item_title');
        ?>
    </div>
    <div class="product-caption">
        <?php
        /**
         * Functions hooked in to ridez_woocommerce_shop_loop_item_title action
         *
         * @see woocommerce_template_loop_product_title - 5 - woo
         */
        do_action('ridez_woocommerce_shop_loop_item_title');

        /**
         * Functions hooked in to ridez_woocommerce_after_shop_loop_item_title action
         *
         * @see woocommerce_template_loop_price - 15 - woo
         * @see ridez_woocommerce_get_product_description - 20 - woo
         * @see woocommerce_template_loop_add_to_cart - 25 - woo
         * @see ridez_wishlist_button - 30 - woo
         * @see ridez_compare_button - 35 - woo
         * @see ridez_quickview_button - 40 - woo
         *
         */
        do_action('ridez_woocommerce_after_shop_loop_item_title');
        ?>
    </div>
    <?php
    /**
     * Functions hooked in to ridez_woocommerce_after_shop_loop_item action
     *
     */
    do_action('ridez_woocommerce_after_shop_loop_item');
    ?>
</li>
