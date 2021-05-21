<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wavo_Animated_Headline extends Widget_Base {
    use Wavo_Helper;
    public function get_name() {
        return 'wavo-animated-headline';
    }
    public function get_title() {
        return 'Animated Headline (N)';
    }
    public function get_icon() {
        return 'eicon-animated-headline';
    }
    public function get_categories() {
        return [ 'wavo' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        wp_register_style( 'animated-headline', WAVO_PLUGIN_URL. 'assets/front/js/animated-headline/style.css');
        wp_register_script( 'animated-headline', WAVO_PLUGIN_URL. 'assets/front/js/animated-headline/script.js', [ 'elementor-frontend' ], '1.0.0', true);
    }
    public function get_style_depends() {
        return [ 'animated-headline' ];
    }
    public function get_script_depends() {
        return [ 'animated-headline' ];
    }
    // Registering Controls
    protected function register_controls() {
        $this->start_controls_section('wavo_animated_headline_settings',
            [
                'label' => esc_html__( 'Typed Title Settings', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'tag',
            [
                'label' => esc_html__( 'Tag', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h1' => esc_html__( 'h1', 'wavo' ),
                    'h2' => esc_html__( 'h2', 'wavo' ),
                    'h3' => esc_html__( 'h3', 'wavo' ),
                    'h4' => esc_html__( 'h4', 'wavo' ),
                    'h5' => esc_html__( 'h5', 'wavo' ),
                    'h6' => esc_html__( 'h6', 'wavo' ),
                    'div' => esc_html__( 'div', 'wavo' ),
                    'p' => esc_html__( 'p', 'wavo' )
                ]
            ]
        );
        $this->add_control( 'type',
            [
                'label' => esc_html__( 'Type', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'rotate-1',
                'options' => [
                    'rotate-1' => esc_html__( 'rotate-1', 'wavo' ),
                    'letters type' => esc_html__( 'letters type', 'wavo' ),
                    'letters rotate-2' => esc_html__( 'letters rotate-2', 'wavo' ),
                    'loading-bar' => esc_html__( 'loading-bar', 'wavo' ),
                    'slide' => esc_html__( 'slide', 'wavo' ),
                    'clip is-full-width' => esc_html__( 'clip is-full-width', 'wavo' ),
                    'zoom' => esc_html__( 'zoom', 'wavo' ),
                    'letters rotate-3' => esc_html__( 'letters rotate-3', 'wavo' ),
                    'letters scale' => esc_html__( 'letters scale', 'wavo' ),
                    'push' => esc_html__( 'push', 'wavo' ),
                ]
            ]
        );
        $this->add_control( 'animated_headline_before',
            [
                'label' => esc_html__( 'Text Before', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'We are',
                'label_block' => true,
            ]
        );
        $this->add_control( 'animated_headline_after',
            [
                'label' => esc_html__( 'Text After', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'animated_headline_text',
            [
                'label' => esc_html__( 'Text', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Best',
                'label_block' => true,
            ]
        );
        $repeater->add_control( 'animated_headline_custom_color',
            [
                'label' => esc_html__( 'Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );
        $this->add_control( 'texts',
            [
                'label' => esc_html__( 'Items', 'wavo' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{animated_headline_text}}',
                'default' => [
                    [
                        'animated_headline_text' => 'Best',
                    ],
                    [
                        'animated_headline_text' => 'Awesome',
                    ],
                    [
                        'animated_headline_text' => 'Important',
                    ]
                ]
            ]
        );
        $this->end_controls_section();
        /*****   Style   ******/
        $this->start_controls_section( 'animated_headline_style_section',
            [
                'label' => esc_html__( 'Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'typed_cursor_general_heading',
            [
                'label' => esc_html__( 'General', 'wavo' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->wavo_style_color( 'animated_headline_color', '{{WRAPPER}} .animated_headline_wrapper,{{WRAPPER}} .animated_headline_wrapper b, {{WRAPPER}} .animated_headline_wrapper .typed-cursor,{{WRAPPER}} .animated_headline_wrapper .typed_before,{{WRAPPER}} .animated_headline_wrapper .typed_after' );
        $this->wavo_style_typo( 'animated_headline_typo', '{{WRAPPER}} .animated_headline_wrapper,{{WRAPPER}} .animated_headline_wrapper b,{{WRAPPER}} .animated_headline_wrapper .typed-cursor,{{WRAPPER}} .animated_headline_wrapper .typed_before,{{WRAPPER}} .animated_headline_wrapper .typed_after' );
        $this->wavo_style_flex_alignment( 'animated_headline_alignment', '{{WRAPPER}} .animated_headline_wrapper .headline' );
        $this->wavo_style_padding( 'animated_headline_padding', '{{WRAPPER}} .animated_headline_wrapper' );
        $this->wavo_style_margin( 'animated_headline_margin', '{{WRAPPER}} .animated_headline_wrapper' );
        $this->wavo_style_border( 'animated_headline_border','{{WRAPPER}} .animated_headline_wrapper' );

        $this->add_control( 'typed_cursor_typed_heading',
            [
                'label' => esc_html__( 'Animated Text', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->wavo_style_typo( 'animated_headline_typed_typo','{{WRAPPER}} .animated_headline_wrapper b' );
        $this->wavo_style_text_shadow( 'animated_headline_shadow','{{WRAPPER}} .animated_headline_wrapper b' );

        $this->add_control( 'typed_cursor_heading',
            [
                'label' => esc_html__( 'Cursor', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->wavo_style_color( 'animated_headline_cursor', ['{{WRAPPER}} .typed_wrapper .typed-cursor' => 'color: {{VALUE}}','{{WRAPPER}} .headline.loading-bar .words-wrapper::after' => 'background: {{VALUE}};','{{WRAPPER}} .headline.clip .words-wrapper::after' => 'background: {{VALUE}};'] );
        $this->wavo_style_slider_size( 'animated_headline_cursor_size', ['{{WRAPPER}} .typed_wrapper .typed-cursor' => 'font-size:{{SIZE}}px'] );

        $this->add_control( 'animated_headline_before_heading',
            [
                'label' => esc_html__( 'Before Color', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->wavo_style_color( 'animated_headline_before_color', '{{WRAPPER}} .typed_wrapper .typed_before' );

        $this->add_control( 'animated_headline_after_heading',
            [
                'label' => esc_html__( 'After Color', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->wavo_style_color( 'animated_headline_after_color', '{{WRAPPER}} .typed_wrapper .typed_after' );

        $this->end_controls_section();
        /*****   Style   ******/
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        echo '<div class="animated_headline_wrapper">';
            echo '<'.$settings['tag'].' class="headline '.$settings['type'].'">';
            	echo $settings['animated_headline_before'] ? '<span class="typed_before">'.$settings['animated_headline_before'].'</span>&nbsp;' : '';
            	echo '<span class="words-wrapper">';
            	    $count = 0;
                    foreach ($settings['texts'] as $item) {
                        $style = $item['animated_headline_custom_color'] ? ' style="color:'.$item['animated_headline_custom_color'].'"' : '';
                        $visible = 0 == $count ? ' class="is-visible"' : '';
                        echo '<b'.$visible.$style.'>'.$item['animated_headline_text'].'</b>';
                        $count++;
                    }
            	echo '</span> ';
                echo $settings['animated_headline_after'] ? '&nbsp;<span class="typed_after">'.$settings['animated_headline_after'].'</span>' : '';
            echo '</'.$settings['tag'].'>';
        echo '</div>';
    }
}
