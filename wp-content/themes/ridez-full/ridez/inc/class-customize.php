<?php
if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('Ridez_Customize')) {

    class Ridez_Customize {


        public function __construct() {
            add_action('customize_register', array($this, 'customize_register'));
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         */
        public function customize_register($wp_customize) {

            /**
             * Theme options.
             */
            require_once get_theme_file_path('inc/customize-control/editor.php');
            $this->init_ridez_blog($wp_customize);

            $this->init_ridez_social($wp_customize);

            if (ridez_is_woocommerce_activated()) {
                $this->init_woocommerce($wp_customize);
            }

            do_action('ridez_customize_register', $wp_customize);
        }


        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_ridez_blog($wp_customize) {

            $wp_customize->add_section('ridez_blog_archive', array(
                'title' => esc_html__('Blog', 'ridez'),
            ));

            // =========================================
            // Select Style
            // =========================================

            $wp_customize->add_setting('ridez_options_blog_style', array(
                'type'              => 'option',
                'default'           => 'standard',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ridez_options_blog_style', array(
                'section' => 'ridez_blog_archive',
                'label'   => esc_html__('Blog style', 'ridez'),
                'type'    => 'select',
                'choices' => array(
                    'standard' => esc_html__('Blog Standard', 'ridez'),
                    'grid'  => esc_html__('Blog Grid', 'ridez'),
                    'list'  => esc_html__('Blog List', 'ridez'),
                ),
            ));
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_ridez_social($wp_customize) {

            $wp_customize->add_section('ridez_social', array(
                'title' => esc_html__('Socials', 'ridez'),
            ));
            $wp_customize->add_setting('ridez_options_social_share', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ridez_options_social_share', array(
                'type'    => 'checkbox',
                'section' => 'ridez_social',
                'label'   => esc_html__('Show Social Share', 'ridez'),
            ));
            $wp_customize->add_setting('ridez_options_social_share_facebook', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ridez_options_social_share_facebook', array(
                'type'    => 'checkbox',
                'section' => 'ridez_social',
                'label'   => esc_html__('Share on Facebook', 'ridez'),
            ));
            $wp_customize->add_setting('ridez_options_social_share_twitter', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ridez_options_social_share_twitter', array(
                'type'    => 'checkbox',
                'section' => 'ridez_social',
                'label'   => esc_html__('Share on Twitter', 'ridez'),
            ));
            $wp_customize->add_setting('ridez_options_social_share_linkedin', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ridez_options_social_share_linkedin', array(
                'type'    => 'checkbox',
                'section' => 'ridez_social',
                'label'   => esc_html__('Share on Linkedin', 'ridez'),
            ));
            $wp_customize->add_setting('ridez_options_social_share_google-plus', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ridez_options_social_share_google-plus', array(
                'type'    => 'checkbox',
                'section' => 'ridez_social',
                'label'   => esc_html__('Share on Google+', 'ridez'),
            ));

            $wp_customize->add_setting('ridez_options_social_share_pinterest', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ridez_options_social_share_pinterest', array(
                'type'    => 'checkbox',
                'section' => 'ridez_social',
                'label'   => esc_html__('Share on Pinterest', 'ridez'),
            ));
            $wp_customize->add_setting('ridez_options_social_share_email', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ridez_options_social_share_email', array(
                'type'    => 'checkbox',
                'section' => 'ridez_social',
                'label'   => esc_html__('Share on Email', 'ridez'),
            ));
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_woocommerce($wp_customize) {

            $wp_customize->add_panel('woocommerce', array(
                'title' => esc_html__('Woocommerce', 'ridez'),
            ));

            $wp_customize->add_section('ridez_woocommerce_archive', array(
                'title'      => esc_html__('Archive', 'ridez'),
                'capability' => 'edit_theme_options',
                'panel'      => 'woocommerce',
                'priority'   => 1,
            ));

            $wp_customize->add_setting('ridez_options_woocommerce_archive_layout', array(
                'type'              => 'option',
                'default'           => 'default',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ridez_options_woocommerce_archive_layout', array(
                'section' => 'ridez_woocommerce_archive',
                'label'   => esc_html__('Layout Style', 'ridez'),
                'type'    => 'select',
                'choices' => array(
                    'default'   => esc_html__('Sidebar', 'ridez'),
                    'canvas'    => esc_html__('Canvas Filter', 'ridez'),
                    'dropdown'  => esc_html__('Dropdown Filter', 'ridez'),
                    'fullwidth' => esc_html__('Full Width', 'ridez'),
                ),
            ));

            $wp_customize->add_setting('ridez_options_woocommerce_archive_sidebar', array(
                'type'              => 'option',
                'default'           => 'left',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ridez_options_woocommerce_archive_sidebar', array(
                'section' => 'ridez_woocommerce_archive',
                'label'   => esc_html__('Sidebar Position', 'ridez'),
                'type'    => 'select',
                'choices' => array(
                    'left'  => esc_html__('Left', 'ridez'),
                    'right' => esc_html__('Right', 'ridez'),

                ),
            ));

            // =========================================
            // Single Product
            // =========================================

            $wp_customize->add_section('ridez_woocommerce_single', array(
                'title'      => esc_html__('Single Product', 'ridez'),
                'capability' => 'edit_theme_options',
                'panel'      => 'woocommerce',
            ));

            $wp_customize->add_setting('ridez_options_single_product_gallery_layout', array(
                'type'              => 'option',
                'default'           => 'horizontal',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('ridez_options_single_product_gallery_layout', array(
                'section' => 'ridez_woocommerce_single',
                'label'   => esc_html__('Style', 'ridez'),
                'type'    => 'select',
                'choices' => array(
                    'horizontal' => esc_html__('Horizontal', 'ridez'),
                    'vertical'   => esc_html__('Vertical', 'ridez'),
                    'sticky'     => esc_html__('Sticky', 'ridez'),
                    'gallery'    => esc_html__('Gallery', 'ridez'),
                    'carousel'    => esc_html__('Carousel', 'ridez'),
                ),
            ));

            $wp_customize->add_setting('ridez_options_single_product_archive_sidebar', array(
                'type'              => 'option',
                'default'           => 'left',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('ridez_options_single_product_archive_sidebar', array(
                'section' => 'ridez_woocommerce_single',
                'label'   => esc_html__('Sidebar Position', 'ridez'),
                'type'    => 'select',
                'choices' => array(
                    'left'  => esc_html__('Left', 'ridez'),
                    'right' => esc_html__('Right', 'ridez'),

                ),
            ));


            // =========================================
            // Product
            // =========================================

            $wp_customize->add_section('ridez_woocommerce_product', array(
                'title'      => esc_html__('Product Block', 'ridez'),
                'capability' => 'edit_theme_options',
                'panel'      => 'woocommerce',
            ));

            $wp_customize->add_setting('ridez_options_wocommerce_block_style', array(
                'type'              => 'option',
                'default'           => '1',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('ridez_options_wocommerce_block_style', array(
                'section' => 'ridez_woocommerce_product',
                'label'   => esc_html__('Style', 'ridez'),
                'type'    => 'select',
                'choices' => array(
                    '1' => esc_html__('Style 1', 'ridez')
                ),
            ));

            $wp_customize->add_setting('ridez_options_woocommerce_product_hover', array(
                'type'              => 'option',
                'default'           => 'none',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('ridez_options_woocommerce_product_hover', array(
                'section' => 'ridez_woocommerce_product',
                'label'   => esc_html__('Animation Image Hover', 'ridez'),
                'type'    => 'select',
                'choices' => array(
                    'none'          => esc_html__('None', 'ridez'),
                    'bottom-to-top' => esc_html__('Bottom to Top', 'ridez'),
                    'top-to-bottom' => esc_html__('Top to Bottom', 'ridez'),
                    'right-to-left' => esc_html__('Right to Left', 'ridez'),
                    'left-to-right' => esc_html__('Left to Right', 'ridez'),
                    'swap'          => esc_html__('Swap', 'ridez'),
                    'fade'          => esc_html__('Fade', 'ridez'),
                    'zoom-in'       => esc_html__('Zoom In', 'ridez'),
                    'zoom-out'      => esc_html__('Zoom Out', 'ridez'),
                ),
            ));

            // =========================================
            // Product Catalog
            // =========================================

            $wp_customize->add_setting(
                'ridez_options_woocommerce_catalog_columns_tablet',
                array(
                    'default'              => 3,
                    'type'                 => 'option',
                    'capability'           => 'manage_woocommerce',
                    'sanitize_callback'    => 'absint',
                    'sanitize_js_callback' => 'absint',
                )
            );

            $wp_customize->add_control(
                'ridez_options_woocommerce_catalog_columns_tablet',
                array(
                    'label'       => __( 'Tablet', 'ridez' ),
                    'section'     => 'woocommerce_product_catalog',
                    'settings'    => 'ridez_options_woocommerce_catalog_columns_tablet',
                    'type'        => 'number',
                    'input_attrs' => array(
                        'min'  => wc_get_theme_support( 'product_grid::min_columns', 1 ),
                        'max'  => wc_get_theme_support( 'product_grid::max_columns', '' ),
                        'step' => 1,
                    ),
                )
            );

            $wp_customize->add_setting(
                'ridez_options_woocommerce_catalog_columns_mobile',
                array(
                    'default'              => 2,
                    'type'                 => 'option',
                    'capability'           => 'manage_woocommerce',
                    'sanitize_callback'    => 'absint',
                    'sanitize_js_callback' => 'absint',
                )
            );

            $wp_customize->add_control(
                'ridez_options_woocommerce_catalog_columns_mobile',
                array(
                    'label'       => __( 'Mobile', 'ridez' ),
                    'section'     => 'woocommerce_product_catalog',
                    'settings'    => 'ridez_options_woocommerce_catalog_columns_mobile',
                    'type'        => 'number',
                    'input_attrs' => array(
                        'min'  => wc_get_theme_support( 'product_grid::min_columns', 1 ),
                        'max'  => wc_get_theme_support( 'product_grid::max_columns', '' ),
                        'step' => 1,
                    ),
                )
            );
        }
    }
}
return new Ridez_Customize();
