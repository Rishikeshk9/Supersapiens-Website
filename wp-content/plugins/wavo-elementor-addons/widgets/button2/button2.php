<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wavo_Button2 extends Widget_Base {
    use Wavo_Helper;
    public function get_name() {
        return 'wavo-button2';
    }
    public function get_title() {
        return 'Button 2 (N)';
    }
    public function get_icon() {
        return 'eicon-button';
    }
    public function get_categories() {
        return [ 'wavo' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        wp_register_style( 'wavo-button2', WAVO_PLUGIN_URL. 'widgets/button2/style.css');
        wp_register_script( 'wavo-button2', WAVO_PLUGIN_URL. 'widgets/button2/script.js', [ 'elementor-frontend' ], '1.0.0', true);
    }
    public function get_style_depends() {
        return [ 'jquery-ui','magnific','wavo-button2' ];
    }
    public function get_script_depends() {
        return [ 'jquery-ui', 'magnific','wavo-button2' ];
    }
    // Registering Controls
    protected function register_controls() {

        /*****   Button Options   ******/

        $this->start_controls_section('wavo_btn_settings',
            [
                'label' => esc_html__( 'Button', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'btn_skin',
            [
                'label' => esc_html__( 'Button Skin Type', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'nt-btn-0',
                'options' => [
                    'button-type-1' => esc_html__( 'button-type-1', 'wavo' ),
                    'nt-btn-0' => esc_html__( 'Swipe', 'wavo' ),
                    'nt-btn-1' => esc_html__( 'Diagonal Swipe', 'wavo' ),
                    'nt-btn-1-2' => esc_html__( 'Double Swipe', 'wavo' ),
                    'nt-btn-2' => esc_html__( 'Diagonal Close', 'wavo' ),
                    'nt-btn-3' => esc_html__( 'Zooming In', 'wavo' ),
                    'nt-btn-4' => esc_html__( '4 Corners', 'wavo' ),
                    'nt-btn-5' => esc_html__( 'Slice', 'wavo' ),
                    'nt-btn-6' => esc_html__( 'Position Aware', 'wavo' ),
                    'nt-btn-7' => esc_html__( 'Alternate', 'wavo' ),
                    'nt-btn-8' => esc_html__( 'Smoosh', 'wavo' ),
                    'nt-btn-9' => esc_html__( 'Vertical Overlap', 'wavo' ),
                    'nt-btn-10' => esc_html__( 'Horizontal Overlap', 'wavo' ),
                    'nt-btn-11' => esc_html__( 'Collision', 'wavo' ),
                    'nt-btn-12' => esc_html__( 'Shadow', 'wavo' ),
                    'style-1' => esc_html__( 'Line 1', 'wavo' ),
                    'style-2' => esc_html__( 'Line 2', 'wavo' ),
                    'style-3' => esc_html__( 'Line 3', 'wavo' ),
                    'style-4' => esc_html__( 'Line 4', 'wavo' ),
                    'style-5' => esc_html__( 'Line 5', 'wavo' ),
                    'style-6' => esc_html__( 'Line 6', 'wavo' ),
                    'btn-arrow' => esc_html__( 'Arrow Down', 'wavo' ),
                ],
            ]
        );
        $this->add_control( 'btn_line_width',
            [
                'label' => esc_html__( 'Button Width', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 10,
                'max' => 2000,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .nt-btn-line' => 'width: {{VALUE}}px;', ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'btn_skin',
                            'operator' => '==',
                            'value' => 'style-1'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '==',
                            'value' => 'style-2'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '==',
                            'value' => 'style-3'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '==',
                            'value' => 'style-4'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '==',
                            'value' => 'style-5'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '==',
                            'value' => 'style-6'
                        ],
                    ]
                ]
            ]
        );
        $this->add_control( 'btn_line_height',
            [
                'label' => esc_html__( 'Button Height', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 10,
                'max' => 2000,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .nt-btn-line' => 'height: {{VALUE}}px;', ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'btn_skin',
                            'operator' => '==',
                            'value' => 'style-1'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '==',
                            'value' => 'style-2'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '==',
                            'value' => 'style-3'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '==',
                            'value' => 'style-4'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '==',
                            'value' => 'style-5'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '==',
                            'value' => 'style-6'
                        ],
                    ]
                ]
            ]
        );
        $this->add_control( 'btn_action',
            [
                'label' => esc_html__( 'Action Type', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'link',
                'options' => [
                    'link' => esc_html__( 'Link', 'wavo' ),
                    'image' => esc_html__( 'Single Image', 'wavo' ),
                    'youtube' => esc_html__( 'Youtube', 'wavo' ),
                    'vimeo' => esc_html__( 'Vimeo', 'wavo' ),
                    'map' => esc_html__( 'Google Map', 'wavo' ),
                    'html5' => esc_html__( 'HTML5 Video', 'wavo' ),
                    'modal' => esc_html__( 'Modal Content', 'wavo' ),
                ],
                'condition' => ['btn_skin!' => 'btn-arrow'],
                'separator' => 'before'
            ]
        );
        $this->add_control( 'link_type',
            [
                'label' => esc_html__( 'Link Type', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'external',
                'options' => [
                    'external' => esc_html__( 'External', 'wavo' ),
                    'internal' => esc_html__( 'Internal', 'wavo' ),
                ],
                'condition' => ['btn_action' => 'link']
            ]
        );
        $this->add_control( 'custom_color',
            [
                'label' => esc_html__( 'Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .button-type-1:before,{{WRAPPER}} .button-type-1:after, {{WRAPPER}} [class^="nt-btn-"],{{WRAPPER}} [class*="nt-btn-"]' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .nt-btn-5:after' => 'border-color: transparent {{VALUE}} transparent transparent;',
                    '{{WRAPPER}} .nt-btn-5:before' => 'border-color: transparent transparent transparent {{VALUE}};',
                    '{{WRAPPER}} .nt-btn-1:before,{{WRAPPER}} .nt-btn-1-2:before,{{WRAPPER}} .nt-btn-1-2:after,{{WRAPPER}} .nt-btn-2:before,{{WRAPPER}} .nt-btn-3:before,{{WRAPPER}} .nt-btn-3:after' => 'border-bottom-color: {{VALUE}};',
                    '{{WRAPPER}} .nt-btn-2:after,{{WRAPPER}} .nt-btn-3:before,{{WRAPPER}} .nt-btn-3:after' => 'border-top-color:{{VALUE}};',
                    '{{WRAPPER}} .button-type-1, {{WRAPPER}} .nt-btn-0:before,{{WRAPPER}} .nt-btn-4:before,{{WRAPPER}} .nt-btn-4:after,{{WRAPPER}} .nt-btn-4 span:before,{{WRAPPER}} .nt-btn-4 span:after,{{WRAPPER}} .nt-btn-6 span:not(.nt_btn_text),{{WRAPPER}} .nt-btn-7:before,{{WRAPPER}} .nt-btn-7:after,{{WRAPPER}} .nt-btn-7 span:before,{{WRAPPER}} .nt-btn-7 span:after,{{WRAPPER}} .nt-btn-8:before,{{WRAPPER}} .nt-btn-8:after,{{WRAPPER}} .nt-btn-9:before,{{WRAPPER}} .nt-btn-9:after,{{WRAPPER}} .nt-btn-9 span:before,{{WRAPPER}} .nt-btn-9 span:after,{{WRAPPER}} .nt-btn-10:before,{{WRAPPER}} .nt-btn-10:after,{{WRAPPER}} .nt-btn-10 span:before,{{WRAPPER}} .nt-btn-10 span:after,{{WRAPPER}} .nt-btn-11:before,{{WRAPPER}} .nt-btn-11:after,{{WRAPPER}} .nt-btn-12,{{WRAPPER}} .nt-btn-12::after, {{WRAPPER}} .nt-btn-line > i' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .button-type-1:before' => 'box-shadow: 0 0 60px {{VALUE}};',
                    '{{WRAPPER}} .button-type-1' => 'box-shadow: 12px 12px 24px {{VALUE}};',
                    '{{WRAPPER}} .nt-btn-12:hover' => 'box-shadow: 0 10px 20px {{VALUE}};',
                    '{{WRAPPER}} .btn-arrow span' => 'border-right-color: {{VALUE}};border-bottom-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'text',
            [
                'label' => esc_html__( 'Button Text', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Button Text', 'wavo' ),
                'condition' => ['btn_skin!' => 'btn-arrow']
            ]
        );
        $this->add_control( 'link',
            [
                'label' => esc_html__( 'Button Link', 'wavo' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'dynamic' => ['active' => true ],
                'default' => [
                    'url' => '#',
                    'is_external' => ''
                ],
                'show_external' => true,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'btn_action',
                            'operator' => '==',
                            'value' => 'link'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '==',
                            'value' => 'btn-arrow'
                        ]
                    ]
                ]
            ]
        );
        $this->add_control( 'image',
            [
                'label' => esc_html__( 'Image', 'wavo' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => Utils::get_placeholder_image_src()],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'btn_action',
                            'operator' => '==',
                            'value' => 'image'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '!=',
                            'value' => 'btn-arrow'
                        ]
                    ]
                ]
            ]
        );
        $this->add_control( 'ltitle',
            [
                'label' => esc_html__( 'Lightbox Title', 'wavo' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Phone Name',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'btn_action',
                            'operator' => '==',
                            'value' => 'image'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '!=',
                            'value' => 'btn-arrow'
                        ]
                    ]
                ]
            ]
        );
        $this->add_control( 'youtube',
            [
                'label' => esc_html__( 'Youtube Video URL', 'wavo' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'http://www.youtube.com/watch?v=AeeE6PyU-dQ',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'btn_action',
                            'operator' => '==',
                            'value' => 'youtube'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '!=',
                            'value' => 'btn-arrow'
                        ]
                    ]
                ]
            ]
        );
        $this->add_control( 'vimeo',
            [
                'label' => esc_html__( 'Vimeo Video URL', 'wavo' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'https://vimeo.com/39493181',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'btn_action',
                            'operator' => '==',
                            'value' => 'vimeo'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '!=',
                            'value' => 'btn-arrow'
                        ]
                    ]
                ]
            ]
        );
        $this->add_control( 'map',
            [
                'label' => esc_html__( 'Iframe Map URL', 'wavo' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'https://maps.google.com/maps?q=221B+Baker+Street,+London,+United+Kingdom&amp;hl=en&amp;t=v&amp;hnear=221B+Baker+St,+London+NW1+6XE,+United+Kingdom',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'btn_action',
                            'operator' => '==',
                            'value' => 'map'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '!=',
                            'value' => 'btn-arrow'
                        ]
                    ]
                ]
            ]
        );
        $this->add_control( 'html5',
            [
                'label' => esc_html__( 'HTML5 Video URL', 'wavo' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => '',
                'pleaceholder' => esc_html__( 'Add your local video here', 'wavo' ),
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'btn_action',
                            'operator' => '==',
                            'value' => 'html5'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '!=',
                            'value' => 'btn-arrow'
                        ]
                    ]
                ]
            ]
        );
        $this->add_control( 'modal_content',
            [
                'label' => esc_html__( 'Modal Content', 'wavo' ),
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'default' => '<h3>Modal</h3><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla rhoncus pharetra dui, nec tempus tellus maximus et. Sed sed elementum ligula, id cursus leo. Duis imperdiet tortor id condimentum hendrerit.</p>',
                'pleaceholder' => esc_html__( 'Add html content here', 'wavo' ),
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'btn_action',
                            'operator' => '==',
                            'value' => 'modal'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '!=',
                            'value' => 'btn-arrow'
                        ]
                    ]
                ]
            ]
        );
        $this->add_control( 'modal_width',
            [
                'label' => esc_html__( 'Modal Content Width', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 2000
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 600,
                ],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'btn_action',
                            'operator' => '==',
                            'value' => 'modal'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '!=',
                            'value' => 'btn-arrow'
                        ]
                    ]
                ]
            ]
        );
        $this->add_control( 'use_icon',
            [
                'label' => esc_html__( 'Use Icon', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'condition' => ['btn_skin!' => 'btn-arrow']
            ]
        );
        $this->add_control( 'icon',
            [
                'label' => esc_html__( 'Button Icon', 'wavo' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => '',
                    'library' => 'solid'
                ],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'use_icon',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '!=',
                            'value' => 'btn-arrow'
                        ]
                    ]
                ]
            ]
        );
        $this->add_control( 'icon_pos',
            [
                'label' => esc_html__( 'Icon Position', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'btn-icon-right',
                'options' => [
                    'btn-icon-left' => esc_html__( 'Before', 'wavo' ),
                    'btn-icon-right' => esc_html__( 'After', 'wavo' )
                ],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'use_icon',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '!=',
                            'value' => 'btn-arrow'
                        ]
                    ]
                ]
            ]
        );
        $this->add_control( 'icon_spacing',
            [
                'label' => esc_html__( 'Icon Spacing', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 60
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .wavo-button .btn-icon-left .nt_btn_text i,{{WRAPPER}} .wavo-button .btn-icon-left .nt_btn_text svg' => 'margin-right: {{SIZE}}px;',
                    '{{WRAPPER}} .wavo-button .btn-icon-right .nt_btn_text i,{{WRAPPER}} .wavo-button .btn-icon-right .nt_btn_text svg' => 'margin-left: {{SIZE}}px;'
                ],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'use_icon',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '!=',
                            'value' => 'btn-arrow'
                        ]
                    ]
                ]
            ]
        );
        $this->add_responsive_control( 'alignment',
            [
                'label' => esc_html__( 'Alignment', 'wavo' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .wavo-button:not(.btn-justify)' => 'text-align: {{VALUE}};'],
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
                'default' => 'left',
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'btn_skin',
                            'operator' => '!=',
                            'value' => 'style-1'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '!=',
                            'value' => 'style-2'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '!=',
                            'value' => 'style-3'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '!=',
                            'value' => 'style-4'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '!=',
                            'value' => 'style-5'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '!=',
                            'value' => 'style-6'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '!=',
                            'value' => 'btn-arrow'
                        ],
                    ]
                ]
            ]
        );
        $this->add_responsive_control( 'alignment2',
            [
                'label' => esc_html__( 'Alignment', 'wavo' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .wavo-button' => 'display:flex;align-items:center;justify-content: {{VALUE}};'],
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'wavo' ),
                        'icon' => 'fa fa-align-left'
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'wavo' ),
                        'icon' => 'fa fa-align-center'
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'wavo' ),
                        'icon' => 'fa fa-align-right'
                    ]
                ],
                'toggle' => true,
                'default' => 'flex-start',
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'btn_skin',
                            'operator' => '==',
                            'value' => 'style-1'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '==',
                            'value' => 'style-2'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '==',
                            'value' => 'style-3'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '==',
                            'value' => 'style-4'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '==',
                            'value' => 'style-5'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '==',
                            'value' => 'style-6'
                        ],
                        [
                            'name' => 'btn_skin',
                            'operator' => '==',
                            'value' => 'btn-arrow'
                        ],
                    ]
                ]
            ]
        );
        $this->add_control( 'radius',
            [
                'label' => esc_html__( 'Border Radius Type', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'btn-radius',
                'options' => [
                    'btn-radius' => esc_html__( 'Default', 'wavo' ),
                    'btn-square' => esc_html__( 'Square', 'wavo' ),
                    'btn-circle' => esc_html__( 'Circle', 'wavo' ),
                ],
                'condition' => ['btn_skin!' => 'btn-arrow']
            ]
        );
        $this->end_controls_section();
        /*****   End Button Options   ******/

        /***** Button Style ******/
        $this->start_controls_section('wavo_btn_animation',
            [
                'label' => esc_html__( 'Button Animations', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => ['btn_skin!' => 'btn-arrow']
            ]
        );
        $this->add_control( 'aos_in',
            [
                'label' => esc_html__( 'Entrance Animation', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'none', 'wavo' ),
                    'fade' => esc_html__( 'fade', 'wavo' ),
                    'fade-up' => esc_html__( 'fade up', 'wavo' ),
                    'fade-down' => esc_html__( 'fade-down', 'wavo' ),
                    'fade-left' => esc_html__( 'fade-left', 'wavo' ),
                    'fade-right' => esc_html__( 'fade-right', 'wavo' ),
                    'fade-up-right' => esc_html__( 'fade-up-right', 'wavo' ),
                    'fade-up-left' => esc_html__( 'fade-up-left', 'wavo' ),
                    'fade-down-right' => esc_html__( 'fade-down-right', 'wavo' ),
                    'fade-down-left' => esc_html__( 'fade-down-left', 'wavo' ),
                    'flip-up' => esc_html__( 'flip-up', 'wavo' ),
                    'flip-down' => esc_html__( 'flip-down', 'wavo' ),
                    'flip-left' => esc_html__( 'flip-left', 'wavo' ),
                    'flip-right' => esc_html__( 'flip-right', 'wavo' ),
                    'slide-up' => esc_html__( 'slide-up', 'wavo' ),
                    'slide-down' => esc_html__( 'slide-down', 'wavo' ),
                    'slide-left' => esc_html__( 'slide-left', 'wavo' ),
                    'slide-right' => esc_html__( 'slide-right', 'wavo' ),
                    'zoom-in' => esc_html__( 'zoom-in', 'wavo' ),
                    'zoom-in-up' => esc_html__( 'zoom-in-up', 'wavo' ),
                    'zoom-in-down' => esc_html__( 'zoom-in-down', 'wavo' ),
                    'zoom-in-left' => esc_html__( 'zoom-in-left', 'wavo' ),
                    'zoom-in-right' => esc_html__( 'zoom-in-right', 'wavo' ),
                ],
            ]
        );
        $this->add_control( 'aos_delay',
            [
                'label' => esc_html__( 'Delay', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 5000,
                'step' => 50,
                'default' => 100,
                'description'=> esc_html__( 'the delay is in millisecond', 'wavo' ),
            ]
        );
        $this->end_controls_section();
        /*****   End Button Options   ******/

        /***** Button Style ******/
        $this->start_controls_section('wavo_btn_styling',
            [
                'label' => esc_html__( 'Button Custom Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['btn_skin!' => 'btn-arrow']
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typo',
                'label' => esc_html__( 'Typography', 'wavo' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .wavo-button .button-type-1, {{WRAPPER}} .wavo-button [class^="nt-btn-"],{{WRAPPER}} .wavo-button [class*="nt-btn-"]'
            ]
        );
        $this->start_controls_tabs('wavo_btn_tabs');
        $this->start_controls_tab( 'wavo_btn_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'wavo' ) ]
        );
        $this->add_control( 'btn_color',
            [
                'label' => esc_html__( 'Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .wavo-button .button-type-1, {{WRAPPER}} .wavo-button [class^="nt-btn-"],{{WRAPPER}} .wavo-button [class*="nt-btn-"]' => 'color: {{VALUE}};']
            ]
        );
        $this->add_responsive_control( 'btn_padding',
            [
                'label' => esc_html__( 'Padding', 'wavo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .button-type-1, {{WRAPPER}} [class^="nt-btn-"],{{WRAPPER}} [class*="nt-btn-"]' => 'padding-top: {{TOP}}{{UNIT}};padding-right: {{RIGHT}}{{UNIT}};padding-bottom: {{BOTTOM}}{{UNIT}};padding-left: {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_border',
                'label' => esc_html__( 'Border', 'wavo' ),
                'selector' => '{{WRAPPER}} .button-type-1, {{WRAPPER}} [class^="nt-btn-"],{{WRAPPER}} [class*="nt-btn-"]',
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control( 'btn_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'wavo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .button-type-1, {{WRAPPER}} [class^="nt-btn-"],{{WRAPPER}} [class*="nt-btn-"]' => 'border-top-left-radius: {{TOP}}{{UNIT}};border-top-right-radius: {{RIGHT}}{{UNIT}};border-bottom-left-radius: {{BOTTOM}}{{UNIT}};border-bottom-right-radius: {{LEFT}}{{UNIT}};'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                ],
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_background',
                'label' => esc_html__( 'Background', 'wavo' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .button-type-1, {{WRAPPER}} .nt-btn-0:before,{{WRAPPER}} .nt-btn-4:before,{{WRAPPER}} .nt-btn-4:after,{{WRAPPER}} .nt-btn-4 span:before,{{WRAPPER}} .nt-btn-4 span:after,{{WRAPPER}} .nt-btn-6 span:not(.nt_btn_text),{{WRAPPER}} .nt-btn-7:before,{{WRAPPER}} .nt-btn-7:after,{{WRAPPER}} .nt-btn-7 span:before,{{WRAPPER}} .nt-btn-7 span:after,{{WRAPPER}} .nt-btn-8:before,{{WRAPPER}} .nt-btn-8:after,{{WRAPPER}} .nt-btn-9:before,{{WRAPPER}} .nt-btn-9:after,{{WRAPPER}} .nt-btn-9 span:before,{{WRAPPER}} .nt-btn-9 span:after,{{WRAPPER}} .nt-btn-10:before,{{WRAPPER}} .nt-btn-10:after,{{WRAPPER}} .nt-btn-10 span:before,{{WRAPPER}} .nt-btn-10 span:after,{{WRAPPER}} .nt-btn-11:before,{{WRAPPER}} .nt-btn-11:after,{{WRAPPER}} .nt-btn-12,{{WRAPPER}} .nt-btn-12::after',
                'separator' => 'before'
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab('wavo_btn_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wavo' ) ]
        );
         $this->add_control( 'btn_hvr_color',
            [
                'label' => esc_html__( 'Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .button-type-1:hover, {{WRAPPER}} [class^="nt-btn-"]:hover,{{WRAPPER}} [class*="nt-btn-"]:hover, {{WRAPPER}} .nt-btn-line:hover .nt_btn_text' => 'color: {{VALUE}};']
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_hvr_border',
                'label' => esc_html__( 'Border', 'wavo' ),
                'selector' => '{{WRAPPER}} .button-type-1:hover, {{WRAPPER}} [class^="nt-btn-"]:hover,{{WRAPPER}} [class*="nt-btn-"]:hover',
                'separator' => 'before'
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_hvr_background',
                'label' => esc_html__( 'Background', 'wavo' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .button-type-1:hover, {{WRAPPER}} .nt-btn-0:hover:before,{{WRAPPER}} .nt-btn-4:hover:before,{{WRAPPER}} .nt-btn-4:hover:after,{{WRAPPER}} .nt-btn-4:hover span:before,{{WRAPPER}} .nt-btn-4:hover span:after,{{WRAPPER}} .nt-btn-6:hover span:not(.nt_btn_text),{{WRAPPER}} .nt-btn-7:hover:before,{{WRAPPER}} .nt-btn-7:hover:after,{{WRAPPER}} .nt-btn-7:hover span:before,{{WRAPPER}} .nt-btn-7:hover span:after,{{WRAPPER}} .nt-btn-8:hover:before,{{WRAPPER}} .nt-btn-8:hover:after,{{WRAPPER}} .nt-btn-9:hover:before,{{WRAPPER}} .nt-btn-9:hover:after,{{WRAPPER}} .nt-btn-9:hover span:before,{{WRAPPER}} .nt-btn-9:hover span:after,{{WRAPPER}} .nt-btn-10:hover:before,{{WRAPPER}} .nt-btn-10:hover:after,{{WRAPPER}} .nt-btn-10:hover span:before,{{WRAPPER}} .nt-btn-10:hover span:after,{{WRAPPER}} .nt-btn-11:hover:before,{{WRAPPER}} .nt-btn-11:hover:after,{{WRAPPER}} .nt-btn-12:hover,{{WRAPPER}} .nt-btn-12:hover:after, {{WRAPPER}} .nt-btn-line>i',
                'separator' => 'before'
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /***** End Button Styling *****/
    }

    protected function render() {
        $settings   = $this->get_settings_for_display();
        $settingsid = $this->get_id();

        $delay      = $settings['aos_delay'] ? ' data-aos-delay="'.$settings['aos_delay'].'"' : '';
        $aos_in     = $settings['aos_in'] ? ' data-aos="'.$settings['aos_in'].'"'.$delay : '';
        $has_aos    = $settings['aos_in'] ? ' has-aos': '';

        $skin       = $settings['btn_skin'];
        $radius     = $settings['radius'] ? ' '.$settings['radius'] : '';
        $iconpos    = !empty( $settings['icon']['value'] ) ? ' '.$settings['icon_pos'] : '';
        $btnicon    = $settings['use_icon'] == 'yes' ? ' has-icon' : '';
        $target     = $settings['link']['is_external'] ? ' target="_blank"' : '';
        $nofollow   = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
        $href       = $settings['link']['url'];

        $data       = $target.$nofollow;
        switch ($settings['btn_action']) {
            case 'image':
                $title = $settings['ltitle'] ? ' title="'.$settings['ltitle'].'"' : '';
                $data = ' data-wavo-lightbox=\'{"type":"image"}\'';
                $href = $settings['image']['url'];
                break;
            case 'youtube':
                $data = ' data-wavo-lightbox=\'{"type":"iframe"}\'';
                $href = $settings['youtube'] ? $settings['youtube'] : 'http://www.youtube.com/watch?v=AeeE6PyU-dQ';
                break;
            case 'vimeo':
                $data = ' data-wavo-lightbox=\'{"type":"iframe"}\'';
                $href = $settings['vimeo'] ? $settings['vimeo'] : 'https://vimeo.com/39493181';
                break;
            case 'map':
                $data = ' data-wavo-lightbox=\'{"type":"iframe"}\'';
                $href = $settings['map'] ? $settings['map'] : 'https://maps.google.com/maps?q=221B+Baker+Street,+London,+United+Kingdom&amp;hl=en&amp;t=v&amp;hnear=221B+Baker+St,+London+NW1+6XE,+United+Kingdom';
                break;
            case 'html5':
                $data = ' data-wavo-lightbox=\'{"type":"iframe"}\'';
                $href = $settings['html5'] ? $settings['html5'] : '';
                break;
            case 'modal':
                $data = ' data-wavo-lightbox=\'{"type":"modal"}\'';
                $href = '#modal_'.$settingsid;
                break;
            default:
                $data = $target.$nofollow;
                $href = $settings['link']['url'];
                break;
        }
        $link_type = 'link' == $settings['btn_action'] && 'internal' == $settings['link_type'] ? ' data-scroll-to' : '';
        if ( $skin == 'btn-arrow' ) {

            echo '<div class="wavo-button"><a href="'.$href.'"'.$data.'><div class="btn-arrow"><span></span><span></span><span></span></div></a></div>';

        } else {

            $span = 'nt-btn-6' == $skin ? '<span></span>' : '';
            $line = 'style-1' == $skin || 'style-2' == $skin || 'style-3' == $skin || 'style-4' == $skin || 'style-5' == $skin || 'style-6' == $skin ? '<i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i>' : '';
            $btn_new = 'style-1' == $skin || 'style-2' == $skin || 'style-3' == $skin || 'style-4' == $skin || 'style-5' == $skin || 'style-6' == $skin ? 'btn-new nt-btn-line ' : '';
            echo '<div class="wavo-button'.$btnicon.$has_aos.'"'.$aos_in.'>';

                if ( $settings['icon_pos'] == 'btn-icon-left' ) {

                    echo '<a'.$link_type.' class="'.$btn_new.$skin.$radius.$iconpos.'" href="'.$href.'"'.$data.'>';
                    echo $line;
                    echo '<span class="nt_btn_text">';
                    if ( !empty( $settings['icon']['value'] ) ) { Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); }
                    echo $settings['text'].$span.'</span>';
                    echo'</a>';

                } else {

                    echo '<a'.$link_type.' class="'.$btn_new.$skin.$radius.$iconpos.'" href="'.$href.'"'.$data.'>';
                    echo $line;
                    echo '<span class="nt_btn_text">'.$settings['text'];
                    if ( !empty( $settings['icon']['value'] ) ) { Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); }
                    echo $span.'</span>';
                    echo'</a>';
                }

                if ( $settings['btn_action'] == 'modal' && $settings['modal_content'] ) {

                    echo '<div id="modal_'.$settingsid.'" class="mfp-hide" style="position:relative; max-width:'.$settings['modal_width']['size'].'px; margin:auto; padding:30px; background-color:#ffffff;">';
                        echo $settings['modal_content'];
                    echo '</div>';

                }

            echo '</div>';
        }
        // Not in edit mode
        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() && $settings['btn_action'] != 'link' ) {
            if ( $settings['btn_action'] != 'link' ) { ?>
                <script>jQuery(document).ready(function($){function wavoLightbox(){var myLightboxes=$('[data-wavo-lightbox]'); if(myLightboxes.length){myLightboxes.each(function(i, el){var myLightbox=$(el);var myData=myLightbox.data('wavoLightbox');var myOptions={};if(!myData||!myData.type){return true;}if(myData.type==='gallery'){if(!myData.selector){return true;}myOptions={ delegate:myData.selector,type: 'image',gallery:{enabled:true}};}if(myData.type==='image'){myOptions={type:'image'};}if(myData.type==='iframe'){myOptions={type:'iframe'};}if(myData.type==='inline'){myOptions={type:'inline'};}if (myData.type==='modal'){myOptions={type:'inline',modal:false};}if(myData.type==='ajax'){myOptions={type:'ajax',overflowY:'scroll'};}myLightbox.magnificPopup(myOptions);});}}wavoLightbox();})
                </script>
            <?php }
        }
    }
}
