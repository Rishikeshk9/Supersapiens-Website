<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wavo_Popup_Video extends Widget_Base {
    use Wavo_Helper;
    public function get_name() {
        return 'wavo-popup-video';
    }
    public function get_title() {
        return 'Popup Video (N)';
    }
    public function get_icon() {
        return 'eicon-youtube';
    }
    public function get_categories() {
        return [ 'wavo' ];
    }
    public function get_style_depends() {
        return [ 'youtube-popup' ];
    }
    public function get_script_depends() {
        return [ 'youtube-popup' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'wavo_popup_video_settings',
            [
                'label' => esc_html__('Popup Video', 'wavo'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'video',
            [
                'label' => esc_html__( 'Title', 'wavo' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'https://vimeo.com/127203262',
                'label_block' => true
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section( 'wavo_popup_icon_style',
            [
                'label' => esc_html__( 'Icon', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_responsive_control( 'wavo_popup_icon_alignment',
            [
                'label' => esc_html__( 'Alignment', 'wavo' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .popup-video-wrapper' => 'text-align: {{VALUE}};'],
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'wavo' ),
                        'icon' => 'fa fa-align-left'
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'wavo' ),
                        'icon' => 'fa fa-align-center'
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'wavo' ),
                        'icon' => 'fa fa-align-right'
                    ]
                ],
                'toggle' => true,
                'default' => ''
            ]
        );
        $this->add_responsive_control( 'wavo_popup_icon_size',
            [
                'label' => esc_html__( 'Size', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .popup-video .vid-btn .icon' => 'width:{{SIZE}}px;height:{{SIZE}}px;' ],
            ]
        );
        $this->add_control( 'projects_popup_icon_color',
            [
                'label' => esc_html__( 'Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .popup-video .vid-btn .icon' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'projects_popup_icon_brd_color',
            [
                'label' => esc_html__( 'Border Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .popup-video .vid-btn .icon' => 'color:{{VALUE}};' ],
                'separator' => 'before',
            ]
        );
        $this->add_control( 'projects_popup_icon_outline_color',
            [
                'label' => esc_html__( 'Outline Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .popup-video .vid-btn .icon:after' => 'border-color:{{VALUE}};' ],
                'separator' => 'before',
            ]
        );
        $this->add_control( 'projects_popup_icon_hvrbg_color',
            [
                'label' => esc_html__( 'Hover Background Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .popup-video .vid-btn .icon:before' => 'border-color:{{VALUE}};' ],
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( $settings['video'] ) {
            echo '<div class="popup-video-wrapper">
            <a class="popup-video" href="'.$settings['video'].'">
                <div class="vid-btn">
                    <span class="icon"><i class="fas fa-play"></i></span>
                </div>
            </a>
            </div>';
        }
    }
}
