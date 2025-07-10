
<?php
$class      = has_post_thumbnail() ? 'article-default has-thumbnail' : 'article-default';
?>
    <article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
		<?php ridez_post_thumbnail(); ?>
        <div class="post-content">
			<?php
			/**
			 * Functions hooked in to ridez_loop_post action.
			 *
			 * @see ridez_post_header          - 15
			 * @see ridez_post_content         - 30
			 */
			do_action( 'ridez_loop_post' );
			?>
        </div>

    </article><!-- #post-## -->

