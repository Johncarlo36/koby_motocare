<?php
get_header(); ?>

    <div id="primary" class="content">
        <main id="main" class="site-main" role="main">
            <div class="error-404 not-found">
                <div class="page-content">
                    <header class="page-header">
                        <h1 class="page-title"><?php esc_html_e('404', 'ridez'); ?></h1>
                        <h3 class="sub-title"><?php esc_html_e('OOPS! THAT PAGE CAN\'T BE FOUND.', 'ridez'); ?></h3>
                    </header><!-- .page-header -->

                    <div class="error-text">
                        <span><?php esc_html_e("It looks like nothing was found at this location. You can either go back to the last page or go to homepage", 'ridez') ?></span>

                    </div>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="return-home c-secondary">
                        <?php esc_html_e('homepage', 'ridez'); ?>
                    </a>
                </div><!-- .page-content -->
            </div><!-- .error-404 -->
        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_footer();