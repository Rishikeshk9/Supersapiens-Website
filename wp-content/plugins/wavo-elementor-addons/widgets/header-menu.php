<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wavo_Header_Menu extends Widget_Base {
    use Wavo_Helper;

    public function get_name() {
        return 'wavo-menu';
    }
    public function get_title() {
        return 'Header Menu (N)';
    }
    public function get_icon() {
        return 'eicon-nav-menu';
    }
    public function get_categories() {
        return [ 'wavo' ];
    }
    public function get_style_depends() {
        return [ 'splitting','splitting-cells' ];
    }
    public function get_script_depends() {
        return [ 'splitting' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('wavo_split_slider_general_settings',
            [
                'label' => esc_html__( 'General', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        // Exclude Category
        $this->add_control( 'register_menus',
            [
                'label' => esc_html__( 'Select Menu', 'wavo' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => false,
                'label_block' => true,
                'options' => $this->nt_registered_nav_menus(),
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'header_menu_item_style_controls_section',
            [
                'label' => esc_html__( 'Menu Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wavo_style_typo( 'header_menu_item_normal_typo', '{{WRAPPER}} .hamenu.open .menu-links .main-menu > li .link' );
        $this->wavo_style_padding( 'header_menu_item_padding', '{{WRAPPER}} .hamenu.open .menu-links .main-menu > li .link' );
        $this->wavo_style_margin( 'header_menu_item_margin', '{{WRAPPER}} .hamenu.open .menu-links .main-menu > li .link' );
        //  Tabs
        $this->start_controls_tabs('header_menu_item_normal_tabs');
        $this->start_controls_tab( 'header_menu_item_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'wavo' ) ]
        );
        $this->wavo_style_color( 'header_menu_item_normal_color', '{{WRAPPER}} .hamenu.open .menu-links .main-menu > li .link' );
        $this->end_controls_tab();
        $this->start_controls_tab('header_menu_item_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wavo' ) ]
        );
        $this->wavo_style_color( 'header_menu_item_hover_color', '{{WRAPPER}} .hamenu.open .menu-links .main-menu > li .link:hover' );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        //  Tabs
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();
        $css = ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) ? ' style="height:96px;"' : '';
        echo '<div id="navi" class="topnav wavo-header"'.$css.'>';
            echo '<div class="container-fluid">';
                echo '<div class="logo">';
                    wavo_logo();
                echo '</div>';
                echo '<div class="menu-icon">';
                    echo '<span class="icon"><i></i><i></i></span>';
                    echo '<span class="text" data-splitting>'. esc_html__( 'Menu', 'wavo' ). '</span>';
                echo '</div>';
            echo '</div>';
        echo '</div>';

        echo '<div class="hamenu"  id="hamenu">';
            echo '<div class="container">';
                echo '<div class="row">';
                    echo '<div class="col-lg-9 col-md-8">';
                        echo '<div class="menu-links">';
                            echo '<ul class="main-menu">';
                                echo wp_nav_menu(
                                    array(
                                        'menu' => $settings['register_menus'],
                                        'theme_location' => 'header_menu',
                                        'container' => '', // menu wrapper element
                                        'container_class' => '',
                                        'container_id' => '', // default: none
                                        'menu_class' => '', // ul class
                                        'menu_id' => '', // ul id
                                        'items_wrap' => '%3$s',
                                        'before' => '', // before <a>
                                        'after' => '', // after <a>
                                        'link_before' => '', // inside <a>, before text
                                        'link_after' => '', // inside <a>, after text
                                        'depth' => 4, // '0' to display all depths
                                        'echo' => true,
                                        'fallback_cb' => 'Wavo_Menu_Navwalker::fallback',
                                        'walker' => new \Wavo_Menu_Navwalker()
                                    )
                                );
                            echo '</ul>';
                        echo '</div>';
                    echo '</div>';

                    echo '<div class="col-lg-3 col-md-4">';
                        echo '<div class="cont-info">';
                            $contact_details = wavo_settings( 'nav_contact', '1' );
                            echo do_shortcode( $contact_details );
                            echo '<div class="item">';
                                echo wavo_content_custom_search_form();
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';

                echo '</div>';
            echo '</div>';
        echo '</div>';

    }
}
