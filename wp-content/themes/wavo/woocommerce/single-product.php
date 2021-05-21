<?php

/*
** WooCommerce product page
*/

    get_header();

    do_action("wavo_before_woo_single");

    $active = is_active_sidebar( 'shop-single-sidebar' );
    $product_layout = wavo_settings( 'single_shop_layout', 'full-width' );
?>

<!-- WooCommerce product page container -->
<div id="nt-woo-single" class="nt-woo-single ">

    <!-- Hero section - this function using on all inner pages -->
    <?php wavo_woo_hero_section(); ?>

    <div class="nt-theme-inner-container section-padding">
        <div class="container">
            <div class="row">

                <!-- Left sidebar -->
                <?php if ( 'left-sidebar' == $product_layout && is_active_sidebar( 'shop-single-sidebar' ) ) {
                    echo '<div class="col-lg-4">';
                        dynamic_sidebar( 'shop-single-sidebar' );
                    echo '</div>';
                } ?>

                <?php if ( ( 'left-sidebar' == $product_layout || 'right-sidebar' == $product_layout ) && is_active_sidebar( 'shop-single-sidebar' ) ) { ?>
                    <div class="col-lg-8">
                    <?php } else { ?>
                        <div class="col-lg-12">
                        <?php } ?>

                        <div class="content-container">

                            <?php woocommerce_content(); ?>

                        </div>
                    </div>
                    <!-- End sidebar + content -->

                    <!-- Right sidebar -->
                    <?php if ( 'right-sidebar' == $product_layout && is_active_sidebar( 'shop-single-sidebar' ) ) {
                        echo '<div class="col-lg-4">';
                            dynamic_sidebar( 'shop-single-sidebar' );
                        echo '</div>';
                    } ?>

                </div><!-- End row -->
            </div><!-- End #container -->
        </div><!-- End #blog -->
    </div><!-- End woo shop page general div -->

<?php

    do_action("wavo_after_woo_single");

    get_footer();

?>
