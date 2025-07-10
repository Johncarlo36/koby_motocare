<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Functions hooked in to ridez_page action
	 *
	 * @see ridez_page_header          - 10
	 * @see ridez_page_content         - 20
	 *
	 */
	do_action( 'ridez_page' );
	?>
</article><!-- #post-## -->
