<?php

/*
 *Template name: Wavo Elementor
 *Template Post Type: post, page, projects
*/

    if ( class_exists( '\Elementor\Core\Settings\Manager' ) ) {
        $page_settings = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' )->get_model( get_the_ID() );
        $header = $page_settings->get_settings( 'wavo_elementor_hide_page_header' );
        if ( 'yes' == $header ) {
            remove_action( 'wavo_header_action', 'wavo_main_header', 10 );
        }
    }
    get_header();

    $page_settings = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' )->get_model( get_the_ID() );
    $theCSS = $page_settings->get_settings( 'wavo_page_custom_css' );

    if ( FALSE === get_option('_wavo_elementor_page_custom_css') ) {
        add_option('_wavo_elementor_page_custom_css', $theCSS);
    } else {
        update_option('_wavo_elementor_page_custom_css', $theCSS);
    }

    // start page content
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            the_content();
        endwhile;
    endif;

get_footer();
