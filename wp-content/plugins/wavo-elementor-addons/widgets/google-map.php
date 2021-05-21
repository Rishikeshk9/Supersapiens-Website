<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.
class Wavo_Map extends Widget_Base {
    use Wavo_Helper;
    public function get_name() {
        return 'wavo-map';
    }
    public function get_title() {
        return 'Google Map (N)';
    }
    public function get_icon() {
        return 'eicon-google-maps';
    }
    public function get_categories() {
        return [ 'wavo' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        $api = get_option( 'wavo_map_api' ) != '' ? get_option( 'wavo_map_api' ) : '';
        if ( $api != '' ) {
        wp_register_script( 'wavo-map', WAVO_PLUGIN_URL. 'assets/front/js/maps/map.js', [ 'jquery','elementor-frontend' ], '1.0.0', true);
        wp_register_script( 'google-js', 'https://maps.googleapis.com/maps/api/js?key='.esc_attr($api).'', '', '' );
        }
    }
    public function get_script_depends() {
        if ( get_option( 'wavo_map_api' ) != '' ) {
            return [ 'wavo-map','google-js' ];
        }
        return [ '' ];
    }
    // Registering Controls
    protected function register_controls() {
        $this->start_controls_section( 'wavo_map_global_controls',
            [
                'label'=> esc_html__( 'Form Data', 'wavo' ),
                'tab'=> Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'wavo_gmap_settings',
            [
                'label' => '<a href="'.esc_url(admin_url('admin.php?page=wavo')).'">Map Settings</a>',
                'type' => Controls_Manager::RAW_HTML,
            ]
        );
        $this->add_control( 'map_info',
            [
                'label' => esc_html__( 'Map Info', 'wavo' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => get_bloginfo( 'name' ),
                'label_block' => true
            ]
        );
        $this->add_control( 'map_color',
            [
                'label' => esc_html__( 'Map Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );
        $this->add_responsive_control( 'zoom',
            [
                'label' => esc_html__( 'Zoom', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'step' => 1,
                'default' => 12
            ]
        );
        $this->add_control( 'use_custom_color',
            [
                'label' => esc_html__( 'Custom Color?', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'wavo_map_custom_color_controls',
            [
                'label'=> esc_html__( 'Map Colors', 'wavo' ),
                'tab'=> Controls_Manager::TAB_CONTENT,
                'condition' => ['use_custom_color' => 'yes']
            ]
        );
        $this->add_control( 'labels_text_fill',
            [
                'label' => esc_html__( 'Labels Text Fill Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );
        $this->add_control( 'labels_text_stroke',
            [
                'label' => esc_html__( 'Labels Text Stroke Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );
        $this->add_control( 'administrative',
            [
                'label' => esc_html__( 'Administrative Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );
        $this->add_control( 'landscape',
            [
                'label' => esc_html__( 'Landscape Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );
        $this->add_control( 'poi',
            [
                'label' => esc_html__( 'Poi Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );
        $this->add_control( 'road_highway',
            [
                'label' => esc_html__( 'Road Highway Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );
        $this->add_control( 'road_arterial',
            [
                'label' => esc_html__( 'Road Arterial Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );
        $this->add_control( 'road_local',
            [
                'label' => esc_html__( 'Road Local Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );
        $this->add_control( 'transit',
            [
                'label' => esc_html__( 'Transit Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );
        $this->add_control( 'water',
            [
                'label' => esc_html__( 'Water Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );
        $this->end_controls_section();
        /*****   START CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $elementid = $this->get_id();

        if ( get_option( 'wavo_map_api' ) != '' ) {

            $lat = get_option( 'wavo_map_lat' ) != '' ? get_option( 'wavo_map_lat' ) : 34.0937458;
            $lng = get_option( 'wavo_map_lng' ) != '' ? get_option( 'wavo_map_lng' ) : -118.3614978;
            $title = $settings['map_info'] ? esc_html($settings['map_info']) : '';
            $zoom = $settings['zoom'] ? $settings['zoom'] : 12;
            $colors = array();
            if ( 'yes' == $settings['use_custom_color'] ) {

                $colors[] .= '"tfill":"'.$settings['labels_text_fill'].'"';
                $colors[] .= '"tstroke":"'.$settings['labels_text_stroke'].'"';
                $colors[] .= '"administrative":"'.$settings['administrative'].'"';
                $colors[] .= '"landscape":"'.$settings['landscape'].'"';
                $colors[] .= '"poi":"'.$settings['poi'].'"';
                $colors[] .= '"rhighway":"'.$settings['road_highway'].'"';
                $colors[] .= '"rarterial":"'.$settings['road_arterial'].'"';
                $colors[] .= '"rlocal":"'.$settings['road_local'].'"';
                $colors[] .= '"transit":"'.$settings['transit'].'"';
                $colors[] .= '"water":"'.$settings['water'].'"';
            }
            $colors = !empty($colors) ? ','.implode( ',', $colors ) : '';
            $mcolors = $settings['map_color'] ? $settings['map_color'] : '#000000';
            echo '<div class="map-wrapper"><div class="map" id="ieatmaps" data-map-settings=\'{"lat":'.$lat.',"lng":'.$lng.',"title":"'.$title.'","zoom":'.$zoom.',"mcolors":"'.$mcolors.'"'.$colors.'}\'></div></div>';
        }

    }
}
