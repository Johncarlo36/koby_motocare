<header id="masthead" class="site-header header-1" role="banner">
    <div class="header-container">
        <div class="container header-main">
            <div class="header-left">
                <?php
                ridez_site_branding();
                if (ridez_is_woocommerce_activated()) {
                    ?>
                    <div class="site-header-cart header-cart-mobile">
                        <?php ridez_cart_link(); ?>
                    </div>
                    <?php
                }
                ?>
                <?php ridez_mobile_nav_button(); ?>
            </div>
            <div class="header-center">
                <?php ridez_primary_navigation(); ?>
            </div>
            <div class="header-right desktop-hide-down">
                <div class="header-group-action">
                    <?php
                    ridez_header_account();
                    if (ridez_is_woocommerce_activated()) {
                        ridez_header_wishlist();
                        ridez_header_cart();
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</header><!-- #masthead -->
