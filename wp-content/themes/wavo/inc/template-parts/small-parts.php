<?php


/**
 * Custom template parts for this theme.
 *
 * preloader, backtotop, conten-none
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package wavo
*/


/*************************************************
## START PRELOADER
*************************************************/

if ( ! function_exists( 'wavo_preloader' ) ) {
    function wavo_preloader()
    {
        $loading = wavo_settings( 'preloader_text', 'Loading' );
        $loading = $loading ? $loading : esc_html__( 'Loading', 'wavo' );
        $type = wavo_settings('pre_type', 'default');

        if ( '0' != wavo_settings('preloader_visibility', '1') ) {

            if ( 'default' == $type ) {
                wp_enqueue_script( 'pace' );
            ?>

                <div id="preloader">
                    <div class="loading-text"><?php echo esc_html( $loading ); ?></div>
                </div>

            <?php } elseif ( 'custom' == $type ) { ?>
                <div id="nt-preloader" class="preloader custom-preloader">
                    <div class="custom-preloader-inner">
                        <?php echo do_shortcode( wavo_settings('preloader_custom', '') ); ?></div>
                    </div>
                </div>
            <?php } else { ?>

                <div id="nt-preloader" class="preloader">
                    <div class="loader<?php echo esc_attr( $type );?>"></div>
                </div>

                <?php
            }
        }
    }
}
add_action( 'wavo_preloader_action', 'wavo_preloader', 10 );
add_action( 'elementor/page_templates/canvas/before_content', 'wavo_preloader', 10 );

/*************************************************
##  BACKTOP
*************************************************/

if ( ! function_exists( 'wavo_backtop' ) ) {
    function wavo_backtop() {
        if ( '1' == wavo_settings('backtotop_visibility', '1') ) { ?>
            <div class="progress-wrap">
                <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                    <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
                </svg>
            </div>
            <?php
        }
    }
}

/*************************************************
##  CURSOR
*************************************************/

if ( ! function_exists( 'wavo_cursor' ) ) {
    function wavo_cursor() {

        if ( '1' == wavo_settings( 'theme_cursor', '1' ) ) {
            echo '<div id="cursor1" class="cursor cursor1 cursor-type-1 wavo-cursor"></div>';
        }

        if ( '2' == wavo_settings( 'theme_cursor', '1' ) ) {
            echo '<div class="cursor2 cursor-type-2 wavo-cursor"></div>';
        }

        if ( '3' == wavo_settings( 'theme_cursor', '1' ) ) {
            echo '<div class="mouse-cursor cursor-outer cursor-type-3 wavo-cursor"></div>';
            echo '<div class="mouse-cursor cursor-inner wavo-cursor"></div>';
        }

    }
}
add_action( 'wavo_after_main_footer', 'wavo_cursor' );
add_action( 'elementor/page_templates/canvas/after_content', 'wavo_cursor', 10 );

/*************************************************
##  CONTENT NONE
*************************************************/

if ( ! function_exists( 'wavo_content_none' ) ) {
    function wavo_content_none() {
        $wavo_centered = is_search() && 'full-width' == wavo_settings( 'search_layout') ? ' text-center' : '';
    ?>
        <div class="content-none-container text-center">
            <h3 class="__title mb-20 fw-900"><?php esc_html_e( 'Nothing', 'wavo' ); ?> <span class="stroke-text"><?php esc_html_e( 'Found', 'wavo' ); ?></span></h3>
            <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
                <p><?php printf( esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'wavo' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
            <?php elseif ( is_search() ) : ?>
                <p class="__nothing"><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'wavo' ); ?></p>
                <?php echo wavo_content_custom_search_form(); ?>
            <?php else : ?>
                <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'wavo' ); ?></p>
                <?php wavo_content_custom_search_form(); ?>
            <?php endif; ?>
        </div>
    <?php
    }
}
