<?php

namespace Elementor;

if( !defined( 'ABSPATH' ) ) exit;

use Elementor\Controls_Manager;
use Elementor\Core\Base\Document;
use Elementor\Core\Base\Module as BaseModule;
use Elementor\Plugin;
use Elementor\Utils;
use Elementor\Element_Base;
use Elementor\Core\DocumentTypes\PageBase as PageBase;
use Elementor\Modules\Library\Documents\Page as LibraryPageDocument;

class wavo_Customizing_Default_Widgets {

    private static $instance = null;

    public static function get_instance() {
        if ( null == self::$instance ) {
            self::$instance = new wavo_Customizing_Default_Widgets();
        }
        return self::$instance;
    }

    public function __construct(){
        add_action( 'elementor/element/heading/section_title/after_section_end', [ $this, 'wavo_add_transform_to_heading' ] );
        add_action( 'elementor/element/heading/section_title/before_section_end', [ $this, 'wavo_add_line_to_before_heading' ] );
        add_action( 'elementor/element/image/section_image/after_section_end', [ $this, 'wavo_add_custom_controls_to_image' ] );
        add_action( 'elementor/frontend/widget/before_render',[ $this, 'wavo_add_custom_attr_to_widget' ], 10 );
        add_action( 'elementor/frontend/widget/after_render',[ $this, 'wavo_after_render_widget' ], 10 );

        $locoelements = array(
            'image' => 'section_image',
            'heading' => 'section_title',
            'video' => 'section_image_overlay',
            'text-editor' => 'section_editor',
            'button' => 'section_button',
            'google_maps' => 'section_map',
            'icon' => 'section_icon',
            'image-box' => 'section_image',
            'icon-box' => 'section_icon',
            'star-rating' => 'section_rating',
            'image-carousel' => 'section_additional_options',
            'image-gallery' => 'section_gallery',
            'icon-list' => 'section_icon',
            'counter' => 'section_counter',
            'progress' => 'section_progress',
            'testimonial' => 'section_testimonial',
            'tabs' => 'section_tabs',
            'accordion' => 'section_title',
            'toggle' => 'section_toggle',
            'social-icons' => 'section_social_icon',
            'alert' => 'section_alert',
            'audio' => 'section_audio',
            'shortcode' => 'section_shortcode',
            'html' => 'section_title',
            'sidebar' => 'section_sidebar',
            'spacer' => 'section_spacer',
            'divider' => 'section_divider',
            'wavo-button' => 'wavo_btn_settings',
            'wavo-button2' => 'wavo_btn_animation',
            'wavo-team-member' => 'team_info_style_section',
            'wavo-animated-headline' => 'animated_headline_style_section',
            'wavo-services-item' => 'wavo_services_one_items_settings',
            'wavo-flip-card' => 'flip_card_back_extra_settings',
            'wavo-svg-animation' => 'wavo_flip_card_general_settings',
            'wavo-odometer' => 'animated_odometer_style_section',
        );
        foreach ( $locoelements as $el => $section ) {
            add_action( 'elementor/element/'.$el.'/'.$section.'/after_section_end', [ $this,'wavo_add_locomotive_effect_to_element']);
        }

        $tiltelements = array(
            'image-box' => 'section_image',
            'wavo-team-member' => 'team_info_style_section',
            'wavo-services-item' => 'wavo_services_one_items_settings',
        );
        foreach ( $tiltelements as $el => $section ) {
            add_action( 'elementor/element/'.$el.'/'.$section.'/after_section_end', [ $this,'wavo_add_tilt_effect_to_element']);
        }

    }
    public function wavo_add_locomotive_effect_to_element( $widget )
    {

        $template = basename( get_page_template() );

        if ( $template == 'locomotive-page.php' ) {
            $widget->start_controls_section( 'wavo_locomotive_section',
                [
                    'label' => esc_html__( 'Wavo Locomotive', 'wavo' ),
                    'tab' => Controls_Manager::TAB_CONTENT
                ]
            );
            $widget->add_control( 'wavo_locomotive_switcher',
                [
                    'label' => esc_html__( 'Enable Locomotive Effect', 'wavo' ),
                    'type' => Controls_Manager::SWITCHER,
                ]
            );
            if ( 'image' == $widget->get_name() ) {
                $widget->add_control( 'wavo_locomotive_image_parallax_switcher',
                    [
                        'label' => esc_html__( 'Enable Parallax', 'wavo' ),
                        'type' => Controls_Manager::SWITCHER,
                        'condition' => [ 'wavo_locomotive_switcher' => 'yes' ],
                    ]
                );
                $widget->add_control( 'wavo_locomotive_image_parallax_speed',
                    [
                        'label' => esc_html__( 'Parallax Speed', 'wavo' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => '4',
                        'options' => [
                            '2' => esc_html__( '2X', 'wavo' ),
                            '3' => esc_html__( '3X', 'wavo' ),
                            '4' => esc_html__( '4X', 'wavo' ),
                            '5' => esc_html__( '5X', 'wavo' ),
                            '6' => esc_html__( '6X', 'wavo' ),
                        ],
                        'conditions' => [
                            'relation' => 'and',
                            'terms' => [
                                [
                                    'name' => 'wavo_locomotive_switcher',
                                    'operator' => '==',
                                    'value' => 'yes'
                                ],
                                [
                                    'name' => 'wavo_locomotive_image_parallax_switcher',
                                    'operator' => '==',
                                    'value' => 'yes'
                                ]
                            ]
                        ]
                    ]
                );
                $widget->add_control( 'wavo_locomotive_speed',
                    [
                        'label' => esc_html__( 'Speed', 'wavo' ),
                        'type' => Controls_Manager::NUMBER,
                        'min' => -10,
                        'max' => 10,
                        'step' => 0.1,
                        'default' => '',
                        'description' => esc_html__( 'Element parallax speed. A negative value will reverse the direction.', 'wavo' ),
                        'conditions' => [
                            'relation' => 'and',
                            'terms' => [
                                [
                                    'name' => 'wavo_locomotive_switcher',
                                    'operator' => '==',
                                    'value' => 'yes'
                                ],
                                [
                                    'name' => 'wavo_locomotive_image_parallax_switcher',
                                    'operator' => '!=',
                                    'value' => 'yes'
                                ]
                            ]
                        ]
                    ]
                );
                $widget->add_control( 'wavo_locomotive_delay',
                    [
                        'label' => esc_html__( 'Lerp Delay', 'wavo' ),
                        'type' => Controls_Manager::NUMBER,
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                        'default' => '',
                        'description' => esc_html__( 'Element parallax lerp delay.', 'wavo' ),
                        'conditions' => [
                            'relation' => 'and',
                            'terms' => [
                                [
                                    'name' => 'wavo_locomotive_switcher',
                                    'operator' => '==',
                                    'value' => 'yes'
                                ],
                                [
                                    'name' => 'wavo_locomotive_image_parallax_switcher',
                                    'operator' => '!=',
                                    'value' => 'yes'
                                ]
                            ]
                        ]
                    ]
                );
            } else {
                $widget->add_control( 'wavo_locomotive_speed',
                    [
                        'label' => esc_html__( 'Speed', 'wavo' ),
                        'type' => Controls_Manager::NUMBER,
                        'min' => -10,
                        'max' => 10,
                        'step' => 0.1,
                        'default' => '',
                        'description' => esc_html__( 'Element parallax speed. A negative value will reverse the direction.', 'wavo' ),
                        'condition' => ['wavo_locomotive_switcher' => 'yes']
                    ]
                );
                $widget->add_control( 'wavo_locomotive_delay',
                    [
                        'label' => esc_html__( 'Lerp Delay', 'wavo' ),
                        'type' => Controls_Manager::NUMBER,
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                        'default' => '',
                        'description' => esc_html__( 'Element parallax lerp delay.', 'wavo' ),
                        'condition' => ['wavo_locomotive_switcher' => 'yes']
                    ]
                );
            }
            $widget->add_control( 'wavo_locomotive_direction',
                [
                    'label' => esc_html__( 'Direction', 'wavo' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'vertical',
                    'options' => [
                        'vertical' => esc_html__( 'Vertical', 'wavo' ),
                        'horizontal' => esc_html__( 'Horizontal', 'wavo' ),
                    ],
                    'condition' => [ 'wavo_locomotive_switcher' => 'yes' ],
                ]
            );
            $widget->add_control( 'wavo_locomotive_entrance_animation',
                [
                    'label' => esc_html__( 'Entrance Animation', 'wavo' ),
                    'type' => Controls_Manager::ANIMATION,
                    'separator' => 'before',
                    'condition' => ['wavo_locomotive_switcher' => 'yes']
                ]
            );
            $widget->add_control( 'wavo_locomotive_entrance_animation_repeat',
                [
                    'label' => esc_html__( 'Entrance Animation Repeat', 'wavo' ),
                    'type' => Controls_Manager::SWITCHER,
                    'condition' => ['wavo_locomotive_switcher' => 'yes']
                ]
            );

            $widget->end_controls_section();
        }
    }
    public function wavo_add_tilt_effect_to_element( $widget )
    {
        $widget->start_controls_section( 'wavo_tilt_effect_section',
            [
                'label' => esc_html__( 'Wavo Tilt Effect', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $widget->add_control( 'wavo_tilt_effect_switcher',
            [
                'label' => esc_html__( 'Enable Tilt Effect', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $widget->add_control( 'wavo_tilt_effect_maxtilt',
            [
                'label' => esc_html__( 'Max Tilt', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 500,
                'step' => 1,
                'default' => 20,
                'condition' => ['wavo_tilt_effect_switcher' => 'yes']
            ]
        );
        $widget->add_control( 'wavo_tilt_effect_perspective',
            [
                'label' => esc_html__( 'Perspective', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10000,
                'step' => 100,
                'default' => 1000,
                'description' => esc_html__( 'Transform perspective, the lower the more extreme the tilt gets.', 'wavo' ),
                'condition' => ['wavo_tilt_effect_switcher' => 'yes']
            ]
        );
        $widget->add_control( 'wavo_tilt_effect_easing',
            [
                'label' => esc_html__( 'Custom Easing', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'cubic-bezier(.03,.98,.52,.99)',
                'label_block' => true,
                'condition' => ['wavo_tilt_effect_switcher' => 'yes']
            ]
        );
        $widget->add_control( 'wavo_tilt_effect_scale',
            [
                'label' => esc_html__( 'Scale', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 1,
                'description' => esc_html__( '2 = 200%, 1.5 = 150%, etc..', 'wavo' ),
                'condition' => ['wavo_tilt_effect_switcher' => 'yes']
            ]
        );
        $widget->add_control( 'wavo_tilt_effect_speed',
            [
                'label' => esc_html__( 'Speed', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 5000,
                'step' => 10,
                'default' => 300,
                'description' => esc_html__( 'Speed of the enter/exit transition.', 'wavo' ),
                'condition' => ['wavo_tilt_effect_switcher' => 'yes']
            ]
        );
        $widget->add_control( 'wavo_tilt_effect_transition',
            [
                'label' => esc_html__( 'Transition', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__( 'Set a transition on enter/exit.', 'wavo' ),
                'condition' => ['wavo_tilt_effect_switcher' => 'yes']
            ]
        );
        $widget->add_control( 'wavo_tilt_effect_disableaxis',
            [
                'label' => esc_html__( 'Disable Axis', 'wavo' ),
                'description' => esc_html__( 'What axis should be disabled. Can be X or Y.', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'None', 'wavo' ),
                    'vertical' => esc_html__( 'X Axis', 'wavo' ),
                    'horizontal' => esc_html__( 'Y Axis', 'wavo' ),
                ],
                'condition' => [ 'wavo_tilt_effect_switcher' => 'yes' ],
            ]
        );
        $widget->add_control( 'wavo_tilt_effect_reset',
            [
                'label' => esc_html__( 'Reset', 'wavo' ),
                'description' => esc_html__( 'If the tilt effect has to be reset on exit.', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => ['wavo_tilt_effect_switcher' => 'yes']
            ]
        );
        $widget->add_control( 'wavo_tilt_effect_glare',
            [
                'label' => esc_html__( 'Glare Effect', 'wavo' ),
                'description' => esc_html__( 'Enables glare effect', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => ['wavo_tilt_effect_switcher' => 'yes']
            ]
        );
        $widget->add_control( 'wavo_tilt_effect_maxglare',
            [
                'label' => esc_html__( 'Max Glare', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1,
                'step' => 0.1,
                'default' => 1,
                'description' => esc_html__( 'From 0 - 1.', 'wavo' ),
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'wavo_tilt_effect_switcher',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'wavo_tilt_effect_glare',
                            'operator' => '==',
                            'value' => 'yes'
                        ]
                    ]
                ]
            ]
        );
        $widget->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'wavo_tilt_effect_glareclr',
                'label' => esc_html__( 'Background', 'wavo' ),
                'types' => ['gradient'],
                'selector' => '{{WRAPPER}} .js-tilt-glare-inner',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'wavo_tilt_effect_switcher',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'wavo_tilt_effect_glare',
                            'operator' => '==',
                            'value' => 'yes'
                        ]
                    ]
                ]
            ]
        );
        $widget->end_controls_section();
    }

    public function wavo_add_line_to_before_heading( $widget )
    {
        $widget->add_control( 'wavo_heading_before_line_switcher',
            [
                'label' => esc_html__( 'Wavo Line Before', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class' => 'wavo-headig-line heading-has-line-',
                'selectors' => ['{{WRAPPER}}.wavo-headig-line .elementor-heading-title' => 'padding-left: 70px;' ],
                'separator' => 'before'
            ]
        );
        $widget->add_responsive_control( 'wavo_heading_before_line_vertical',
            [
                'label' => esc_html__( 'Vertical Position ( % )', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 45,
                'selectors' => [ '{{WRAPPER}}.wavo-headig-line .elementor-heading-title::after' => 'bottom:{{SIZE}}%;' ],
                'condition' => [ 'wavo_heading_before_line_switcher' => 'yes' ],
            ]
        );
        $widget->add_control( 'wavo_heading_before_line_color',
            [
                'label' => esc_html__( 'Line Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}}.wavo-headig-line .elementor-heading-title::after' => 'background-color: {{VALUE}};' ],
                'condition'  => ['wavo_heading_before_line_switcher' => 'yes']
            ]
        );
    }
    public function wavo_add_transform_to_heading( $widget )
    {
        $widget->start_controls_section( 'heading_css_transform_controls_section',
            [
                'label' => esc_html__( 'Wavo CSS Transform', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $widget->add_control( 'heading_vertical_mode_switcher',
            [
                'label' => esc_html__( 'Text Vertical Mode', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $widget->add_responsive_control( 'heading_vertical_mode',
            [
                'label' => esc_html__( 'Vertical Mode', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'translate',
                'options' => [
                    'rl' => esc_html__( 'vertical-rl', 'wavo' ),
                    'lr' => esc_html__( 'vertical-lr', 'wavo' ),
                ],
                'prefix_class' => 'wavo-vertical-mode vertical-',
                'condition' => [ 'heading_vertical_mode_switcher' => 'yes' ],
            ]
        );
        $widget->add_control( 'heading_css_transform_type',
            [
                'label' => esc_html__( 'Transform Type', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'translate',
                'options' => [
                    'translate' => esc_html__( 'translate', 'wavo' ),
                    'scale' => esc_html__( 'scale', 'wavo' ),
                    'rotate' => esc_html__( 'rotate', 'wavo' ),
                    'skew' => esc_html__( 'skew', 'wavo' ),
                    'custom' => esc_html__( 'custom', 'wavo' ),
                ],
                'prefix_class' => 'wavo-transform transform-type-',
            ]
        );
        $widget->add_control( 'heading_css_transform_translate_heading',
            [
                'label' => esc_html__( 'Translate', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [ 'heading_css_transform_type' => 'translate' ]
            ]
        );
        $widget->add_responsive_control( 'heading_css_transform_translate_xy',
            [
                'label' => esc_html__( 'Translate 2D ( X,Y )', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'Xpx,Ypx',
                'selectors' => [ '{{WRAPPER}}.wavo-transform.transform-type-translate .elementor-heading-title' => 'transform:translate( {{VALUE}} );'],
                'condition' => [ 'heading_css_transform_type' => 'translate' ]
            ]
        );
        $widget->add_responsive_control( 'heading_css_transform_translate_xyz',
            [
                'label' => esc_html__( 'Translate 3D ( X,Y,Z )', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'Xpx,Ypx,Zpx',
                'selectors' => [ '{{WRAPPER}}.wavo-transform.transform-type-translate.has-translate-xyz .elementor-heading-title' => 'transform:translate3d( {{VALUE}} );'],
                'prefix_class' => 'has-translate-xyz translate-xyz-',
                'condition' => [ 'heading_css_transform_type' => 'translate' ]
            ]
        );
        // Scale
        $widget->add_control( 'heading_css_transform_scale_heading',
            [
                'label' => esc_html__( 'Scale', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'condition' => [ 'heading_css_transform_type' => 'scale' ],
                'separator' => 'before'
            ]
        );
        $widget->add_responsive_control( 'heading_css_transform_scale_xy',
            [
                'label' => esc_html__( 'Scale 2D ( X,Y )', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'Xpx,Ypx',
                'selectors' => [ '{{WRAPPER}}.wavo-transform.transform-type-translate .elementor-heading-title' => 'transform:scale( {{VALUE}} );'],
                'condition' => [ 'heading_css_transform_type' => 'scale' ]
            ]
        );
        $widget->add_responsive_control( 'heading_css_transform_scale_xyz',
            [
                'label' => esc_html__( 'Scale 3D ( X,Y,Z )', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'Xpx,Ypx,Zpx',
                'selectors' => [ '{{WRAPPER}}.wavo-transform.transform-type-scale.has-scale-xyz .elementor-heading-title' => 'transform:scale3d( {{VALUE}} );'],
                'prefix_class' => 'has-scale-xyz scale-xyz-',
                'condition' => [ 'heading_css_transform_type' => 'scale' ]
            ]
        );
        // Rotate
        $widget->add_control( 'heading_css_transform_rotate_heading',
            [
                'label' => esc_html__( 'Rotate', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'condition' => [ 'heading_css_transform_type' => 'scale' ],
                'separator' => 'before'
            ]
        );
        $widget->add_responsive_control( 'heading_css_transform_rotate_xy',
            [
                'label' => esc_html__( 'Rotate 2D ( X,Y )', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'Xdeg,Ydeg',
                'selectors' => [ '{{WRAPPER}}.wavo-transform.transform-type-rotate .elementor-heading-title' => 'transform:rotate( {{VALUE}} );'],
                'condition' => [ 'heading_css_transform_type' => 'rotate' ]
            ]
        );
        $widget->add_responsive_control( 'heading_css_transform_rotate_xyz',
            [
                'label' => esc_html__( 'Rotate 3D ( X,Y,Z )', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => '0,0,0',
                'selectors' => [ '{{WRAPPER}}.wavo-transform.transform-type-rotate.has-rotate-xyz .elementor-heading-title' => 'transform:translate3d( {{VALUE}}deg );'],
                'prefix_class' => 'has-rotate-xyz rotate-xyz-',
                'condition' => [ 'heading_css_transform_type' => 'rotate' ]
            ]
        );
		// Skew
        $widget->add_control( 'heading_css_transform_skew_heading',
            [
                'label' => esc_html__( 'Skew', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [ 'heading_css_transform_type' => 'skew' ]
            ]
        );
        $widget->add_responsive_control( 'heading_css_transform_skew_xy',
            [
                'label' => esc_html__( 'Skew 2D ( X,Y )', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'Xdeg,Ydeg',
                'selectors' => [ '{{WRAPPER}}.wavo-transform.transform-type-skew .elementor-heading-title' => 'transform:skew( {{VALUE}} );'],
                'condition' => [ 'heading_css_transform_type' => 'skew' ]
            ]
        );
        // Custom
        $widget->add_control( 'heading_css_transform_custom_heading',
            [
                'label' => esc_html__( 'Custom Transform', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [ 'heading_css_transform_type' => 'custom' ]
            ]
        );
        $widget->add_responsive_control( 'heading_css_transform_custom_xy',
            [
                'label' => esc_html__( 'Transform', 'wavo' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => 'rotate(Xdeg,Ydeg) translate(Xpx,Ypx) scale(X,Y)',
                'selectors' => [ '{{WRAPPER}}.wavo-transform.transform-type-custom .elementor-heading-title' => 'transform:( {{VALUE}} );'],
                'condition' => [ 'heading_css_transform_type' => 'custom' ]
            ]
        );
        $widget->end_controls_section();

        $widget->start_controls_section( 'wavo_heading_css_stroke_controls_section',
            [
                'label' => esc_html__( 'Wavo CSS Stroke', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $widget->add_control( 'wavo_heading_css_stroke_switcher',
            [
                'label' => esc_html__( 'Enable Stroke', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class' => 'wavo-stroke wavo-has-stroke-',
            ]
        );
        $widget->add_control( 'wavo_heading_css_stroke_type',
            [
                'label' => esc_html__( 'Stroke Type', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'full',
                'options' => [
                    'full' => esc_html__( 'Full Text', 'wavo' ),
                    'part' => esc_html__( 'Part of Text', 'wavo' ),
                ],
                'prefix_class' => 'wavo-has-stroke-type stroke-type-',
                'condition'  => ['wavo_heading_css_stroke_switcher' => 'yes']
            ]
        );
        $widget->add_control( 'wavo_heading_css_stroke_note',
            [
                'label' => esc_html__( 'Important Note', 'wavo' ),
                'type' => Controls_Manager::RAW_HTML,
                'raw' => esc_html__( 'Please add part of text in <b> your text </b>', 'wavo' ),
                'content_classes' => 'wavo-message',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'wavo_heading_css_stroke_switcher',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'wavo_heading_css_stroke_type',
                            'operator' => '==',
                            'value' => 'part'
                        ]
                    ]
                ]
            ]
        );
        $widget->add_control( 'wavo_heading_css_stroke_width',
            [
                'label' => esc_html__( 'Stroke Width', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 20,
                'step' => 1,
                'default' => 1,
                'selectors' => [
                    '{{WRAPPER}}.wavo-stroke.stroke-type-full .elementor-heading-title' => '-webkit-text-stroke-width: {{SIZE}}px;color:transparent;',
                    '{{WRAPPER}}.wavo-stroke.stroke-type-part .elementor-heading-title b' => '-webkit-text-stroke-width: {{SIZE}}px;color:transparent;',
                ],
                'condition'  => ['wavo_heading_css_stroke_switcher' => 'yes']
            ]
        );
        $widget->add_control( 'wavo_heading_css_stroke_color',
            [
                'label' => esc_html__( 'Stroke Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}}.wavo-stroke.stroke-type-full .elementor-heading-title' => '-webkit-text-stroke-color: {{VALUE}};',
                    '{{WRAPPER}}.wavo-stroke.stroke-type-part .elementor-heading-title b' => '-webkit-text-stroke-color: {{VALUE}};',
                ],
                'condition'  => ['wavo_heading_css_stroke_switcher' => 'yes']
            ]
        );
        $widget->add_control( 'wavo_heading_css_stroke_fill_color',
            [
                'label' => esc_html__( 'Fill Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => 'transparent',
                'selectors' => [
                    '{{WRAPPER}}.wavo-stroke.stroke-type-full .elementor-heading-title' => '-webkit-text-fill-color: {{VALUE}};',
                    '{{WRAPPER}}.wavo-stroke.stroke-type-part .elementor-heading-title b' => '-webkit-text-fill-color: {{VALUE}};',
                ],
                'condition'  => ['wavo_heading_css_stroke_switcher' => 'yes']
            ]
        );
        $widget->end_controls_section();

        $template = basename( get_page_template() );

        if ( $template != 'locomotive-page.php' ) {
            $widget->start_controls_section( 'wavo_heading_parallax_controls_section',
                [
                    'label' => esc_html__( 'Wavo Parallax', 'wavo' ),
                    'tab' => Controls_Manager::TAB_CONTENT
                ]
            );
            $widget->add_control( 'wavo_heading_parallax_switcher',
                [
                    'label' => esc_html__( 'Enable Parallax', 'wavo' ),
                    'type' => Controls_Manager::SWITCHER,
                    'prefix_class' => 'wavo-headig-parallax heading-has-parallax-',
                ]
            );
            $widget->add_control( 'wavo_heading_parallax_note',
                [
                    'label' => esc_html__( 'Important Note', 'wavo' ),
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => esc_html__( 'This option only works if there is a background image.Please add background image before.', 'wavo' ),
                    'content_classes' => 'wavo-message',
                    'condition'  => ['wavo_heading_parallax_switcher' => 'yes']
                ]
            );
            $widget->end_controls_section();
        }

        $widget->start_controls_section( 'wavo_heading_split_controls_section',
            [
                'label' => esc_html__( 'Wavo Split Text', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $widget->add_control( 'wavo_heading_split_switcher',
            [
                'label' => esc_html__( 'Enable Split', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class' => 'wavo-headig-split heading-has-split-',
            ]
        );
        $widget->add_control( 'wavo_heading_split_type',
            [
                'label' => esc_html__( 'Split Type', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'chars',
                'options' => [
                    'chars' => esc_html__( 'Chars', 'wavo' ),
                    'words' => esc_html__( 'Words', 'wavo' ),
                ],
                'condition' => ['wavo_heading_split_switcher' => 'yes'],
            ]
        );
        $widget->add_control( 'wavo_heading_split_entrance_animation',
            [
                'label' => esc_html__( 'Entrance Animation', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'fadeInUp2',
                'options' => [
                    'fadeIn2' => esc_html__( 'fadeIn', 'wavo' ),
                    'fadeInUp2' => esc_html__( 'fadeInUp', 'wavo' ),
                    'fadeInRight2' => esc_html__( 'fadeInRight', 'wavo' ),
                    'fadeInLeft2' => esc_html__( 'fadeInLeft', 'wavo' ),
                    'fadeInDown2' => esc_html__( 'fadeInDown', 'wavo' ),
                    'bounceIn2' => esc_html__( 'bounceIn', 'wavo' ),
                    'bounceInUp2' => esc_html__( 'bounceInUp', 'wavo' ),
                    'bounceInRight2' => esc_html__( 'bounceInRight', 'wavo' ),
                    'bounceInLeft2' => esc_html__( 'bounceInLeft', 'wavo' ),
                    'bounceInDown2' => esc_html__( 'bounceInDown', 'wavo' ),
                    'slideIn' => esc_html__( 'slideIn', 'wavo' ),
                    'slideInDown' => esc_html__( 'slideInDown', 'wavo' ),
                    'slideInUp' => esc_html__( 'slideInUp', 'wavo' ),
                    'slideInLeft' => esc_html__( 'slideInLeft', 'wavo' ),
                    'slideInRight' => esc_html__( 'slideInRight', 'wavo' ),
                    'zoomIn' => esc_html__( 'zoomIn', 'wavo' ),
                    'zoomInDown' => esc_html__( 'zoomInDown', 'wavo' ),
                    'zoomInUp' => esc_html__( 'zoomInUp', 'wavo' ),
                    'zoomInLeft' => esc_html__( 'zoomInLeft', 'wavo' ),
                    'zoomInRight' => esc_html__( 'zoomInRight', 'wavo' ),
                    'rotateIn' => esc_html__( 'rotateIn', 'wavo' ),
                    'rotateInDownRight' => esc_html__( 'rotateInDownRight', 'wavo' ),
                    'rotateInUpLeft' => esc_html__( 'rotateInUpLeft', 'wavo' ),
                    'rotateInUpRight' => esc_html__( 'rotateInUpRight', 'wavo' ),
                ],
                'condition' => ['wavo_heading_split_switcher' => 'yes'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title.animated .char' => '-webkit-animation: {{VALUE}} 0.4s cubic-bezier(0.3, 0, 0.7, 1) both; animation: {{VALUE}} 0.4s cubic-bezier(0.3, 0, 0.7, 1) both;',
                    '{{WRAPPER}} .elementor-heading-title.animated .word' => '-webkit-animation: {{VALUE}} 0.4s cubic-bezier(0.3, 0, 0.7, 1) both; animation: {{VALUE}} 0.4s cubic-bezier(0.3, 0, 0.7, 1) both;',
                ]
            ]
        );
        $widget->add_control( 'wavo_heading_split_delay',
            [
                'label' => esc_html__( 'Delay', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 500,
                'step' => 1,
                'default' => 30,
                'description'=> esc_html__( 'the delay is in millisecond', 'wavo' ),
                'condition' => ['wavo_heading_split_switcher' => 'yes'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title.animated .char' => '-webkit-animation-delay: calc({{VALUE}}ms * var(--char-index)); animation-delay: calc({{VALUE}}ms * var(--char-index));',
                    '{{WRAPPER}} .elementor-heading-title.animated .word' => '-webkit-animation-delay: calc({{VALUE}}ms * var(--word-index)); animation-delay: calc({{VALUE}}ms * var(--word-index));',
                ]
            ]
        );
        $widget->add_control( 'wavo_heading_split_space',
            [
                'label' => esc_html__( 'Space Between Word', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 50,
                'step' => 1,
                'default' => 10,
                'condition' => ['wavo_heading_split_switcher' => 'yes'],
                'selectors' => ['{{WRAPPER}} .elementor-heading-title.splitting .whitespace' => 'width:{{VALUE}}px;']
            ]
        );
        $widget->end_controls_section();
    }

    public function wavo_add_custom_controls_to_image( $widget )
    {
        $template = basename( get_page_template() );

        if ( $template != 'locomotive-page.php' ) {
            $widget->start_controls_section( 'wavo_image_parallax_controls_section',
                [
                    'label' => esc_html__( 'Wavo Parallax', 'wavo' ),
                    'tab' => Controls_Manager::TAB_CONTENT,
                    'condition' => [ 'image[url]!' => '' ],
                ]
            );
            $widget->add_control( 'wavo_image_parallax_switcher',
                [
                    'label' => esc_html__( 'Enable Parallax', 'wavo' ),
                    'type' => Controls_Manager::SWITCHER,
                    'prefix_class' => 'wavo-image-parallax image-has-parallax-',
                ]
            );
            $widget->add_control( 'wavo_image_parallax_overflow',
                [
                    'label' => esc_html__( 'Overflow', 'wavo' ),
                    'type' => Controls_Manager::SWITCHER,
                    'condition'  => ['wavo_image_parallax_switcher' => 'yes']
                ]
            );
            $widget->add_control( 'wavo_image_parallax_orientation',
                [
                    'label' => esc_html__( 'Orientation', 'wavo' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'up',
                    'options' => [
                        'up' => esc_html__( 'up', 'wavo' ),
                        'right' => esc_html__( 'right', 'wavo' ),
                        'down' => esc_html__( 'down', 'wavo' ),
                        'left' => esc_html__( 'left', 'wavo' ),
                        'up left' => esc_html__( 'up left', 'wavo' ),
                        'up right' => esc_html__( 'up right', 'wavo' ),
                        'down left' => esc_html__( 'down left', 'wavo' ),
                        'left right' => esc_html__( 'left right', 'wavo' ),
                    ],
                    'condition'  => ['wavo_image_parallax_switcher' => 'yes']
                ]
            );
            $widget->add_control( 'wavo_image_parallax_scale',
                [
                    'label' => esc_html__( 'Scale', 'wavo' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 10,
                    'step' => 0.1,
                    'default' => 1.2,
                    'description'=> esc_html__( 'need to be above 1.0', 'wavo' ),
                    'condition'  => ['wavo_image_parallax_switcher' => 'yes']
                ]
            );
            $widget->add_control( 'wavo_image_parallax_delay',
                [
                    'label' => esc_html__( 'Delay', 'wavo' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 10,
                    'step' => 0.1,
                    'default' => 0.4,
                    'description'=> esc_html__( 'the delay is in second', 'wavo' ),
                    'condition'  => ['wavo_image_parallax_switcher' => 'yes']
                ]
            );
            $widget->add_control( 'wavo_image_parallax_maxtransition',
                [
                    'label' => esc_html__( 'Max Transition ( % )', 'wavo' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 99,
                    'step' => 1,
                    'default' => 0,
                    'description'=> esc_html__( 'it should be a percentage between 1 and 99', 'wavo' ),
                    'condition'  => ['wavo_image_parallax_switcher' => 'yes']
                ]
            );
            $widget->end_controls_section();

            $widget->start_controls_section( 'wavo_image_reveal_effects_controls_section',
                [
                    'label' => esc_html__( 'Reveal Effects', 'wavo' ),
                    'tab' => Controls_Manager::TAB_CONTENT,
                    'condition' => [ 'image[url]!' => '' ],
                ]
            );
            $widget->add_control( 'wavo_image_reveal_switcher',
                [
                    'label' => esc_html__( 'Enable Reveal', 'wavo' ),
                    'type' => Controls_Manager::SWITCHER,
                    'prefix_class' => 'wavo-image-reveal image-has-reveal-',
                ]
            );
            $widget->add_control( 'wavo_image_reveal_orientation',
                [
                    'label' => esc_html__( 'Orientation', 'wavo' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'left',
                    'options' => [
                        'top' => esc_html__( 'up', 'wavo' ),
                        'right' => esc_html__( 'right', 'wavo' ),
                        'bottom' => esc_html__( 'down', 'wavo' ),
                        'left' => esc_html__( 'left', 'wavo' ),
                    ],
                    'condition' => ['wavo_image_reveal_switcher' => 'yes']
                ]
            );
            $widget->add_control( 'wavo_image_reveal_delay',
                [
                    'label' => esc_html__( 'Delay ( ms )', 'wavo' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 10000,
                    'step' => 1,
                    'default' => '',
                    'description' => esc_html__( 'the delay is in second', 'wavo' ),
                    'condition' => ['wavo_image_reveal_switcher' => 'yes']
                ]
            );
            $widget->add_control( 'wavo_image_reveal_offset',
                [
                    'label' => esc_html__( 'Offset ( px )', 'wavo' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => -1000,
                    'max' => 1000,
                    'step' => 1,
                    'default' => '',
                    'condition' => ['wavo_image_reveal_switcher' => 'yes']
                ]
            );
            $widget->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'wavo_image_reveal_color',
                    'label' => esc_html__( 'Background', 'wavo' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .reveal-holder .reveal-block::before',
                    'separator' => 'before',
                    'condition' => ['wavo_image_reveal_switcher' => 'yes']
                ]
            );
            $widget->add_control( 'wavo_image_reveal_once',
                [
                    'label' => esc_html__( 'Animate Once?', 'wavo' ),
                    'type' => Controls_Manager::SWITCHER,
                    'condition' => ['wavo_image_reveal_switcher' => 'yes']
                ]
            );
            $widget->end_controls_section();
        }
    }
    public function wavo_after_render_widget( $widget )
    {
        $tilt_elements_attr = array(
            'image-box',
            'wavo-team-member',
            'wavo-services-item',
        );
        foreach ( $tilt_elements_attr as $w ) {
            if ( $w === $widget->get_name() && 'yes' === $widget->get_settings('wavo_tilt_effect_switcher') ) {
                wp_enqueue_script( 'tilt' );
            }
        }
        if ( 'image' === $widget->get_name() && 'yes' == $widget->get_settings('wavo_image_parallax_switcher') ) {
            wp_enqueue_script( 'simple-parallax' );
        }
        if ( 'image' === $widget->get_name() && 'yes' == $widget->get_settings('wavo_image_reveal_switcher') ) {
            wp_enqueue_style( 'aos' );
            wp_enqueue_script( 'aos' );
        }
        if( 'heading' === $widget->get_name() && 'yes' == $widget->get_settings('wavo_heading_split_switcher') ) {
            wp_enqueue_style( 'splitting' );
            wp_enqueue_style( 'splitting-cells' );
            wp_enqueue_script( 'splitting' );
            wp_enqueue_script( 'wow' );
        }
    }
    public function wavo_add_custom_attr_to_widget( $widget )
    {
        $template = basename( get_page_template() );

        if ( $template != 'locomotive-page.php' ) {
            if( 'image' === $widget->get_name() ) {

                if( 'yes' == $widget->get_settings('wavo_image_parallax_switcher') ) {
                    $mydata = array();
                    $overflow = $widget->get_settings('wavo_image_parallax_overflow');
                    $orientation = $widget->get_settings('wavo_image_parallax_orientation');
                    $scale = $widget->get_settings('wavo_image_parallax_scale');
                    $delay = $widget->get_settings('wavo_image_parallax_delay');
                    $maxtrans = $widget->get_settings('wavo_image_parallax_maxtransition');

                    $mydata[] .= $orientation ? '"orientation":"'.$orientation.'"' : '"orientation":"up"';
                    $mydata[] .= 'yes' == $overflow ? '"overflow": true' : '"overflow": false';
                    $mydata[] .= '' != $scale ? '"scale":'.$scale : '"scale":1.2';
                    $mydata[] .= '' != $delay ? '"delay":'.$delay : '"delay":0.4';
                    $mydata[] .= '' != $maxtrans ? '"maxtrans":'.$maxtrans : '"maxtrans":0';
                    $parallaxattr = '{'.implode(',', $mydata ).'}';
                    $widget->add_render_attribute( '_wrapper', 'data-image-parallax-settings', $parallaxattr);
                }
                if( 'yes' == $widget->get_settings('wavo_image_reveal_switcher') ) {
                    $mydata = array();
                    $orientation = $widget->get_settings('wavo_image_reveal_orientation');
                    $delay = $widget->get_settings('wavo_image_reveal_delay');
                    $offset = $widget->get_settings('wavo_image_reveal_offset');
                    $once = $widget->get_settings('wavo_image_reveal_once');

                    $mydata[] .= $orientation ? '"orientation":"'.$orientation.'"' : '"orientation":"left"';
                    $mydata[] .= '' != $delay ? '"delay":'.$delay : '"delay":""';
                    $mydata[] .= '' != $offset ? '"offset":'.$offset : '"offset":""';
                    $mydata[] .= '' != $once ? '"once": "true"' : '"once":"false"';
                    $revealattr = '{'.implode(',', $mydata ).'}';
                    $widget->add_render_attribute( '_wrapper', 'data-image-reveal-settings', $revealattr);
                }
            }

            if( 'heading' === $widget->get_name() ) {

                if( 'yes' == $widget->get_settings('wavo_heading_split_switcher') ) {

                    $animation = $widget->get_settings('wavo_heading_split_entrance_animation');
                    $animation = $animation ? $animation : 'fadeInUp';
                    $split_type = $widget->get_settings('wavo_heading_split_type');
                    $mydata = '{"type":"'.$split_type.'","animation":"'.$animation.'"}';
                    $widget->add_render_attribute( '_wrapper', 'data-split-settings', $mydata );
                }
            }
        }

        if ( $template == 'locomotive-page.php' ) {
            $loco_elements_attr = array(
                'image',
                'heading',
                'video',
                'text-editor',
                'button',
                'google_maps',
                'icon',
                'image-box',
                'icon-box',
                'star-rating',
                'image-carousel',
                'image-gallery',
                'icon-list',
                'counter',
                'progress',
                'testimonial',
                'tabs',
                'accordion',
                'toggle',
                'social-icons',
                'alert',
                'audio',
                'shortcode',
                'html',
                'sidebar',
                'spacer',
                'divider',
                'wavo-button',
                'wavo-button2',
                'wavo-team-member',
                'wavo-animated-headline',
                'wavo-services-item',
                'wavo-flip-card',
                'wavo-svg-animation',
                'wavo-odometer',
            );
            foreach ( $loco_elements_attr as $w ) {
                if ( $w === $widget->get_name() ) {

                    $widget->add_render_attribute( '_wrapper', 'data-scroll', '' );
                    if ( 'yes' === $widget->get_settings('wavo_locomotive_switcher') ) {

                        $lrepeat = 'yes' === $widget->get_settings('wavo_locomotive_entrance_animation_repeat') ? 'true' : 'false';

                        if ( 'image' === $widget->get_name() ) {
                            if ( 'yes' === $widget->get_settings('wavo_locomotive_image_parallax_switcher') ) {
                                $lspeed = $widget->get_settings('wavo_locomotive_image_parallax_speed');
                                $ldelay = '';
                            } else {
                                $lspeed = $widget->get_settings('wavo_locomotive_speed');
                                $ldelay = $widget->get_settings('wavo_locomotive_delay');
                            }
                        } else {
                            $lspeed = $widget->get_settings('wavo_locomotive_speed');
                            $ldelay = $widget->get_settings('wavo_locomotive_delay');
                        }
                        $widget->add_render_attribute( '_wrapper', 'data-scroll-speed', $lspeed );
                        $widget->add_render_attribute( '_wrapper', 'data-scroll-delay', $ldelay );
                        $widget->add_render_attribute( '_wrapper', 'data-scroll-direction', $widget->get_settings('wavo_locomotive_direction') );
                        $widget->add_render_attribute( '_wrapper', 'data-scroll-class', $widget->get_settings('wavo_locomotive_entrance_animation') );
                        //$widget->add_render_attribute( '_wrapper', 'data-scroll-sticky', $widget->get_settings('wavo_locomotive_sticky') );
                        $widget->add_render_attribute( '_wrapper', 'data-scroll-repeat', $lrepeat );
                    }
                    if ( 'progress' === $widget->get_name() ) {
                        $widget->add_render_attribute( '_wrapper', 'data-scroll-call', 'locoProgressBar' );
                    }
                    if ( 'counter' === $widget->get_name() ) {
                        $widget->add_render_attribute( '_wrapper', 'data-scroll-call', 'locoCounterUp' );
                    }
                    if ( 'wavo-odometer' === $widget->get_name() ) {
                        $widget->add_render_attribute( '_wrapper', 'data-scroll-call', 'locoOdometer' );
                    }
                    if ( 'image' === $widget->get_name() && 'yes' == $widget->get_settings('wavo_locomotive_image_parallax_switcher') ) {
                        $widget->add_render_attribute( '_wrapper', 'data-scroll-call', 'locoParallaxImage' );
                    }
                }
            }
        }
        $tilt_elements_attr = array(
            'image-box',
            'wavo-team-member',
            'wavo-services-item',
        );
        foreach ( $tilt_elements_attr as $w ) {
            if ( $w === $widget->get_name() && 'yes' === $widget->get_settings('wavo_tilt_effect_switcher') ) {
                $transition = 'yes' === $widget->get_settings('wavo_tilt_effect_transition') ? 'true' : 'false';
                $reset = 'yes' === $widget->get_settings('wavo_tilt_effect_reset') ? 'true' : 'false';
                $glare = 'yes' === $widget->get_settings('wavo_tilt_effect_glare') ? 'true' : 'false';
                $widget->add_render_attribute( '_wrapper', 'data-tilt', '' );
                $widget->add_render_attribute( '_wrapper', 'data-tilt-max', $widget->get_settings('wavo_tilt_effect_maxtilt') );
                $widget->add_render_attribute( '_wrapper', 'data-tilt-perspective', $widget->get_settings('wavo_tilt_effect_perspective') );
                $widget->add_render_attribute( '_wrapper', 'data-tilt-easing', $widget->get_settings('wavo_tilt_effect_easing') );
                $widget->add_render_attribute( '_wrapper', 'data-tilt-scale', $widget->get_settings('wavo_tilt_effect_scale') );
                $widget->add_render_attribute( '_wrapper', 'data-tilt-speed', $widget->get_settings('wavo_tilt_effect_speed') );
                $widget->add_render_attribute( '_wrapper', 'data-tilt-disableaxis', $widget->get_settings('wavo_tilt_effect_disableaxis') );
                $widget->add_render_attribute( '_wrapper', 'data-tilt-maxglare', $widget->get_settings('wavo_tilt_effect_maxglare') );
                $widget->add_render_attribute( '_wrapper', 'data-tilt-transition', $transition );
                $widget->add_render_attribute( '_wrapper', 'data-tilt-reset', $reset );
                $widget->add_render_attribute( '_wrapper', 'data-tilt-glare', $glare );
            }
        }
    }

}
wavo_Customizing_Default_Widgets::get_instance();
