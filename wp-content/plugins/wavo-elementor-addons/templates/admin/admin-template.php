<?php
/**
* Wavo Admin Page Template
*/


?>

    <div class="wavo-admin-wrapper">
        <div class="container">
            <div class="page-heading">
                <h1 class="page-title"><?php _e( 'Wavo Addons', 'wavo' ); ?></h1>
                <p class="page-description">
                    <?php _e( 'Premium & Advanced Essential Elements for Elementor', 'wavo' ); ?>
                </p>
            </div>
            <form class="wavo-form" method="post">

                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-widget-tab" data-toggle="tab" href="#nav-widget" role="tab" aria-controls="nav-widget" aria-selected="false"><?php _e( 'Widgets', 'wavo' ); ?></a>
                        <a class="nav-item nav-link" id="nav-map-tab" data-toggle="tab" href="#nav-map" role="tab" aria-controls="nav-map" aria-selected="true"><?php _e( 'Map', 'wavo' ); ?></a>
                        <a class="nav-item nav-link" id="nav-general-tab" data-toggle="tab" href="#nav-short" role="tab" aria-controls="nav-short" aria-selected="true"><?php _e( 'Shortcodes', 'wavo' ); ?></a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">

                    <div class="tab-pane fade show active" id="nav-widget" role="tabpanel" aria-labelledby="nav-widget-tab">
                        <div class="row widget-row">
                            <?php
    
                            $list = array(
                                'page-hero',
                                'home-slider',
                                'services-item',
                                'projects-slider',
                                'projects-gallery',
                                'justified-gallery',
                                'popup-video',
                                'testimonials-slider',
                                'button',
                                'blog-slider',
                                'brands-board',
                                'about-two-images',
                                'team-member',
                                'project-next',
                                'project-meta',
                                'contact-form-7',
                            );
    
                            foreach ( $list as $widget ) {
    
                                $option = 'disable_'.str_replace( '-', '_', $widget );
                                $name = mb_strtoupper( str_replace( '-', ' ', $widget ) );
    
                                add_option( $option, 0 );
                                if ( isset( $_POST[ $option ] ) ) {
                                    update_option( $option, $_POST[ $option ] );
                                }
    
                                 ?>
    
                                <div class="col-md-4">
                                    <div class="widget-toggle">
                                        <div class="custom-control custom-switch">
                                            <input type="hidden" name="<?php echo esc_attr( $option ); ?>" value="1">
                                            <input type="checkbox" class="custom-control-input" id="<?php echo esc_attr( $option ); ?>" name="<?php echo esc_attr( $option ); ?>" value="0" <?php checked( 0, get_option( $option ), true ); ?>>
                                            <label class="custom-control-label" for="<?php echo esc_attr( $option ); ?>"><?php echo esc_html( $name ); ?></label>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-map" role="tabpanel" aria-labelledby="nav-map-tab">

                        <div class="row widget-row">
                            <div class="col-lg-6">
                                <div class="widget-toggle">
                                    <?php
                                    add_option( 'wavo_map_api' );
                                    if ( isset( $_POST['wavo_map_api'] ) ) {
                                        $api = sanitize_text_field( $_POST['wavo_map_api'] );
                                        update_option( 'wavo_map_api', $api );
                                    }
                                    ?>
                                    <div class="custom-controll">
                                        <label class="custom-control-labell" for="wavo_map_api"><?php _e( 'Map Api Key', 'wavo' ); ?></label>
                                        <input type="text" id="wavo_map_lat" name="wavo_map_api" value="<?php echo esc_attr( get_option( 'wavo_map_api' )); ?>" placeholder="Api Key">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="widget-toggle">
                                    <?php
                                    add_option( 'wavo_map_lat' );
                                    if ( isset( $_POST['wavo_map_lat'] ) ) {
                                        $lat = sanitize_text_field( $_POST['wavo_map_lat'] );
                                        update_option( 'wavo_map_lat', $lat );
                                    }
                                    ?>
                                    <div class="custom-controll">
                                        <label class="custom-control-labell" for="wavo_map_lat"><?php _e( 'Lat Cordinate', 'wavo' ); ?></label>
                                        <input type="hidden" name="wavo_map_lat" value="">
                                        <input type="text" id="wavo_map_lat" name="wavo_map_lat" value="<?php echo esc_attr( get_option( 'wavo_map_lat' )); ?>" placeholder="<?php _e( 'Enter latitude', 'wavo' ); ?>">

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="widget-toggle">
                                    <?php
                                    add_option( 'wavo_map_lng' );
                                    if ( isset( $_POST['wavo_map_lng'] ) ) {
                                        $lng = sanitize_text_field( $_POST['wavo_map_lng'] );
                                        update_option( 'wavo_map_lng', $lng );
                                    }
                                    ?>
                                    <div class="custom-controll">
                                        <label class="custom-control-labell" for="wavo_map_lng"><?php _e( 'Lng Cordinate', 'wavo' ); ?></label>
                                        <input type="hidden" name="wavo_map_lng" value="">
                                        <input type="text" id="wavo_map_lng" name="wavo_map_lng" value="<?php echo esc_attr( get_option( 'wavo_map_lng' )); ?>" placeholder="<?php _e( 'Enter longitude', 'wavo' ); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-short" role="tabpanel" aria-labelledby="nav-short-tab">
                        <div class="row widget-row">
                            <div class="col-md-4">
                                <div class="widget-toggle">
                                    <?php
                                    add_option( 'disable_wavo_list_shortcodes', 0 );
                                    if ( isset( $_POST['disable_wavo_list_shortcodes'] ) ) {
                                        update_option( 'disable_wavo_list_shortcodes', $_POST['disable_wavo_list_shortcodes'] );
                                    }
                                    ?>
                                    <div class="custom-control custom-switch">
                                        <input type="hidden" name="disable_wavo_list_shortcodes" value="1">
                                        <input type="checkbox" class="custom-control-input" id="disable_wavo_list_shortcodes" name="disable_wavo_list_shortcodes" value="0" <?php checked( 0, get_option( 'disable_wavo_list_shortcodes' ), true ); ?>>
                                        <label class="custom-control-label" for="disable_wavo_list_shortcodes"><?php _e( 'Shortcode Creator', 'wavo' ); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-actions">
                    <div class="row">
                        <div class="col-sm-12 submit-container">
                            <?php wp_nonce_field( 'wavo_admin_nonce_field' ); ?>
                            <button type="submit" class="btn btn-primary"><?php _e( 'Save Settings', 'wavo' ); ?></button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
