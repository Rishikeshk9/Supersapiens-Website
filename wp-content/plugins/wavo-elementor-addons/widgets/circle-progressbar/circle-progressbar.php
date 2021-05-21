<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wavo_Circle_Progressbar extends Widget_Base {
    use Wavo_Helper;
    public function get_name() {
        return 'wavo-circle-progresbar';
    }
    public function get_title() {
        return 'Circle Progressbar (N)';
    }
    public function get_icon() {
        return 'eicon-counter';
    }
    public function get_categories() {
        return [ 'wavo' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        wp_register_script( 'jquery-circle-progress', WAVO_PLUGIN_URL. 'widgets/circle-progressbar/jquery-circle-progress.min.js', [ 'jquery' ], '1.0.0', true);
        wp_register_script( 'wavo-circle-progresbar', WAVO_PLUGIN_URL. 'widgets/circle-progressbar/script.js', [ 'elementor-frontend' ], '1.0.0', true);
    }
    public function get_script_depends() {
        return ['wow', 'jquery-circle-progress', 'wavo-circle-progresbar' ];
    }
    // Registering Controls
    protected function register_controls() {
        $this->start_controls_section('general_settings',
            [
                'label' => esc_html__( 'Odometer General', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'type',
            [
                'label' => esc_html__( 'Type', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__( 'Default', 'wavo' ),
                    'counter' => esc_html__( 'Counter', 'wavo' ),
                    'counter2' => esc_html__( 'Counter 2', 'wavo' ),
                ]
            ]
        );
        $this->add_control( 'linecap',
            [
                'label' => esc_html__( 'Line Cap', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'round',
                'options' => [
                    'round' => esc_html__( 'Round', 'wavo' ),
                    'butt' => esc_html__( 'Butt', 'wavo' ),
                    'square' => esc_html__( 'Square', 'wavo' ),
                ]
            ]
        );
        $this->add_control( 'value',
            [
                'label' => esc_html__( 'Value', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 50,
            ]
        );
        $this->add_control( 'size',
            [
                'label' => esc_html__( 'Size', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000,
                'step' => 10,
                'default' => 50,
            ]
        );
        $this->add_control( 'thickness',
            [
                'label' => esc_html__( 'Thickness', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 5,
            ]
        );
        $this->add_control( 'colortype',
            [
                'label' => esc_html__( 'Theme', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'color',
                'options' => [
                    'color' => esc_html__( 'Color', 'wavo' ),
                    'grad' => esc_html__( 'Gradient', 'wavo' ),
                ]
            ]
        );
        $this->add_control( 'color1',
            [
                'label' => esc_html__( 'Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );
        $this->add_control( 'color2',
            [
                'label' => esc_html__( 'Color 2', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => ['colortype' => 'grad']
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'number_typo',
                'label' => esc_html__( 'Number Typography', 'wavo' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .progress--number',
                'condition' => ['type!' => 'default']
            ]
        );
        $this->add_control( 'number_color',
            [
                'label' => esc_html__( 'Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => ['type!' => 'default'],
                'selectors' => [
                    '{{WRAPPER}} .progress--number:not(.stroked)' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .progress--number.stroked' => '-webkit-text-stroke-color:{{VALUE}};text-stroke-color:{{VALUE}};',
                ],
            ]
        );
        $this->add_control( 'stroked',
            [
                'label' => esc_html__( 'Use Stroke', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'condition' => ['type!' => 'default']
            ]
        );
        $this->end_controls_section();
        /*****   Style   ******/
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();
        $stroked = 'yes' == $settings['stroked'] ? ' stroked' : '';
        $color = 'grad' == $settings['colortype'] ? '{ "gradient": ["'.$settings['color1'].'", "'.$settings['color2'].'"] }' : '{"color": "'.$settings['color1'].'"}';
        echo '<div class="circle--progressbar-wrapper"><div
        id="circle--'.$id.'"
        class="circle--progressbar"
        data-type="'.$settings['type'].'"
        data-value="'. ($settings['value'] / 100) .'"
        data-size="'.$settings['size'].'"
        data-thickness="'.$settings['thickness'].'"
        data-line-cap="'.$settings['linecap'].'"
        data-start-angle="-Math.PI/2"
        data-fill=\''.$color.'\'
        data-reverse="false"
        ><strong class="progress--number'.$stroked.'"></strong></div></div>';
    }
}
