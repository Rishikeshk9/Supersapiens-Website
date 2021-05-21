<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wavo_Testimonials_Two extends Widget_Base {
    use Wavo_Helper;
    public function get_name() {
        return 'wavo-testimonials-two';
    }
    public function get_title() {
        return 'Testimonials 2 Carousel (N)';
    }
    public function get_icon() {
        return 'eicon-testimonial';
    }
    public function get_categories() {
        return [ 'wavo' ];
    }
    public function get_style_depends() {
        return [ 'slick','slick-theme' ];
    }
    public function get_script_depends() {
        return [ 'slick' ];
    }
    // Registering Controls
    protected function register_controls() {

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'wavo_testimonials2_settings',
            [
                'label' => esc_html__('Testimonials Items', 'wavo'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'type',
            [
                'label' => esc_html__( 'Type', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => 'true',
                'default' => '1',
                'options' => [
                    '1' => esc_html__( 'Type 1', 'wavo' ),
                    '2' => esc_html__( 'Type 2', 'wavo' ),
                    '3' => esc_html__( 'Type 3', 'wavo' ),
                    '4' => esc_html__( 'Type 4', 'wavo' ),
                    '5' => esc_html__( 'Type 5', 'wavo' ),
                    '6' => esc_html__( 'Type 6', 'wavo' )
                ],
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'name',
            [
                'label' => esc_html__( 'Name', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Sam Peters',
                'label_block' => true,
            ]
        );
        $repeater->add_control( 'info',
            [
                'label' => esc_html__( 'Position / Info', 'wavo' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'CEO Solar Systems LLC',
                'label_block' => true,
            ]
        );
        $repeater->add_control( 'text',
            [
                'label' => esc_html__( 'Quote', 'wavo' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'label_block' => true,
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
            'name' => 'thumbnail',
            'separator' => 'none',
            ]
        );
        $def_img = plugins_url( 'assets/front/img/author.jpg', __DIR__ );
        $repeater->add_control( 'avatar',
            [
                'label' => esc_html__( 'Avatar', 'wavo' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => $def_img],
            ]
        );
        $this->add_control( 'testimonials',
            [
                'label' => esc_html__( 'Items', 'wavo' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{name}}',
                'default' => [
                    [
                        'name' => 'Alex Martin',
                        'position' => 'Envato Customer',
                        'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel purus fringilla, lobortis libero ut, interdum lacus. Ut quis urna sollicitudin, iaculis dolor sed, sodales mi. Proin a velit convallis, fermentum orci in, rutrum diam. Duis elementum odio a pharetra commodo. Sed eget massa sit amet nunc egestas tristique.'
                    ],
                    [
                        'name' => 'Terry Figueroa',
                        'position' => 'Marketing Manager',
                        'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel purus fringilla, lobortis libero ut, interdum lacus. Ut quis urna sollicitudin, iaculis dolor sed, sodales mi. Proin a velit convallis, fermentum orci in, rutrum diam. Duis elementum odio a pharetra commodo. Sed eget massa sit amet nunc egestas tristique.'
                    ],
                    [
                        'name' => 'Kaycee Hess',
                        'position' => 'Human Resources',
                        'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel purus fringilla, lobortis libero ut, interdum lacus. Ut quis urna sollicitudin, iaculis dolor sed, sodales mi. Proin a velit convallis, fermentum orci in, rutrum diam. Duis elementum odio a pharetra commodo. Sed eget massa sit amet nunc egestas tristique.'
                    ]
                ]
            ]
        );
        $this->add_control( 'name_tag',
            [
                'label' => esc_html__( 'Name Tag', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => 'true',
                'default' => 'h6',
                'options' => [
                    'h1' => esc_html__( 'h1', 'wavo' ),
                    'h2' => esc_html__( 'h2', 'wavo' ),
                    'h3' => esc_html__( 'h3', 'wavo' ),
                    'h4' => esc_html__( 'h4', 'wavo' ),
                    'h5' => esc_html__( 'h5', 'wavo' ),
                    'h6' => esc_html__( 'h6', 'wavo' ),
                    'p' => esc_html__( 'p', 'wavo' ),
                    'span' => esc_html__( 'span', 'wavo' ),
                    'div' => esc_html__( 'div', 'wavo' ),
                ],
                'separator' => 'before',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        ['name' => 'type','operator' => '==','value' => '1'],
                        ['name' => 'type','operator' => '==','value' => '2'],
                    ]
                ]
            ]
        );
        $this->add_control( 'text_tag',
            [
                'label' => esc_html__( 'Quote Text Tag', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => 'true',
                'default' => 'p',
                'options' => [
                    'h1' => esc_html__( 'h1', 'wavo' ),
                    'h2' => esc_html__( 'h2', 'wavo' ),
                    'h3' => esc_html__( 'h3', 'wavo' ),
                    'h4' => esc_html__( 'h4', 'wavo' ),
                    'h5' => esc_html__( 'h5', 'wavo' ),
                    'h6' => esc_html__( 'h6', 'wavo' ),
                    'p' => esc_html__( 'p', 'wavo' ),
                    'span' => esc_html__( 'span', 'wavo' ),
                    'div' => esc_html__( 'div', 'wavo' ),
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        ['name' => 'type','operator' => '==','value' => '1'],
                        ['name' => 'type','operator' => '==','value' => '2'],
                    ]
                ]
            ]
        );
        $this->add_responsive_control( 'alignment',
            [
                'label' => esc_html__( 'Alignment', 'wavo' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => [
                    '{{WRAPPER}} .testi-2 .slick-slide.testi-item' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .testi-1 .slick-slide.testi-item' => 'text-align: {{VALUE}};'
                ],
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
                'default' => '',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        ['name' => 'type','operator' => '==','value' => '1'],
                        ['name' => 'type','operator' => '==','value' => '2'],
                    ]
                ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'wavo_testimonials2_general_settings',
            [
                'label' => esc_html__('Slider Options', 'wavo'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'speed',
            [
                'label' => esc_html__( 'Speed', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 10,
                'max' => 10000,
                'step' => 100,
                'default' => 300,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'show',
            [
                'label' => esc_html__( 'Show Items', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 1,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'mdshow',
            [
                'label' => esc_html__( 'Show Items (Tablet)', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 1,
            ]
        );
        $this->add_control( 'smshow',
            [
                'label' => esc_html__( 'Show Items (Phone)', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 1,
            ]
        );
        $this->add_control( 'showscroll',
            [
                'label' => esc_html__( 'Show Scroll Items', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 1,
            ]
        );
        $this->add_control( 'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'arrows',
            [
                'label' => esc_html__( 'Arrows', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'mdarrows',
            [
                'label' => esc_html__( 'Arrows (Tablet)', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_control( 'smarrows',
            [
                'label' => esc_html__( 'Arrows (Phone)', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_control( 'dots',
            [
                'label' => esc_html__( 'Dots', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'mddots',
            [
                'label' => esc_html__( 'Dots (Tablet)', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_control( 'smdots',
            [
                'label' => esc_html__( 'Dots (Phone)', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('testi_item_box_style_section',
            [
                'label'=> esc_html__( 'Item Box Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        ['name' => 'type','operator' => '==','value' => '1'],
                        ['name' => 'type','operator' => '==','value' => '2'],
                    ]
                ]
            ]
        );

        $this->wavo_style_background( 'box_background','{{WRAPPER}} .testi-item' );
        $this->wavo_style_padding( 'box_padding','{{WRAPPER}} .testi-item' );
        $this->wavo_style_margin( 'box_margin','{{WRAPPER}} .testi-item' );
        $this->wavo_style_border( 'box_border','{{WRAPPER}} .testi-item' );
        $this->wavo_style_box_shadow( 'box_bxshadow','{{WRAPPER}} .testi-item' );
        $this->add_responsive_control( 'box_min_height',
            [
                'label' => esc_html__( 'Minumum Height', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testi-item' => 'min-height: {{SIZE}}px;' ],
            ]
        );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('testi_quote_style_section',
            [
                'label'=> esc_html__( 'Quote Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        ['name' => 'type','operator' => '==','value' => '1'],
                        ['name' => 'type','operator' => '==','value' => '2'],
                    ]
                ]
            ]
        );

        $this->wavo_style_typo( 'quote_typo','{{WRAPPER}} .testi-quote' );
        $this->wavo_style_color( 'quote_color','{{WRAPPER}} .testi-quote' );
        $this->wavo_style_background( 'quote_background','{{WRAPPER}} .testi-quote' );
        $this->wavo_style_padding( 'quote_padding','{{WRAPPER}} .testi-quote' );
        $this->wavo_style_margin( 'quote_margin','{{WRAPPER}} .testi-quote' );
        $this->wavo_style_border( 'quote_border','{{WRAPPER}} .testi-quote' );
        $this->add_control( 'quote_position',
            [
                'label' => esc_html__( 'Position', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'selectors' => ['{{WRAPPER}} .testimonials2 .testi-quote' => 'position: {{VALUE}};'],
                'options' => [
                    '' => esc_html__( 'Default', 'wavo' ),
                    'absolute' => esc_html__( 'Absolute', 'wavo' ),
                ],
                'default' => '',
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'quote_custom_width',
            [
                'label' => esc_html__( 'Custom Width', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 2000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .testi-quote' => 'width: {{SIZE}}{{UNIT}};' ],
                'condition' => ['quote_position' => 'absolute']
            ]
        );
        $this->add_responsive_control( 'quote_top',
            [
                'label' => esc_html__( 'Top Offset', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 1000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .testi-quote' => 'top: {{SIZE}}{{UNIT}};' ],
                'condition' => ['quote_position' => 'absolute']
            ]
        );
        $this->add_responsive_control( 'quote_bottom',
            [
                'label' => esc_html__( 'Bottom Offset', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 1000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .testi-quote' => 'bottom: {{SIZE}}{{UNIT}};' ],
                'condition' => ['quote_position' => 'absolute']
            ]
        );
        $this->add_responsive_control( 'quote_left',
            [
                'label' => esc_html__( 'Left Offset', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 1000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .testi-quote' => 'left: {{SIZE}}{{UNIT}};' ],
                'condition' => ['quote_position' => 'absolute']
            ]
        );
        $this->add_responsive_control( 'quote_right',
            [
                'label' => esc_html__( 'Right Offset', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 1000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .testi-quote' => 'right: {{SIZE}}{{UNIT}};' ],
                'condition' => ['quote_position' => 'absolute']
            ]
        );
        $this->add_control( 'quote_icon_heading',
            [
                'label' => esc_html__( 'QUOTE ICON', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['type' => '2']
            ]
        );
        $this->add_control( 'quote_icon_color',
            [
                'label' => esc_html__( 'Quote Icon Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .testi-2 .testi-quote::before' => 'color: {{VALUE}};opacity:1;'],
                'condition' => ['type' => '2']
            ]
        );
        $this->add_responsive_control( 'quote_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testi-2 .testi-quote::before' => 'font-size: {{SIZE}}px;' ],
                'condition' => ['type' => '2']
            ]
        );
        $this->add_responsive_control( 'quote_icon_top',
            [
                'label' => esc_html__( 'Icon Top Offset', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 1000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testi-2 .testi-quote::before' => 'top: {{SIZE}}{{UNIT}};' ],
                'condition' => ['type' => '2']
            ]
        );
        $this->add_responsive_control( 'quote_icon_left',
            [
                'label' => esc_html__( 'Icon Left Offset', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 1000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testi-2 .testi-quote::before' => 'left: {{SIZE}}{{UNIT}};' ],
                'condition' => ['type' => '2']
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('testi_image_style_section',
            [
                'label'=> esc_html__( 'Avatar Image Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        ['name' => 'type','operator' => '==','value' => '1'],
                        ['name' => 'type','operator' => '==','value' => '2'],
                    ]
                ]
            ]
        );

        $this->wavo_style_padding( 'avatar_padding','{{WRAPPER}} .testi-avatar' );
        $this->wavo_style_margin( 'avatar_margin','{{WRAPPER}} .testi-avatar' );
        $this->wavo_style_border( 'avatar_border','{{WRAPPER}} .testi-avatar' );
        $this->wavo_style_box_shadow( 'avatar_box_shadow','{{WRAPPER}} .testi-avatar' );
        $this->add_control( 'avatar_position',
            [
                'label' => esc_html__( 'Position', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'selectors' => ['{{WRAPPER}} .testimonials2 .testi-avatar' => 'position: {{VALUE}};'],
                'options' => [
                    '' => esc_html__( 'Default', 'wavo' ),
                    'absolute' => esc_html__( 'Absolute', 'wavo' ),
                ],
                'default' => '',
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'avatar_top',
            [
                'label' => esc_html__( 'Top Offset', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 1000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .testi-avatar' => 'top: {{SIZE}}{{UNIT}};' ],
                'condition' => ['avatar_position' => 'absolute']
            ]
        );
        $this->add_responsive_control( 'avatar_bottom',
            [
                'label' => esc_html__( 'Bottom Offset', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 1000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .testi-avatar' => 'bottom: {{SIZE}}{{UNIT}};' ],
                'condition' => ['avatar_position' => 'absolute']
            ]
        );
        $this->add_responsive_control( 'avatar_left',
            [
                'label' => esc_html__( 'Left Offset', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 1000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .testi-avatar' => 'left: {{SIZE}}{{UNIT}};' ],
                'condition' => ['avatar_position' => 'absolute']
            ]
        );
        $this->add_responsive_control( 'avatar_right',
            [
                'label' => esc_html__( 'Right Offset', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 1000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .testi-avatar' => 'right: {{SIZE}}{{UNIT}};' ],
                'condition' => ['avatar_position' => 'absolute']
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('testi_footer_style_section',
            [
                'label'=> esc_html__( 'Footer Content Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['type' => '2']
            ]
        );
        $this->wavo_style_background( 'footer_background','{{WRAPPER}} .testi-2 .testi-footer' );
        $this->wavo_style_padding( 'footer_padding','{{WRAPPER}} .testi-2 .testi-footer' );
        $this->wavo_style_margin( 'footer_margin','{{WRAPPER}} .testi-2 .testi-footer' );
        $this->wavo_style_border( 'footer_border','{{WRAPPER}} .testi-2 .testi-footer' );
        $this->wavo_style_box_shadow( 'footer_box_shadow','{{WRAPPER}} .testi-2 .testi-footer' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('testi_author_style_section',
            [
                'label'=> esc_html__( 'Author Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        ['name' => 'type','operator' => '==','value' => '1'],
                        ['name' => 'type','operator' => '==','value' => '2'],
                    ]
                ]
            ]
        );

        $this->wavo_style_typo( 'author_typo','{{WRAPPER}} .testi-author' );
        $this->wavo_style_color( 'author_color','{{WRAPPER}} .testi-author' );
        $this->wavo_style_padding( 'author_padding','{{WRAPPER}} .testi-author' );
        $this->wavo_style_margin( 'author_margin','{{WRAPPER}} .testi-author' );
        $this->wavo_style_border( 'author_border','{{WRAPPER}} .testi-author' );
        $this->add_control( 'author_position',
            [
                'label' => esc_html__( 'Position', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'selectors' => ['{{WRAPPER}} .testimonials2 .testi-author' => 'position: {{VALUE}};'],
                'options' => [
                    '' => esc_html__( 'Default', 'wavo' ),
                    'absolute' => esc_html__( 'Absolute', 'wavo' ),
                ],
                'default' => '',
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'author_custom_width',
            [
                'label' => esc_html__( 'Custom Width', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 2000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .testi-author' => 'width: {{SIZE}}{{UNIT}};' ],
                'condition' => ['author_position' => 'absolute']
            ]
        );
        $this->add_responsive_control( 'author_top',
            [
                'label' => esc_html__( 'Top Offset', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 1000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .testi-author' => 'top: {{SIZE}}{{UNIT}};' ],
                'condition' => ['author_position' => 'absolute']
            ]
        );
        $this->add_responsive_control( 'author_bottom',
            [
                'label' => esc_html__( 'Bottom Offset', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 1000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .testi-author' => 'bottom: {{SIZE}}{{UNIT}};' ],
                'condition' => ['author_position' => 'absolute']
            ]
        );
        $this->add_responsive_control( 'author_left',
            [
                'label' => esc_html__( 'Left Offset', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 1000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .testi-author' => 'left: {{SIZE}}{{UNIT}};' ],
                'condition' => ['author_position' => 'absolute']
            ]
        );
        $this->add_responsive_control( 'author_right',
            [
                'label' => esc_html__( 'Right Offset', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 1000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .testi-author' => 'right: {{SIZE}}{{UNIT}};' ],
                'condition' => ['author_position' => 'absolute']
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('testi_info_style_section',
            [
                'label'=> esc_html__( 'Position / Info Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        ['name' => 'type','operator' => '==','value' => '1'],
                        ['name' => 'type','operator' => '==','value' => '2'],
                    ]
                ]
            ]
        );

        $this->wavo_style_typo( 'info_typo','{{WRAPPER}} .testi-info' );
        $this->wavo_style_color( 'info_color','{{WRAPPER}} .testi-info' );
        $this->wavo_style_padding( 'info_padding','{{WRAPPER}} .testi-info' );
        $this->wavo_style_margin( 'info_margin','{{WRAPPER}} .testi-info' );
        $this->wavo_style_border( 'info_border','{{WRAPPER}} .testi-info' );
        $this->add_control( 'info_position',
            [
                'label' => esc_html__( 'Position', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'selectors' => ['{{WRAPPER}} .testimonials2 .testi-info' => 'position: {{VALUE}};'],
                'options' => [
                    '' => esc_html__( 'Default', 'wavo' ),
                    'absolute' => esc_html__( 'Absolute', 'wavo' ),
                ],
                'default' => '',
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'info_custom_width',
            [
                'label' => esc_html__( 'Custom Width', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => 0,
                        'max' => 2000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .testi-info' => 'width: {{SIZE}}{{UNIT}};' ],
                'condition' => ['info_position' => 'absolute']
            ]
        );
        $this->add_responsive_control( 'info_top',
            [
                'label' => esc_html__( 'Top Offset', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 1000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .testi-info' => 'top: {{SIZE}}{{UNIT}};' ],
                'condition' => ['info_position' => 'absolute']
            ]
        );
        $this->add_responsive_control( 'info_bottom',
            [
                'label' => esc_html__( 'Bottom Offset', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 1000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .testi-info' => 'bottom: {{SIZE}}{{UNIT}};' ],
                'condition' => ['info_position' => 'absolute']
            ]
        );
        $this->add_responsive_control( 'info_left',
            [
                'label' => esc_html__( 'Left Offset', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 1000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .info-author' => 'left: {{SIZE}}{{UNIT}};' ],
                'condition' => ['quote_position' => 'absolute']
            ]
        );
        $this->add_responsive_control( 'info_right',
            [
                'label' => esc_html__( 'Right Offset', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 1000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .info-author' => 'right: {{SIZE}}{{UNIT}};' ],
                'condition' => ['quote_position' => 'absolute']
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('testi_dots_style_section',
            [
                'label'=> esc_html__( 'Dots Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['dots' => 'yes']
            ]
        );
        $this->add_responsive_control( 'dots_bottom_position',
            [
                'label' => esc_html__( 'Bottom Offset', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -400,
                        'max' => 400
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .slick-dots' => 'bottom: {{SIZE}}px;'],
            ]
        );
        $this->wavo_style_padding( 'dots_padding','{{WRAPPER}} .slick-dots li button' );
        $this->wavo_style_border( 'dots_border','{{WRAPPER}} .slick-dots li button' );
        $this->add_control( 'dots_spacing',
            [
                'label' => esc_html__( 'Spacing', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button' => 'margin-right: {{SIZE}}px;',
                    '{{WRAPPER}} .slick-dots li button' => 'margin-left: {{SIZE}}px;'
                ],
            ]
        );
        $this->add_responsive_control( 'dots_width',
            [
                'label' => esc_html__( 'Width', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 60
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .slick-dots li button' => 'width: {{SIZE}}px;'],
            ]
        );
        $this->add_responsive_control( 'dots_height',
            [
                'label' => esc_html__( 'Height', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 60
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .slick-dots li button' => 'height: {{SIZE}}px;'],
            ]
        );
        $this->add_control( 'dots_color',
            [
                'label' => esc_html__( 'Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .slick-dots li button' => 'background-color: {{VALUE}};']
            ]
        );
        $this->add_control( 'dots_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .slick-dots li.slick-active button, {{WRAPPER}} .slick-dots li:not(.slick-active):hover button' => 'background-color: {{VALUE}};']
            ]
        );
        $this->add_control( 'dots_hvrbrdcolor',
            [
                'label' => esc_html__( 'Hover Border Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .slick-dots li.slick-active button, {{WRAPPER}} .slick-dots li:not(.slick-active):hover button' => 'border-color: {{VALUE}};']
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('testi_arrows_style_section',
            [
                'label'=> esc_html__( 'Arrows Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['arrows' => 'yes']
            ]
        );
        $this->add_responsive_control( 'arrows_navs_position',
            [
                'label' => esc_html__( 'Arrows Content Vertical Position', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => -2000,
                        'max' => 2000
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonials2 .navs' => 'position:absolute;top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control( 'arrows_heading',
            [
                'label' => esc_html__( 'ARROWS', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control( 'arrows_width',
            [
                'label' => esc_html__( 'Width', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .slick-arrow' => 'width: {{SIZE}}px;'],
            ]
        );
        $this->add_responsive_control( 'arrows_height',
            [
                'label' => esc_html__( 'Height', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .slick-arrow' => 'height: {{SIZE}}px;'],
            ]
        );
        $this->start_controls_tabs('arrows_tabs');
        $this->start_controls_tab( 'arrows_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'wavo' ) ]
        );
        $this->wavo_style_border( 'arrows_border','{{WRAPPER}} .testimonials2 .slick-arrow' );
        $this->add_control( 'arrows_color',
            [
                'label' => esc_html__( 'Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .testimonials2 .slick-arrow' => 'color: {{VALUE}};']
            ]
        );
        $this->add_control( 'arrows_bgcolor',
            [
                'label' => esc_html__( 'Background', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .testimonials2 .slick-arrow' => 'background-color: {{VALUE}};']
            ]
        );
        $this->add_responsive_control( 'arrows_size',
            [
                'label' => esc_html__( 'Icon Size', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .slick-arrow' => 'font-size: {{SIZE}}px;'],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab('arrows_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wavo' ) ]
        );
        $this->wavo_style_border( 'arrows_hvrborder','{{WRAPPER}} .testimonials2 .slick-arrow:hover' );
        $this->add_control( 'arrows_hvrcolor',
            [
                'label' => esc_html__( 'Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .testimonials2 .slick-arrow:hover' => 'color: {{VALUE}};']
            ]
        );
        $this->add_control( 'arrows_hvrbgcolor',
            [
                'label' => esc_html__( 'Background', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .testimonials2 .slick-arrow:hover' => 'background-color: {{VALUE}};']
            ]
        );
        $this->add_responsive_control( 'arrows_hvrsize',
            [
                'label' => esc_html__( 'Icon Size', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .slick-arrow:hover' => 'font-size: {{SIZE}}px;'],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control( 'arrows_prev_heading',
            [
                'label' => esc_html__( 'PREV POSITION', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control( 'arrows_prev_top_position',
            [
                'label' => esc_html__( 'Top Offset', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => -300,
                        'max' => 2000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .prev.slick-arrow' => 'top: {{SIZE}}{{UNIT}};position:absolute;'],
            ]
        );
        $this->add_responsive_control( 'arrows_prev_bottom_position',
            [
                'label' => esc_html__( 'Bottom Offset', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => -300,
                        'max' => 2000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .prev.slick-arrow' => 'bottom: {{SIZE}}{{UNIT}};position:absolute;'],
            ]
        );
        $this->add_responsive_control( 'arrows_prev_left_position',
            [
                'label' => esc_html__( 'Left Offset', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => -300,
                        'max' => 2000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .prev.slick-arrow' => 'left: {{SIZE}}{{UNIT}};position:absolute;'],
            ]
        );
        $this->add_responsive_control( 'arrows_prev_right_position',
            [
                'label' => esc_html__( 'Right Offset', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => -300,
                        'max' => 2000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .prev.slick-arrow' => 'right: {{SIZE}}{{UNIT}};position:absolute;'],
            ]
        );
        $this->add_control( 'arrows_next_heading',
            [
                'label' => esc_html__( 'NEXT POSITION', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control( 'arrows_next_top_position',
            [
                'label' => esc_html__( 'Top Offset', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => -300,
                        'max' => 2000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .next.slick-arrow' => 'top: {{SIZE}}{{UNIT}};position:absolute;'],
            ]
        );
        $this->add_responsive_control( 'arrows_next_bottom_position',
            [
                'label' => esc_html__( 'Bottom Offset', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => -300,
                        'max' => 2000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .next.slick-arrow' => 'bottom: {{SIZE}}{{UNIT}};position:absolute;'],
            ]
        );
        $this->add_responsive_control( 'arrows_next_left_position',
            [
                'label' => esc_html__( 'Left Offset', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => -300,
                        'max' => 2000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .next.slick-arrow' => 'left: {{SIZE}}{{UNIT}};position:absolute;'],
            ]
        );
        $this->add_responsive_control( 'arrows_next_right_position',
            [
                'label' => esc_html__( 'Right Offset', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100
                    ],
                    'px' => [
                        'min' => -300,
                        'max' => 2000
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .testimonials2 .next.slick-arrow' => 'right: {{SIZE}}{{UNIT}};position:absolute;'],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'fast_style_section',
            [
                'label'=> esc_html__( 'Fast Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        ['name' => 'type','operator' => '!=','value' => '1'],
                        ['name' => 'type','operator' => '!=','value' => '2'],
                    ]
                ]
            ]
        );
        $this->add_control( 'general_box_item',
            [
                'label' => esc_html__( 'GENERAL', 'wavo' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->wavo_style_padding( 'item_box_padding','{{WRAPPER}} .testi--new' );
        $this->wavo_style_margin( 'item_box_margin','{{WRAPPER}} .testi--new' );
        $this->wavo_style_border( 'item_box_border','{{WRAPPER}} .testi--new' );
        $this->wavo_style_box_shadow( 'item_box_bxshadow','{{WRAPPER}} .testi--new' );
        $this->add_responsive_control( 'item_quote_alignment',
            [
                'label' => esc_html__( 'Alignment', 'wavo' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => [
                    '{{WRAPPER}} .testi--new,{{WRAPPER}} .testi--new blockquote.testi-quote' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .testi--new.testi-type4 .author' => 'text-align: {{VALUE}};',
                ],
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
                'default' => '',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        ['name' => 'type','operator' => '==','value' => '3'],
                        ['name' => 'type','operator' => '==','value' => '4'],
                    ]
                ]
            ]
        );
        $this->add_control( 'item_quote_heading',
            [
                'label' => esc_html__( 'QUOTE', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'item_quote_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .testi--new blockquote.testi-quote' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .testi--new blockquote.testi-quote .arrow' => 'border-top-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'item_quote_color',
            [
                'label' => esc_html__( 'Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .testi--new blockquote.testi-quote' => 'color: {{VALUE}};']
            ]
        );
        $this->wavo_style_typo( 'item_quot_typo','{{WRAPPER}} .testi--new blockquote.testi-quote' );
        $this->add_control( 'item_quote_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .testi--new blockquote:before,{{WRAPPER}} .testi--new blockquote:after' => 'color: {{VALUE}};']
            ]
        );
        $this->add_control( 'item_name_heading',
            [
                'label' => esc_html__( 'NAME and INFO', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'item_name_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .testi--new .author' => 'background-color: {{VALUE}};border-top-color: {{VALUE}};',
                ],
                'condition' => ['name' => 'type','operator' => '=','value' => '3']
            ]
        );
        $this->add_control( 'item_name_color',
            [
                'label' => esc_html__( 'Name Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .testi--new .author .testi-author' => 'color: {{VALUE}};']
            ]
        );
        $this->wavo_style_typo( 'item_name_typo','{{WRAPPER}} .testi--new .author .testi-author' );
        $this->add_control( 'item_info_color',
            [
                'label' => esc_html__( 'Info Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .testi--new .author .testi-author .testi-info' => 'color: {{VALUE}};']
            ]
        );
        $this->wavo_style_typo( 'item_info_typo','{{WRAPPER}} .testi--new .author .testi-author .testi-info' );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();
        $autoplay = 'yes' == $settings['autoplay'] ? 'true' : 'false';
        $arrows = 'yes' == $settings['arrows'] ? 'true' : 'false';
        $mdarrows = 'yes' == $settings['mdarrows'] ? 'true' : 'false';
        $smarrows = 'yes' == $settings['smarrows'] ? 'true' : 'false';
        $dots = 'yes' == $settings['dots'] ? 'true' : 'false';
        $mddots = 'yes' == $settings['mddots'] ? 'true' : 'false';
        $smdots = 'yes' == $settings['smdots'] ? 'true' : 'false';

        echo '<div class="testimonials2 testimonials2-'.$id.' testi-'.$settings['type'].'" data-slider-settings=\'{"show": '.$settings['show'].',"mdshow": '.$settings['mdshow'].',"smshow": '.$settings['smshow'].',"showscroll": '.$settings['showscroll'].',"arrows": '.$arrows.',"mdarrows": '.$mdarrows.',"smarrows": '.$mdarrows.',"dots": '.$dots.',"mddots": '.$mddots.',"smdots": '.$smdots.',"autoplay": '.$autoplay.',"speed": '.$settings['speed'].'}\'>';

            echo '<div class="testimonials-slider">';

                foreach ($settings['testimonials'] as $item) {
                    $timagealt = esc_attr(get_post_meta($item['avatar']['id'], '_wp_attachment_image_alt', true));
                    $timagealt = $timagealt ? $timagealt : basename ( get_attached_file( $item['avatar']['id'] ) );
                    $image = Group_Control_Image_Size::get_attachment_image_src( $item['avatar']['id'], 'thumbnail', $settings );
                    $avatar_none = '' == $item['avatar']['url'] ? ' avatar-none' : '';
                    echo '<div class="testi-item'.$avatar_none.'">';
                        if ('1' == $settings['type']) {
                            if ($item['text']) {

                                echo '<'.$settings['text_tag'].' class="testi-quote">'.$item['text'].'</'.$settings['text_tag'].'>';
                            }
                            echo '<div class="testi-footer">';
                                if ($item['avatar']['url']) {
                                    echo '<img class="testi-avatar" src="'.$image.'" alt="'.$timagealt.'">';
                                }
                                if ( $item['name'] ) {
                                    echo '<'.$settings['name_tag'].' class="testi-author">'.$item['name'].'</'.$settings['name_tag'].'>';
                                }
                                if ( $item['info'] ) {
                                    echo '<span class="testi-info">'.$item['info'].'</span>';
                                }
                            echo '</div>';
                        }
                        if ('2' == $settings['type']) {
                            if ($item['avatar']['url']) {
                                echo '<img class="testi-avatar" src="'.$image.'" alt="'.$timagealt.'">';
                            }
                            if ($item['text']) {
                                echo '<'.$settings['text_tag'].' class="testi-quote">'.$item['text'].'</'.$settings['text_tag'].'>';
                            }
                            echo '<div class="testi-footer">';
                                if ( $item['name'] ) {
                                    echo '<'.$settings['name_tag'].' class="testi-author">'.$item['name'].'</'.$settings['name_tag'].'>';
                                }
                                if ( $item['info'] ) {
                                    echo '<span class="testi-info">'.$item['info'].'</span>';
                                }
                            echo '</div>';
                        }
                        if ('3' == $settings['type']) {
                            echo '<div class="testi-type3 testi--new">';
                                if ($item['text']) {
                                    echo '<blockquote class="testi-quote">'.$item['text'].'<div class="arrow"></div></blockquote>';
                                }
                                if ($item['avatar']['url']) {
                                    echo '<img class="testi-avatar" src="'.$image.'" alt="'.$timagealt.'">';
                                }
                                if ( $item['name'] ) {
                                    echo '<div class="author">';
                                        echo '<div class="testi-author">'.$item['name'].' <span class="testi-info">'.$item['info'].'</span></div>';
                                    echo '</div>';
                                }
                            echo '</div>';
                        }
                        if ('4' == $settings['type']) {
                            echo '<div class="testi-type4 testi--new">';
                                if ($item['text']) {
                                    echo '<blockquote class="testi-quote">'.$item['text'].'</blockquote>';
                                }
                                echo '<div class="author">';
                                    if ($item['avatar']['url']) {
                                        echo '<img class="testi-avatar" src="'.$image.'" alt="'.$timagealt.'">';
                                    }
                                    if ( $item['name'] ) {
                                        echo '<div class="testi-author">'.$item['name'].' <span class="testi-info">'.$item['info'].'</span></div>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        }
                        if ('5' == $settings['type']) {
                            echo '<div class="testi-type5 testi--new">';
                                echo '<figcaption>';
                                    if ($item['text']) {
                                        echo '<blockquote class="testi-quote">'.$item['text'].'<div class="arrow"></div></blockquote>';
                                    }
                                    if ( $item['name'] ) {
                                        echo '<div class="author">';
                                            echo '<div class="testi-author">'.$item['name'].' <span class="testi-info">'.$item['info'].'</span></div>';
                                        echo '</div>';
                                    }
                                echo '</figcaption>';
                                if ($item['avatar']['url']) {
                                    echo '<div class="testi-avatar" style="background-image:url('.$image.';)" alt="'.$timagealt.'"></div>';
                                }
                            echo '</div>';
                        }
                        if ('6' == $settings['type']) {
                            echo '<div class="testi-type6 testi--new">';
                                if ($item['text']) {
                                    echo '<blockquote class="testi-quote">'.$item['text'].'<div class="arrow"></div></blockquote>';
                                }
                                if ($item['avatar']['url']) {
                                    echo '<img class="testi-avatar" src="'.$image.'" alt="'.$timagealt.'">';
                                }
                                if ( $item['name'] ) {
                                    echo '<div class="author">';
                                        echo '<div class="testi-author">'.$item['name'].' <span class="testi-info">'.$item['info'].'</span></div>';
                                    echo '</div>';
                                }
                            echo '</div>';
                        }
                    echo '</div>';

                }

            echo '</div>';
            if ( 'yes' == $settings['arrows'] ) {
                echo '<div class="navs">';
                    echo '<span class="prev"><i class="ion-ios-arrow-left"></i></span>';
                    echo '<span class="next"><i class="ion-ios-arrow-right"></i></span>';
                echo '</div>';
            }
        echo '</div>';
    }
}
