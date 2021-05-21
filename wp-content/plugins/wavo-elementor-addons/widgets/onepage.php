<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wavo_Onepage extends Widget_Base {
    use Wavo_Helper;
    public function get_name() {
        return 'wavo-onepage';
    }
    public function get_title() {
        return 'Onepage Slider (N)';
    }
    public function get_icon() {
        return 'eicon-slider-push';
    }
    public function get_categories() {
        return [ 'wavo' ];
    }
    public function get_style_depends() {
        return [ 'swiper','animated-headline' ];
    }
    public function get_script_depends() {
        return [ 'swiper','wow', 'splitting', 'animated-headline' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   END CONTROLS SECTION   ******/
        $this->start_controls_section( 'home_slider_content_section',
            [
                'label' => esc_html__( 'Content', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'content',
            [
                'label' => esc_html__( 'Content', 'elementories' ),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple' => false,
                'options' => $this->wavo_get_elementor_templates()
            ]
        );
        $this->add_control( 'bg_video_mute',
            [
                'label' => esc_html__( 'Background Video Sound?', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no'
            ]
        );
        $this->add_control( 'destroy_mobile',
            [
                'label' => esc_html__( 'Disable Slider On Mobile', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        $this->start_controls_section( 'home_slider_section',
            [
                'label' => esc_html__( 'Slider Options', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'direction',
            [
                'label' => esc_html__( 'Direction', 'wavo' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'horizontal' => [
                        'title' => esc_html__( 'Left', 'wavo' ),
                        'icon' => 'eicon-h-align-left'
                    ],
                    'vertical' => [
                        'title' => esc_html__( 'Center', 'wavo' ),
                        'icon' => 'eicon-v-align-bottom'
                    ]
                ],
                'toggle' => false,
                'default' => 'vertical'
            ]
        );
        $this->add_control( 'pagination',
            [
                'label' => esc_html__( 'Pagination Type', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'fraction',
                'options' => [
                    'fraction' => esc_html__( 'fraction', 'wavo' ),
                    'dots' => esc_html__( 'dots', 'wavo' ),
                    'number' => esc_html__( 'number', 'wavo' ),
                    'thumb' => esc_html__( 'thumbs', 'wavo' ),
                    'custom' => esc_html__( 'Custom Pagination', 'wavo' ),
                ]
            ]
        );
        $this->add_control( 'custom_type',
            [
                'label' => esc_html__( 'Custom Pagination Type', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'magool',
                'options' => [
                    'magool' => esc_html__( 'Magool', 'wavo' ),
                    'xusni' => esc_html__( 'Xusni', 'wavo' )
                ],
                'condition' => [ 'pagination' => 'custom' ]
            ]
        );
        $this->add_control( 'gallery',
            [
                'label' => esc_html__( 'Add Images', 'plugin-domain' ),
                'type' => Controls_Manager::GALLERY,
                'condition' => [ 'pagination' => 'thumb' ],
                'separator' => 'before'
            ]
        );
        $this->add_control( 'speed',
            [
                'label' => esc_html__( 'Speed', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 5000,
                'step' => 100,
                'default' => 1000,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'parallax',
            [
                'label' => esc_html__( 'Parallax', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );
        $this->add_control( 'mobparallax',
            [
                'label' => esc_html__( 'Parallax on Mobile', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => ['parallax' => 'yes']
            ]
        );
        $this->add_control( 'navigation',
            [
                'label' => esc_html__( 'Navigation', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'pagination',
                            'operator' => '!=',
                            'value' => 'thumb'
                        ],
                        [
                            'name' => 'pagination',
                            'operator' => '!=', // it accepts:  =,==, !=,!==,  in, !in etc.
                            'value' => 'custom'
                        ]
                    ]
                ]
            ]
        );
        $this->add_control( 'scrollbar',
            [
                'label' => esc_html__( 'Scrollbar', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'pagination',
                            'operator' => '!=',
                            'value' => 'thumb'
                        ],
                        [
                            'name' => 'pagination',
                            'operator' => '!=', // it accepts:  =,==, !=,!==,  in, !in etc.
                            'value' => 'custom'
                        ]
                    ]
                ]
            ]
        );
        $this->add_control( 'mousewheel',
            [
                'label' => esc_html__( 'Mousewheel', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );
        $this->add_control( 'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no'
            ]
        );
        $this->add_control( 'loop',
            [
                'label' => esc_html__( 'Loop', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no'
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'wavo_slider_custom_pagination_settings',
            [
                'label' => esc_html__('Custom Pagination', 'wavo'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'pagination',
                            'operator' => '==',
                            'value' => 'custom'
                        ],
                        [
                            'name' => 'custom_type',
                            'operator' => '=', // it accepts:  =,==, !=,!==,  in, !in etc.
                            'value' => 'xusni'
                        ]
                    ]
                ]
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'text',
            [
                'label' => esc_html__( 'Title', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Alex Martin'
            ]
        );
        $this->add_control( 'nav_text',
            [
                'label' => esc_html__( 'Items', 'wavo' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{text}}',
                'default' => [
                    [ 'text' => 'Alex Martin' ],
                    [ 'text' => 'Alex Martin' ],
                    [ 'text' => 'Alex Martin' ],
                    [ 'text' => 'Alex Martin' ],
                ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('home_slider_nav_style_section',
            [
                'label'=> esc_html__( 'Nav Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'pagination',
                            'operator' => '!=',
                            'value' => 'thumb'
                        ],
                        [
                            'name' => 'pagination',
                            'operator' => '!=', // it accepts:  =,==, !=,!==,  in, !in etc.
                            'value' => 'custom'
                        ]
                    ]
                ]
            ]
        );
        $this->start_controls_tabs( 'home_slider_nav_tabs');
        $this->start_controls_tab( 'home_slider_nav_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'wavo' ) ]
        );

        $this->wavo_style_bgcolor( 'home_slider_nav_background','{{WRAPPER}} .home-onepage .swiper-nav-ctrl' );
        $this->wavo_style_color( 'home_slider_nav_color','{{WRAPPER}} .home-onepage .swiper-nav-ctrl, {{WRAPPER}} .home-onepage .swiper-nav-ctrl i' );
        $this->wavo_style_border( 'home_slider_nav_border','{{WRAPPER}} .home-onepage .swiper-nav-ctrl' );
        $this->add_control( 'home_slider_nav_line_color',
            [
                'label' => esc_html__( 'Line Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .home-onepage .swiper-nav-ctrl i:after' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab( 'home_slider_nav_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wavo' ) ]
        );

        $this->wavo_style_bgcolor( 'home_slider_nav_hvr_background','{{WRAPPER}} .home-onepage .swiper-nav-ctrl:hover' );
        $this->wavo_style_color( 'home_slider_nav_hvr_color','{{WRAPPER}} .home-onepage .swiper-nav-ctrl:hover, {{WRAPPER}} .home-onepage .swiper-nav-ctrl:hover i' );
        $this->wavo_style_border( 'home_slider_nav_hvr_border','{{WRAPPER}} .home-onepage .swiper-nav-ctrl:hover' );
        $this->add_control( 'home_slider_nav_line_hvr_color',
            [
                'label' => esc_html__( 'Line Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .home-onepage .swiper-nav-ctrl:hover i:after' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('home_slider_dots_style_section',
            [
                'label'=> esc_html__( 'Dots Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [ 'pagination' => 'dots' ]
            ]
        );
        $this->add_responsive_control( 'home_slider_dots_top',
            [
                'label' => esc_html__( 'Top Offset ( % )', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [
                '{{WRAPPER}} .home-onepage.has-pagination.pagination-dots .swiper-container-vertical .swiper-pagination-wrapper' => 'height:auto;top:{{SIZE}}%;transform: translateY(-{{SIZE}}%);' ]
            ]
        );
        $this->add_responsive_control( 'home_slider_dots_right',
            [
                'label' => esc_html__( 'Right Offset ( % )', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [
                '{{WRAPPER}} .home-onepage.has-pagination.pagination-dots .swiper-container-vertical .swiper-pagination-wrapper' => 'right:{{SIZE}}%;' ]
            ]
        );
        $this->add_responsive_control( 'home_slider_dots_size',
            [
                'label' => esc_html__( 'Size', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 20,
                'selectors' => [ '{{WRAPPER}} .home-onepage.pagination-dots .swiper-pagination .nav__item' => 'width:{{SIZE}}px;height:{{SIZE}}px;' ]
            ]
        );
        $this->add_responsive_control( 'home_slider_dots_space',
            [
                'label' => esc_html__( 'Space Between Dots', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 50,
                'step' => 1,
                'default' => 6,
                'selectors' => [ '{{WRAPPER}} .home-onepage.pagination-dots .swiper-pagination .nav__item' => 'margin-bottom:{{SIZE}}px;' ]
            ]
        );
        $this->add_control( 'home_slider_dots_border',
            [
                'label' => esc_html__( 'Border Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .home-onepage.pagination-dots .swiper-pagination .nav__icon' => 'stroke:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'home_slider_dots_background',
            [
                'label' => esc_html__( 'Active Background Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .home-onepage.pagination-dots .swiper-pagination .swiper-pagination-bullet-active' => 'background:{{VALUE}};' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('home_slider_number_style_section',
            [
                'label'=> esc_html__( 'Number Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [ 'pagination' => 'number' ]
            ]
        );
        $this->add_responsive_control( 'home_slider_number_top',
            [
                'label' => esc_html__( 'Top Offset ( % )', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [
                '{{WRAPPER}} .home-onepage.has-pagination.pagination-number .swiper-container-vertical .swiper-pagination-wrapper' => 'height:auto;top:{{SIZE}}%;transform: translateY(-{{SIZE}}%);' ]
            ]
        );
        $this->add_responsive_control( 'home_slider_number_right',
            [
                'label' => esc_html__( 'Right Offset ( % )', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [
                '{{WRAPPER}} .home-onepage.has-pagination.pagination-number .swiper-container-vertical .swiper-pagination-wrapper' => 'right:{{SIZE}}%;' ]
            ]
        );
        $this->add_responsive_control( 'home_slider_number_size',
            [
                'label' => esc_html__( 'Size', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 25,
                'selectors' => [ '{{WRAPPER}} .home-onepage.has-pagination.pagination-number .swiper-pagination .nav__item' => 'width:{{SIZE}}px;height:{{SIZE}}px;' ]
            ]
        );
        $this->add_responsive_control( 'home_slider_number_space',
            [
                'label' => esc_html__( 'Space Between Dots', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 50,
                'step' => 1,
                'default' => 6,
                'selectors' => [ '{{WRAPPER}} .home-onepage.has-pagination.pagination-number .swiper-pagination .nav__item' => 'margin-bottom:{{SIZE}}px;' ]
            ]
        );
        $this->add_control( 'home_slider_number_border',
            [
                'label' => esc_html__( 'Border Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .home-onepage.has-pagination.pagination-number .swiper-pagination .nav__icon' => 'stroke:{{VALUE}};' ]
            ]
        );
        $this->add_responsive_control( 'home_slider_number_border_size',
            [
                'label' => esc_html__( 'Border Width', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 2,
                'selectors' => [ '{{WRAPPER}} .home-onepage.has-pagination.pagination-number .swiper-pagination .nav__icon' => 'stroke-width:{{SIZE}}px;' ]
            ]
        );
        $this->add_responsive_control( 'home_slider_number_fontsize',
            [
                'label' => esc_html__( 'Text Font Size', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 50,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .home-onepage.has-pagination.pagination-number .swiper-pagination .nav__item' => 'font-size:{{SIZE}}px;' ]
            ]
        );
        $this->add_control( 'home_slider_number_color',
            [
                'label' => esc_html__( 'Text Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .home-onepage.has-pagination.pagination-number .swiper-pagination .swiper-pagination-bullet span.number__item' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'home_slider_number_hvr_color',
            [
                'label' => esc_html__( 'Active Text Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .home-onepage.has-pagination.pagination-number .swiper-pagination .swiper-pagination-bullet-active span.number__item' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'home_slider_number_hvr_bg',
            [
                'label' => esc_html__( 'Active Background Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .home-onepage.has-pagination.pagination-number .swiper-pagination .swiper-pagination-bullet-active' => 'background:{{VALUE}};' ],
            ]
        );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('home_slider_scrollbar_style_section',
            [
                'label'=> esc_html__( 'Scrollbar Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'pagination',
                            'operator' => '!=',
                            'value' => 'thumb'
                        ],
                        [
                            'name' => 'pagination',
                            'operator' => '!=', // it accepts:  =,==, !=,!==,  in, !in etc.
                            'value' => 'custom'
                        ]
                    ]
                ]
            ]
        );
        $this->add_control( 'home_slider_scrollbar_color',
            [
                'label' => esc_html__( 'Line Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .home-onepage .swiper-scrollbar' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'home_slider_scrollbar_bar_color',
            [
                'label' => esc_html__( 'Bar Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .home-onepage .swiper-scrollbar-drag' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('home_slider_thumbs_style_section',
            [
                'label'=> esc_html__( 'Thumbnails Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [ 'pagination' => 'thumb' ]
            ]
        );
        $this->add_control( 'thumbs_brd_color',
            [
                'label' => esc_html__( 'Active Border Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .home-onepage .gallery-thumbs .swiper-slide-thumb-active::before' => 'border-color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'thumbs_opacity',
            [
                'label' => esc_html__( 'Opacity', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => 0.6,
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .home-onepage .swiper-container.gallery-thumbs .swiper-slide' => 'opacity:{{SIZE}};' ],
            ]
        );
        $this->add_control( 'thumbs_active_opacity',
            [
                'label' => esc_html__( 'Active Opacity', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => 1,
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .home-onepage .swiper-container.gallery-thumbs .swiper-slide-thumb-active' => 'opacity:{{SIZE}};' ],
            ]
        );
        $this->add_responsive_control( 'thumbs_size',
            [
                'label' => esc_html__( 'Size', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 30,
                'max' => 100,
                'step' => 1,
                'default' => 50,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .home-onepage .swiper-container.gallery-thumbs .swiper-slide' => 'width:{{SIZE}}px;height:{{SIZE}}px;',
                    '{{WRAPPER}} .home-onepage .gallery-thumbs .swiper-slide-thumb-active::before' => 'width:calc( {{SIZE}}px + 6px );height:calc( {{SIZE}}px + 6px );',
                    '{{WRAPPER}} .home-onepage .swiper-container.gallery-thumbs.swiper-container-initialized.swiper-container-vertical' => 'width:calc( {{SIZE}}px + 6px );',
                ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('home_slider_custom_pagination_style_section',
            [
                'label'=> esc_html__( 'Custom Pagination Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [ 'pagination' => 'custom' ]
            ]
        );
        $this->add_control( 'custom_pag_space',
            [
                'label' => esc_html__( 'Space Between Items', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 10,
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .home-onepage .nav--magool .nav__item, {{WRAPPER}} .home-onepage .nav--xusni .nav__item' => 'margin-cottom:{{SIZE}}px;' ]
            ]
        );
        $this->add_control( 'custom_pag_width',
            [
                'label' => esc_html__( 'Width', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 500,
                'step' => 1,
                'default' => 40,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .home-onepage .nav--magool .nav__item, {{WRAPPER}} .home-onepage .nav--xusni .nav__item' => 'width:{{SIZE}}px;',
                    '{{WRAPPER}} .home-onepage .swiper-container.gallery-text.swiper-container-initialized.swiper-container-vertical' => 'width:calc( {{SIZE}}px );',
                ]
            ]
        );
        $this->add_control( 'custom_pag_height',
            [
                'label' => esc_html__( 'Height', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 5,
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .home-onepage .nav--magool .nav__item, {{WRAPPER}} .home-onepage .nav--xusni .nav__item' => 'height:{{SIZE}}px;' ],
            ]
        );
        $this->add_control( 'custom_pag_radius',
            [
                'label' => esc_html__( 'Border Radius', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 0,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .home-onepage .nav--magool .nav__item, {{WRAPPER}} .home-onepage .nav--xusni .nav__item' => 'border-radius:{{SIZE}}px;',
                    '{{WRAPPER}} .home-onepage .nav--magool .nav__item::after, {{WRAPPER}} .home-onepage .nav--xusni .nav__item::after' => 'border-radius:{{SIZE}}px;',
                ]
            ]
        );
        $this->add_control( 'custom_pag_color',
            [
                'label' => esc_html__( 'Pagination Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .home-onepage .nav--magool .nav__item::after' => 'background-color:{{VALUE}};',
                    '{{WRAPPER}} .home-onepage .nav--xusni .nav__item::after' => 'background-color:{{VALUE}};'
                ]
            ]
        );
        $this->add_control( 'custom_pag_text_color',
            [
                'label' => esc_html__( 'Text Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .home-onepage .nav--xusni .nav__item-title' => 'color:{{VALUE}};',
                ],
                'condition' => [ 'custom_type' => 'xusni' ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'custom_pag_text_typo',
                'label' => esc_html__( 'Typography', 'wavo' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .home-onepage .nav--xusni .nav__item-title',
                'condition' => [ 'custom_type' => 'xusni' ]
            ]
        );
        $this->add_control( 'custom_pag_hvr_color',
            [
                'label' => esc_html__( 'Active / Hover Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .home-onepage .nav--magool .nav__item:not(.swiper-slide-thumb-active):focus::after' => 'background-color:{{VALUE}};',
                    '{{WRAPPER}} .home-onepage .nav--magool .nav__item:not(.swiper-slide-thumb-active):hover::after' => 'background-color:{{VALUE}};',
                    '{{WRAPPER}} .home-onepage .nav--magool .nav__item.swiper-slide-thumb-active::after' => 'background-color:{{VALUE}};',
                    '{{WRAPPER}} .home-onepage .nav--xusni .nav__item:not(.swiper-slide-thumb-active):focus::after' => 'background-color:{{VALUE}};',
                    '{{WRAPPER}} .home-onepage .nav--xusni .nav__item:not(.swiper-slide-thumb-active):hover::after' => 'background-color:{{VALUE}};',
                    '{{WRAPPER}} .home-onepage .nav--xusni .nav__item.swiper-slide-thumb-active::after' => 'background-color:{{VALUE}};'
                ]
            ]
        );
        $this->add_responsive_control( 'right_offset',
            [
                'label' => esc_html__( 'Right Offset', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 200,
                'step' => 1,
                'default' => 10,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .home-onepage .swiper-container.gallery-text.swiper-container-initialized.swiper-container-vertical' => 'right:{{SIZE}}px;',
                    '.rtl {{WRAPPER}} .home-onepage .swiper-container.gallery-text.swiper-container-initialized.swiper-container-vertical' => 'left:{{SIZE}}px;right:auto;',
                ]
            ]
        );
        $this->add_responsive_control( 'top_offset',
            [
                'label' => esc_html__( 'Top Offset ( % )', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 50,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .home-onepage .swiper-container.gallery-text.swiper-container-initialized.swiper-container-vertical' => 'top:{{SIZE}}%;transform: translateY(-{{SIZE}}%)',
                ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings   = $this->get_settings_for_display();
        $settingsid = $this->get_id();

        $speed      = $settings['speed'] ? $settings['speed'] : 1000;
        $direction  = $settings['direction'] ? $settings['direction'] : 'vertical';
        $pagin      = $settings['pagination'] ? $settings['pagination'] : 'fraction';
        $loop       = 'yes' == $settings['loop'] ? 'true' : 'false';
        $autoplay   = 'yes' == $settings['autoplay'] ? 'true' : 'false';
        $parallax   = 'yes' == $settings['parallax'] ? 'true' : 'false';
        $mobparallax= 'yes' == $settings['mobparallax'] ? 'true' : 'false';
        $navigation = 'yes' == $settings['navigation'] ? 'true' : 'false';
        $scrollbar  = 'yes' == $settings['scrollbar'] ? 'true' : 'false';
        $mousewheel = 'yes' == $settings['mousewheel'] ? 'true' : 'false';
        $thumbs     = 'thumb' == $settings['pagination'] ? 'true' : 'false';
        $hascrollbar= 'yes' == $settings['scrollbar'] ? ' has-scrollbar' : '';
        $hasnav     = 'yes' == $settings['navigation'] ? ' has-navigation' : '';
        $hasthumb   = 'thumb' == $settings['pagination'] || 'custom' == $settings['pagination'] ? ' has-thumb' : '';
        $pagination = 'fraction' == $settings['pagination'] || 'thumb' == $settings['pagination'] || 'custom' == $settings['pagination'] ? 'fraction' : $settings['pagination'];
        $pagination = $settings['pagination'] ? ' has-pagination pagination-'.$pagination : '';
        $hasparallax= 'yes' == $settings['parallax'] ? ' has-parallax-effect' : '';
        $video_mute = 'yes' == $settings['bg_video_mute'] ? ' video-unmute' : '';
        $destroy = 'yes' == $settings['destroy_mobile'] ? 'true' : 'false';

        echo '<div class="slider home-onepage '.$hascrollbar.$hasnav.$pagination.$hasthumb.$hasparallax.$video_mute.'" data-slider-settings=\'{"loop":'.$loop.',"autoplay":'.$autoplay.',"destroy":"'.$destroy.'","direction":"'.$direction.'","thumbs":'.$thumbs.',"parallax":'.$parallax.',"mobparallax":'.$mobparallax.',"mousewheel":'.$mousewheel.',"navigation":'.$navigation.',"scrollbar":'.$scrollbar.',"speed":'.$speed.',"pagination":"'.$pagin.'"}\'>';
            echo '<div class="swiper-container parallax-slider-two">';

                if ( !empty( $settings[ 'content' ] ) && isset($settings[ 'content' ]) != '' ) {

                    $template = $settings[ 'content' ];
                    $content = new Frontend;
                    $css = ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) ? true : false;
                    echo $content->get_builder_content_for_display( $template, true );

                }

                if ( 'fraction' != $settings['pagination'] && 'thumb' != $settings['pagination'] && 'custom' != $settings['pagination'] ) {

                    echo '<svg class="hidden"><defs><symbol id="icon-circle" viewBox="0 0 16 16"><circle cx="8" cy="8" r="6.215"></circle></symbol></defs></svg>';

                    $dotsclass = 'dots' == $settings['pagination'] || 'number' == $settings['pagination']? ' nav__item' : '';

                    echo '<div class="swiper-pagination-wrapper">';
                        echo '<div class="swiper-pagination'.$dotsclass.'"></div>';
                    echo '</div>';
                }
                if ( 'yes' == $settings['scrollbar'] || 'yes' == $settings['navigation'] ) {
                    $previcon = 'horizontal' == $direction ? 'fas fa-caret-left' : 'fas fa-caret-up';
                    $nexticon = 'horizontal' == $direction ? 'fas fa-caret-right' : 'fas fa-caret-down';
                    echo '<div class="swiper-nav-wrapper">';
                        if ( 'yes' == $settings['navigation'] ) {
                            echo '<div class="swiper-nav-ctrl prev-ctrl"><i class="'.$previcon.'"></i></div>';
                        }
                        if ( 'yes' == $settings['scrollbar'] ) {
                            echo '<div class="swiper-scrollbar"></div>';
                        }
                        if ( 'yes' == $settings['navigation'] ) {
                            echo '<div class="swiper-nav-ctrl next-ctrl"><i class="'.$nexticon.'"></i></div>';
                        }
                    echo '</div>';
                }
                if ( 'fraction' == $settings['pagination'] || 'thumb' == $settings['pagination'] || 'custom' == $settings['pagination'] ) {

                    echo '<div class="swiper-pagination-wrapper">';
                        echo '<div class="swiper-pagination"></div>';
                    echo '</div>';
                }

            echo '</div>';

            if ( 'thumb' == $settings['pagination'] ) {
                echo '<div class="swiper-container gallery-thumbs">';
                echo '<svg class="hidden"><defs><symbol id="icon-circle" viewBox="0 0 16 16"><circle cx="8" cy="8" r="6.215"></circle></symbol></defs></svg>';
                  echo '<div class="swiper-wrapper">';
                      foreach ( $settings[ 'gallery' ] as $image ) {
                          if ( $image['url'] ) {
                              echo '<div class="swiper-slide" style="background-image:url('.$image['url'].')"><svg class="nav__icon"><use xlink:href="#icon-circle"></use></svg></div>';
                          }
                      }
                  echo '</div>';
                echo '</div>';
            }
            if ( 'custom' == $settings['pagination'] ) {
                $type = 'xusni' == $settings['custom_type'] ? 'xusni' : 'magool';
                echo '<div class="swiper-container gallery-text">';
                  echo '<div class="swiper-wrapper nav--'.$type.'">';
                      foreach ( $settings[ 'nav_text' ] as $item ) {

                          if ( 'magool' == $settings['custom_type'] ) {

                            echo '<div class="swiper-slide custom-pagination-magool nav__item"></div>';

                          } else {

                            $text = $item['text'] ? '<span class="nav__item-title">'.$item['text'].'</span>' : '';
                            echo '<div class="swiper-slide custom-pagination-'.$type.' nav__item">'.$text.'</div>';

                          }

                      }
                  echo '</div>';
                echo '</div>';
            }

        echo '</div>';

    }
}
