<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Ridez_Elementor')) :

    /**
     * The Ridez Elementor Integration class
     */
    class Ridez_Elementor {
        private $suffix = '';

        public function __construct() {
            $this->suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';

            add_action('wp', [$this, 'register_auto_scripts_frontend']);
            add_action('elementor/init', array($this, 'add_category'));
            add_action('wp_enqueue_scripts', [$this, 'add_scripts'], 15);
            add_action('elementor/widgets/register', array($this, 'customs_widgets'));
            add_action('elementor/widgets/register', array($this, 'include_widgets'));
            add_action('elementor/frontend/after_enqueue_scripts', [$this, 'add_js']);

            // Custom Animation Scroll
            add_filter('elementor/controls/animations/additional_animations', [$this, 'add_animations_scroll']);

            // Elementor Fix Noitice WooCommerce
            add_action('elementor/editor/before_enqueue_scripts', array($this, 'woocommerce_fix_notice'));

            // Backend
            add_action('elementor/editor/after_enqueue_styles', [$this, 'add_style_editor'], 99);

            // Add Icon Custom
            add_action('elementor/icons_manager/native', [$this, 'add_icons_native']);
            add_action('elementor/controls/register', [$this, 'add_icons']);

            // Add Breakpoints
            add_action('wp_enqueue_scripts', 'ridez_elementor_breakpoints', 9999);

            if (!ridez_is_elementor_pro_activated()) {
                require trailingslashit(get_template_directory()) . 'inc/elementor/custom-css.php';
                require trailingslashit(get_template_directory()) . 'inc/elementor/sticky-section.php';
                if (is_admin()) {
                    add_action('manage_elementor_library_posts_columns', [$this, 'admin_columns_headers']);
                    add_action('manage_elementor_library_posts_custom_column', [$this, 'admin_columns_content'], 10, 2);
                }
            }

            add_filter('elementor/fonts/additional_fonts', [$this, 'additional_fonts']);
            add_action('wp_enqueue_scripts', [$this, 'elementor_kit']);
        }

        public function elementor_kit() {
            $active_kit_id = Elementor\Plugin::$instance->kits_manager->get_active_id();
            Elementor\Plugin::$instance->kits_manager->frontend_before_enqueue_styles();
            $myvals = get_post_meta($active_kit_id, '_elementor_page_settings', true);
            if (!empty($myvals)) {
                $css = 'body{';
                foreach ($myvals['system_colors'] as $key => $value) {
                    $css .= $value['color'] !== '' ? '--' . $value['_id'] . ':' . $value['color'] . ';' : '';
                }
                $css .= '}';
//                var_dump($myvals['container_width']);
                $container_width = $myvals['container_width'];
                if ($container_width) {
                    $css .= '.col-full{';
                    $css .= 'max-width:' . $container_width['size'] . $container_width['unit'];
                    $css .= '}';
                }


                wp_add_inline_style('ridez-style', $css);
            }
        }

        public function additional_fonts($fonts) {
            $fonts["Ridez"] = 'system';
            return $fonts;
        }

        public function admin_columns_headers($defaults) {
            $defaults['shortcode'] = esc_html__('Shortcode', 'ridez');

            return $defaults;
        }

        public function admin_columns_content($column_name, $post_id) {
            if ('shortcode' === $column_name) {
                ob_start();
                ?>
                <input class="elementor-shortcode-input" type="text" readonly onfocus="this.select()" value="[hfe_template id='<?php echo esc_attr($post_id); ?>']"/>
                <?php
                ob_get_contents();
            }
        }

        public function add_js() {
            global $ridez_version;
            wp_enqueue_script('ridez-elementor-frontend', get_theme_file_uri('/assets/js/elementor-frontend.js'), [], $ridez_version);
        }

        public function add_style_editor() {
            global $ridez_version;
            wp_enqueue_style('ridez-elementor-editor-icon', get_theme_file_uri('/assets/css/admin/elementor/icons.css'), [], $ridez_version);
        }

        public function add_scripts() {
            global $ridez_version;
            $suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';
            wp_enqueue_style('ridez-elementor', get_template_directory_uri() . '/assets/css/base/elementor.css', '', $ridez_version);
            wp_style_add_data('ridez-elementor', 'rtl', 'replace');

            // Add Scripts
            wp_register_script('tweenmax', get_theme_file_uri('/assets/js/vendor/TweenMax.min.js'), array('jquery'), '1.11.1');
            wp_register_script('parallaxmouse', get_theme_file_uri('/assets/js/vendor/jquery-parallax.js'), array('jquery'), $ridez_version);

            if (ridez_elementor_check_type('animated-bg-parallax')) {
                wp_enqueue_script('tweenmax');
                wp_enqueue_script('jquery-panr', get_theme_file_uri('/assets/js/vendor/jquery-panr' . $suffix . '.js'), array('jquery'), '0.0.1');
            }
        }


        public function register_auto_scripts_frontend() {
            global $ridez_version;
            wp_register_script('ridez-elementor-brand', get_theme_file_uri('/assets/js/elementor/brand.js'), array('jquery','elementor-frontend'), $ridez_version, true);
            wp_register_script('ridez-elementor-countdown', get_theme_file_uri('/assets/js/elementor/countdown.js'), array('jquery','elementor-frontend'), $ridez_version, true);
            wp_register_script('ridez-elementor-header-group', get_theme_file_uri('/assets/js/elementor/header-group.js'), array('jquery','elementor-frontend'), $ridez_version, true);
            wp_register_script('ridez-elementor-image-carousel', get_theme_file_uri('/assets/js/elementor/image-carousel.js'), array('jquery','elementor-frontend'), $ridez_version, true);
            wp_register_script('ridez-elementor-image-gallery', get_theme_file_uri('/assets/js/elementor/image-gallery.js'), array('jquery','elementor-frontend'), $ridez_version, true);
            wp_register_script('ridez-elementor-posts-grid', get_theme_file_uri('/assets/js/elementor/posts-grid.js'), array('jquery','elementor-frontend'), $ridez_version, true);
            wp_register_script('ridez-elementor-product-categories', get_theme_file_uri('/assets/js/elementor/product-categories.js'), array('jquery','elementor-frontend'), $ridez_version, true);
            wp_register_script('ridez-elementor-product-tab', get_theme_file_uri('/assets/js/elementor/product-tab.js'), array('jquery','elementor-frontend'), $ridez_version, true);
            wp_register_script('ridez-elementor-products', get_theme_file_uri('/assets/js/elementor/products.js'), array('jquery','elementor-frontend'), $ridez_version, true);
            wp_register_script('ridez-elementor-tabs', get_theme_file_uri('/assets/js/elementor/tabs.js'), array('jquery','elementor-frontend'), $ridez_version, true);
            wp_register_script('ridez-elementor-testimonial', get_theme_file_uri('/assets/js/elementor/testimonial.js'), array('jquery','elementor-frontend'), $ridez_version, true);
            wp_register_script('ridez-elementor-video', get_theme_file_uri('/assets/js/elementor/video.js'), array('jquery','elementor-frontend'), $ridez_version, true);
           
        }

        public function add_category() {
            Elementor\Plugin::instance()->elements_manager->add_category(
                'ridez-addons',
                array(
                    'title' => esc_html__('Ridez Addons', 'ridez'),
                    'icon'  => 'fa fa-plug',
                ),
                1);
        }

        public function add_animations_scroll($animations) {
            $animations['Ridez Animation'] = [
                'opal-move-up'    => 'Move Up',
                'opal-move-down'  => 'Move Down',
                'opal-move-left'  => 'Move Left',
                'opal-move-right' => 'Move Right',
                'opal-flip'       => 'Flip',
                'opal-helix'      => 'Helix',
                'opal-scale-up'   => 'Scale',
                'opal-am-popup'   => 'Popup',
            ];

            return $animations;
        }

        public function customs_widgets() {
            $files = glob(get_theme_file_path('/inc/elementor/custom-widgets/*.php'));
            foreach ($files as $file) {
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        }

        /**
         * @param $widgets_manager Elementor\Widgets_Manager
         */
        public function include_widgets($widgets_manager) {
            $files = glob(get_theme_file_path('/inc/elementor/widgets/*.php'));
            foreach ($files as $file) {
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        }

        public function woocommerce_fix_notice() {
            if (ridez_is_woocommerce_activated()) {
                remove_action('woocommerce_cart_is_empty', 'woocommerce_output_all_notices', 5);
                remove_action('woocommerce_shortcode_before_product_cat_loop', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_single_product', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_cart', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_account_content', 'woocommerce_output_all_notices', 10);
                remove_action('woocommerce_before_customer_login_form', 'woocommerce_output_all_notices', 10);
            }
        }

        public function add_icons( $manager ) {
            $new_icons = json_decode( '{"ridez-icon-accessories":"accessories","ridez-icon-alarm-clock":"alarm-clock","ridez-icon-angle-down":"angle-down","ridez-icon-angle-left":"angle-left","ridez-icon-angle-right":"angle-right","ridez-icon-angle-up":"angle-up","ridez-icon-arrow-corner-up-right":"arrow-corner-up-right","ridez-icon-arrow-left":"arrow-left","ridez-icon-arrow-right":"arrow-right","ridez-icon-bike":"bike","ridez-icon-bike1":"bike1","ridez-icon-bike2":"bike2","ridez-icon-call":"call","ridez-icon-cart-shopping-1":"cart-shopping-1","ridez-icon-check":"check","ridez-icon-chevron-down":"chevron-down","ridez-icon-chevron-left":"chevron-left","ridez-icon-chevron-right":"chevron-right","ridez-icon-chevron-up":"chevron-up","ridez-icon-circle-arrow-left":"circle-arrow-left","ridez-icon-circle-arrow-right":"circle-arrow-right","ridez-icon-delivery":"delivery","ridez-icon-heart2":"heart2","ridez-icon-help":"help","ridez-icon-location-dot":"location-dot","ridez-icon-long-arrow-left":"long-arrow-left","ridez-icon-long-arrow-right":"long-arrow-right","ridez-icon-longtime":"longtime","ridez-icon-minus2":"minus2","ridez-icon-paper-plane-top-1":"paper-plane-top-1","ridez-icon-phone-rotary":"phone-rotary","ridez-icon-phone":"phone","ridez-icon-play2":"play2","ridez-icon-plus2":"plus2","ridez-icon-quick-view":"quick-view","ridez-icon-quote1":"quote1","ridez-icon-quote2":"quote2","ridez-icon-search2":"search2","ridez-icon-subscribe":"subscribe","ridez-icon-support":"support","ridez-icon-support2":"support2","ridez-icon-truck-fast":"truck-fast","ridez-icon-user2":"user2","ridez-icon-360":"360","ridez-icon-bars":"bars","ridez-icon-caret-down":"caret-down","ridez-icon-caret-left":"caret-left","ridez-icon-caret-right":"caret-right","ridez-icon-caret-up":"caret-up","ridez-icon-cart-empty":"cart-empty","ridez-icon-check-square":"check-square","ridez-icon-circle":"circle","ridez-icon-cloud-download-alt":"cloud-download-alt","ridez-icon-columns":"columns","ridez-icon-comment":"comment","ridez-icon-comments":"comments","ridez-icon-compare":"compare","ridez-icon-contact":"contact","ridez-icon-credit-card":"credit-card","ridez-icon-dot-circle":"dot-circle","ridez-icon-edit":"edit","ridez-icon-envelope":"envelope","ridez-icon-expand-alt":"expand-alt","ridez-icon-external-link-alt":"external-link-alt","ridez-icon-eye":"eye","ridez-icon-file-alt":"file-alt","ridez-icon-file-archive":"file-archive","ridez-icon-filter-ul":"filter-ul","ridez-icon-filter":"filter","ridez-icon-folder-open":"folder-open","ridez-icon-folder":"folder","ridez-icon-frown":"frown","ridez-icon-gift":"gift","ridez-icon-grid":"grid","ridez-icon-grip-horizontal":"grip-horizontal","ridez-icon-heart-fill":"heart-fill","ridez-icon-heart":"heart","ridez-icon-history":"history","ridez-icon-home":"home","ridez-icon-info-circle":"info-circle","ridez-icon-instagram":"instagram","ridez-icon-level-up-alt":"level-up-alt","ridez-icon-list":"list","ridez-icon-map-marker-check":"map-marker-check","ridez-icon-meh":"meh","ridez-icon-minus-circle":"minus-circle","ridez-icon-minus":"minus","ridez-icon-mobile-android-alt":"mobile-android-alt","ridez-icon-money-bill":"money-bill","ridez-icon-pencil-alt":"pencil-alt","ridez-icon-play-circle":"play-circle","ridez-icon-play":"play","ridez-icon-plus-circle":"plus-circle","ridez-icon-plus":"plus","ridez-icon-quickview":"quickview","ridez-icon-quote":"quote","ridez-icon-random":"random","ridez-icon-reply-all":"reply-all","ridez-icon-reply":"reply","ridez-icon-search-plus":"search-plus","ridez-icon-search":"search","ridez-icon-shield-check":"shield-check","ridez-icon-shopping-basket":"shopping-basket","ridez-icon-shopping-cart":"shopping-cart","ridez-icon-sign-out-alt":"sign-out-alt","ridez-icon-smile":"smile","ridez-icon-spinner":"spinner","ridez-icon-square":"square","ridez-icon-star":"star","ridez-icon-store":"store","ridez-icon-sync":"sync","ridez-icon-tachometer-alt":"tachometer-alt","ridez-icon-th-large":"th-large","ridez-icon-th-list":"th-list","ridez-icon-thumbtack":"thumbtack","ridez-icon-ticket":"ticket","ridez-icon-times-circle":"times-circle","ridez-icon-times":"times","ridez-icon-trophy-alt":"trophy-alt","ridez-icon-truck":"truck","ridez-icon-user-headset":"user-headset","ridez-icon-user-shield":"user-shield","ridez-icon-user":"user","ridez-icon-video":"video","ridez-icon-adobe":"adobe","ridez-icon-amazon":"amazon","ridez-icon-android":"android","ridez-icon-angular":"angular","ridez-icon-apper":"apper","ridez-icon-apple":"apple","ridez-icon-atlassian":"atlassian","ridez-icon-behance":"behance","ridez-icon-bitbucket":"bitbucket","ridez-icon-bitcoin":"bitcoin","ridez-icon-bity":"bity","ridez-icon-bluetooth":"bluetooth","ridez-icon-btc":"btc","ridez-icon-centos":"centos","ridez-icon-chrome":"chrome","ridez-icon-codepen":"codepen","ridez-icon-cpanel":"cpanel","ridez-icon-discord":"discord","ridez-icon-dochub":"dochub","ridez-icon-docker":"docker","ridez-icon-dribbble":"dribbble","ridez-icon-dropbox":"dropbox","ridez-icon-drupal":"drupal","ridez-icon-ebay":"ebay","ridez-icon-facebook":"facebook","ridez-icon-figma":"figma","ridez-icon-firefox":"firefox","ridez-icon-google-plus":"google-plus","ridez-icon-google":"google","ridez-icon-grunt":"grunt","ridez-icon-gulp":"gulp","ridez-icon-html5":"html5","ridez-icon-joomla":"joomla","ridez-icon-link-brand":"link-brand","ridez-icon-linkedin":"linkedin","ridez-icon-mailchimp":"mailchimp","ridez-icon-opencart":"opencart","ridez-icon-paypal":"paypal","ridez-icon-pinterest-p":"pinterest-p","ridez-icon-reddit":"reddit","ridez-icon-skype":"skype","ridez-icon-slack":"slack","ridez-icon-snapchat":"snapchat","ridez-icon-spotify":"spotify","ridez-icon-trello":"trello","ridez-icon-twitte-1":"twitte-1","ridez-icon-twitter":"twitter","ridez-icon-vimeo":"vimeo","ridez-icon-whatsapp":"whatsapp","ridez-icon-wordpress":"wordpress","ridez-icon-yoast":"yoast","ridez-icon-youtube":"youtube"}', true );
			$icons     = $manager->get_control( 'icon' )->get_settings( 'options' );
			$new_icons = array_merge(
				$new_icons,
				$icons
			);
			// Then we set a new list of icons as the options of the icon control
			$manager->get_control( 'icon' )->set_settings( 'options', $new_icons ); 
        }

        public function add_icons_native($tabs) {
            global $ridez_version;
            $tabs['opal-custom'] = [
                'name'          => 'ridez-icon',
                'label'         => esc_html__('Ridez Icon', 'ridez'),
                'prefix'        => 'ridez-icon-',
                'displayPrefix' => 'ridez-icon-',
                'labelIcon'     => 'fab fa-font-awesome-alt',
                'ver'           => $ridez_version,
                'fetchJson'     => get_theme_file_uri('/inc/elementor/icons.json'),
                'native'        => true,
            ];

            return $tabs;
        }
    }

endif;

return new Ridez_Elementor();
