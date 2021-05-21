<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wavo_Vegas_Slider extends Widget_Base {
    use Wavo_Helper;
    public function get_name() {
        return 'wavo-vegas-slider';
    }
    public function get_title() {
        return 'Vegas Slider (N)';
    }
    public function get_icon() {
        return 'eicon-slider-push';
    }
    public function get_categories() {
        return [ 'wavo' ];
    }
    public function get_style_depends() {
        return [ 'vegas' ];
    }
    public function get_script_depends() {
        return [ 'vegas','splitting' ];
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
        $this->add_control( 'header',
            [
                'label' => esc_html__( 'Show Header', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'header_type',
            [
                'label' => esc_html__( 'Header Template', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'overlay',
                'options' => [
                    'overlay' => esc_html__( 'Default Overlay Menu', 'wavo' ),
                    'template' => esc_html__( 'Elementor Template', 'wavo' )
                ],
                'condition' => [ 'header' => 'yes' ]
            ]
        );
        $this->add_control( 'template',
            [
                'label' => esc_html__( 'Select Template', 'wavo' ),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple' => false,
                'options' => $this->wavo_get_elementor_templates(),
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'header',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'header_type',
                            'operator' => '==',
                            'value' => 'template'
                        ]
                    ]
                ]
            ]
        );
        $this->add_responsive_control( 'minheight',
            [
                'label' => esc_html__( 'Min Height ( vh )', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 100,
                'selectors' => ['{{WRAPPER}} .home-slider-vegas-wrapper' => 'height: {{SIZE}}vh;min-height: {{SIZE}}vh;'],
                'separator' => 'before',
            ]
        );
        $def_image = plugins_url( 'assets/front/img/bg4.jpg', __DIR__ );
        $repeater = new Repeater();
        $repeater->add_control( 'image',
            [
                'label' => esc_html__( 'Image', 'wavo' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => $def_image],
            ]
        );
        $repeater->add_control( 'vurl',
            [
                'label' => esc_html__( 'Hosted Video URL', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '',
                'separator' => 'before',
            ]
        );
        $repeater->add_control( 'mute',
            [
                'label' => esc_html__( 'Video Mute', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => ['vurl!' => '']
            ]
        );
        $repeater->add_responsive_control( 'sdelay',
            [
                'label' => esc_html__( 'Delay ( ms )', 'wavo' ),
                'description' => esc_html__( 'Delay beetween slides in milliseconds.', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'step' => 100,
                'default' => '',
            ]
        );
        $repeater->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'wavo' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Slider Title',
                'pleaceholder' => esc_html__( 'Enter title here', 'wavo' ),
                'separator' => 'before',
            ]
        );
        $repeater->add_control( 'titleclr',
            [
                'label' => esc_html__( 'Title Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );
        $repeater->add_control( 'desc',
            [
                'label' => esc_html__( 'Description', 'wavo' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'pleaceholder' => esc_html__( 'Enter description here', 'wavo' ),
                'separator' => 'before',
            ]
        );
        $repeater->add_control( 'descclr',
            [
                'label' => esc_html__( 'Description Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );
        $repeater->add_control( 'btn_title',
            [
                'label' => esc_html__( 'Button Title', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Shop Now',
                'pleaceholder' => esc_html__( 'Enter button title here', 'wavo' ),
                'separator' => 'before',
            ]
        );
        $repeater->add_control( 'btn_link',
            [
                'label' => esc_html__( 'Button Link', 'wavo' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#0',
                    'is_external' => 'true'
                ],
                'placeholder' => esc_html__( 'Place URL here', 'wavo' )
            ]
        );
        $repeater->add_control( 'btn_type',
            [
                'label' => esc_html__( 'Button Type', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'dis',
                'options' => [
                    'dis' => esc_html__( 'Default', 'wavo' ),
                    'btn-curve btn-lit btn-radius mt-30' => esc_html__( 'Button Outline', 'wavo' )
                ]
            ]
        );
        $repeater->add_control( 'btnclr',
            [
                'label' => esc_html__( 'Button Title Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'condition' => ['btn_type' => 'dis']
            ]
        );
        $repeater->add_control( 'overlayclr',
            [
                'label' => esc_html__( 'Overlay Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'separator' => 'before',
            ]
        );
        $repeater->add_control( 'bgcolor',
            [
                'label' => esc_html__( 'Slide Background Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
            ]
        );
        $repeater->add_control( 'text_alignment',
            [
                'label' => esc_html__( 'Text Alignment', 'wavo' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'text-left' => [
                        'title' => esc_html__( 'Left', 'wavo' ),
                        'icon' => 'fa fa-align-left'
                    ],
                    'text-center' => [
                        'title' => esc_html__( 'Center', 'wavo' ),
                        'icon' => 'fa fa-align-center'
                    ],
                    'text-right' => [
                        'title' => esc_html__( 'Right', 'wavo' ),
                        'icon' => 'fa fa-align-right'
                    ]
                ],
                'toggle' => false,
                'default' => 'left',
                'separator' => 'before',
            ]
        );
        $repeater->add_control( 'vertical_alignment',
            [
                'label' => esc_html__( 'Vertical Alignment', 'wavo' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Top', 'wavo' ),
                        'icon' => 'eicon-v-align-top'
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'wavo' ),
                        'icon' => 'eicon-v-align-middle'
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Bottom', 'wavo' ),
                        'icon' => 'eicon-v-align-bottom'
                    ]
                ],
                'toggle' => true,
                'default' => ''
            ]
        );
        $this->add_control( 'slides',
            [
                'label' => esc_html__( 'Slide Items', 'wavo' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{title}}',
                'separator' => 'before',
                'default' => [
                    [
                        'image' => ['url' => $def_image],
                        'title' => 'From <span class="stroke">The</span><br> <span class="stroke">Inside</span> Out',
                        'btn_title' => 'Discover Work',
                        'btn_link' => '#0'
                    ],
                    [
                        'image' => ['url' => $def_image],
                        'title' => 'Luxury <br> <span class="stroke">Real</span>Estate',
                        'btn_title' => 'Discover Work',
                        'btn_link' => '#0'
                    ],
                    [
                        'image' => ['url' => $def_image],
                        'title' => 'Classic <br> <span class="stroke">&</span>Modern',
                        'btn_title' => 'Discover Work',
                        'btn_link' => '#0'
                    ],
                    [
                        'image' => ['url' => $def_image],
                        'title' => 'Explore <br> <span class="stroke">The</span>World',
                        'btn_title' => 'Discover Work',
                        'btn_link' => '#0'
                    ]
                ]
            ]
        );
        $this->add_control( 'home_slider_social_heading',
            [
                'label' => esc_html__( 'SOCIAL MEDIA', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'social_type',
            [
                'label' => esc_html__( 'Social Media Type', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'text',
                'options' => [
                    'text' => esc_html__( 'Text', 'wavo' ),
                    'icon' => esc_html__( 'Icon', 'wavo' )
                ]
            ]
        );
        $repeater2 = new Repeater();
        $repeater2->add_control( 'social_text',
            [
                'label' => esc_html__( 'Social Name', 'awam' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Behance'
            ]
        );
        $repeater2->add_control( 'link',
            [
                'label' => esc_html__( 'Link', 'awam' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => 'true',
                ],
                'placeholder' => esc_html__( 'Place URL here', 'awam' )
            ]
        );
        $this->add_control( 'socials',
            [
                'label' => esc_html__( 'Socials', 'awam' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater2->get_controls(),
                'title_field' => '{{social_text}}',
                'default' => [
                    [
                        'social_text' => 'Facebook'
                    ],
                    [
                        'social_text' => 'Twitter'
                    ],
                    [
                        'social_text' => 'Behance'
                    ]
                ],
                'condition' => ['social_type' => 'text']
            ]
        );
        $repeater3 = new Repeater();
        $repeater3->add_control( 'social',
            [
                'name' => 'social',
                'label' => esc_html__( 'Icon', 'awam' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fab fa-wordpress',
                    'library' => 'fa-brands'
                ]
            ]
        );
        $repeater3->add_control( 'link2',
            [
                'label' => esc_html__( 'Link', 'awam' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => 'true',
                ],
                'placeholder' => esc_html__( 'Place URL here', 'awam' )
            ]
        );
        $this->add_control( 'social2',
            [
                'label' => esc_html__( 'Slide Items', 'awam' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater3->get_controls(),
                'title_field' => '<i class="{{social.value}}"></i>',
                'default' => [
                    [
                        'social' => [
                            'value' => 'fab fa-facebook',
                            'library' => 'fa-brands'
                        ]
                    ],
                    [
                        'social' => [
                            'value' => 'fab fa-twitter',
                            'library' => 'fa-brands'
                        ]
                    ],
                    [
                        'social' => [
                            'value' => 'fab fa-instagram',
                            'library' => 'fa-brands'
                        ]
                    ]
                ],
                'condition' => ['social_type' => 'icon']
            ]
        );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        $this->start_controls_section( 'slider_options_section',
            [
                'label' => esc_html__( 'Slider Options', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'animation',
            [
                'label' => esc_html__( 'Animation Type', 'wavo' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'default' => ['kenburns'],
                'options' => [
                    'kenburns' => esc_html__( 'kenburns', 'wavo' ),
                    'kenburnsUp' => esc_html__( 'kenburnsUp', 'wavo' ),
                    'kenburnsDown' => esc_html__( 'kenburnsDown', 'wavo' ),
                    'kenburnsLeft' => esc_html__( 'kenburnsLeft', 'wavo' ),
                    'kenburnsRight' => esc_html__( 'kenburnsRight', 'wavo' ),
                    'kenburnsUpLeft' => esc_html__( 'kenburnsUpLeft', 'wavo' ),
                    'kenburnsUpRight' => esc_html__( 'kenburnsUpRight', 'wavo' ),
                    'kenburnsDownLeft' => esc_html__( 'kenburnsDownLeft', 'wavo' ),
                    'kenburnsDownRight' => esc_html__( 'kenburnsDownRight', 'wavo' ),
                ]
            ]
        );
        $this->add_control( 'transition',
            [
                'label' => esc_html__( 'Transition Type', 'wavo' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'default' => ['zoomIn','slideLeft','slideRight'],
                'options' => [
                    'fade' => esc_html__( 'fade', 'wavo' ),
                    'fade2' => esc_html__( 'fade2', 'wavo' ),
                    'slideLeft' => esc_html__( 'slideLeft', 'wavo' ),
                    'slideLeft2' => esc_html__( 'slideLeft2', 'wavo' ),
                    'slideRight' => esc_html__( 'slideRight', 'wavo' ),
                    'slideRight2' => esc_html__( 'slideRight2', 'wavo' ),
                    'slideUp' => esc_html__( 'slideUp', 'wavo' ),
                    'slideUp2' => esc_html__( 'slideUp2', 'wavo' ),
                    'slideDown' => esc_html__( 'slideDown', 'wavo' ),
                    'slideDown2' => esc_html__( 'slideDown2', 'wavo' ),
                    'zoomIn' => esc_html__( 'zoomIn', 'wavo' ),
                    'zoomIn2' => esc_html__( 'zoomIn2', 'wavo' ),
                    'zoomOut' => esc_html__( 'zoomOut', 'wavo' ),
                    'zoomOut2' => esc_html__( 'zoomOut2', 'wavo' ),
                    'swirlLeft' => esc_html__( 'swirlLeft', 'wavo' ),
                    'swirlLeft2' => esc_html__( 'swirlLeft2', 'wavo' ),
                    'swirlRight' => esc_html__( 'swirlRight', 'wavo' ),
                    'swirlRight2' => esc_html__( 'swirlRight2', 'wavo' ),
                    'burn' => esc_html__( 'burn', 'wavo' ),
                    'burn2' => esc_html__( 'burn2', 'wavo' ),
                    'blur' => esc_html__( 'blur', 'wavo' ),
                    'blur2' => esc_html__( 'blur2', 'wavo' ),
                    'flash' => esc_html__( 'flash', 'wavo' ),
                    'flash2' => esc_html__( 'flash2', 'wavo' ),
                ]
            ]
        );
        $this->add_control( 'overlay',
            [
                'label' => esc_html__( 'Overlay Image Type', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    'none' => esc_html__( 'None', 'wavo' ),
                    '01' => esc_html__( 'Overlay 1', 'wavo' ),
                    '02' => esc_html__( 'Overlay 2', 'wavo' ),
                    '03' => esc_html__( 'Overlay 3', 'wavo' ),
                    '04' => esc_html__( 'Overlay 4', 'wavo' ),
                    '05' => esc_html__( 'Overlay 5', 'wavo' ),
                    '06' => esc_html__( 'Overlay 6', 'wavo' ),
                    '07' => esc_html__( 'Overlay 7', 'wavo' ),
                    '08' => esc_html__( 'Overlay 8', 'wavo' ),
                    '09' => esc_html__( 'Overlay 9', 'wavo' ),
                ]
            ]
        );
        $this->add_control( 'delay',
            [
                'label' => esc_html__( 'Delay ( ms )', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 7000,
            ]
        );
        $this->add_control( 'duration',
            [
                'label' => esc_html__( 'Transition Duration ( ms )', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 2000,
            ]
        );
        $this->add_control( 'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control( 'shuffle',
            [
                'label' => esc_html__( 'Shuffle', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'timer',
            [
                'label' => esc_html__( 'Timer', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'selectors'  => ['{{WRAPPER}} .vegas-timer' => 'display:block!important;'],
            ]
        );
        $this->add_control( 'timer_size',
            [
                'label' => esc_html__( 'Timer Height', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 5,
                'selectors'  => ['{{WRAPPER}} .vegas-timer' => 'height:{{VALUE}};'],
                'condition'  => ['timer' => 'yes'],
            ]
        );
        $this->add_control( 'timer_color',
            [
                'label' => esc_html__( 'Timer Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors'  => ['{{WRAPPER}} .vegas-timer-progress' => 'background-color:{{VALUE}};'],
                'condition'  => ['timer' => 'yes'],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   END CONTROLS SECTION   ******/
        $this->start_controls_section( 'home_slider_heading_style_section',
            [
                'label' => esc_html__( 'Heading', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->wavo_style_color( 'home_slider_heading_color', '{{WRAPPER}} .nt-vegas-slide-content .slider_hero_title' );
        $this->wavo_style_typo( 'home_slider_heading_typo', '{{WRAPPER}} .nt-vegas-slide-content .slider_hero_title' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   END CONTROLS SECTION   ******/
        $this->start_controls_section( 'home_slider_btn_style_section',
            [
                'label' => esc_html__( 'Button', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->wavo_style_color( 'home_slider_btn_color', '{{WRAPPER}} .nt-vegas-slide-content .dis' );
        $this->wavo_style_typo( 'home_slider_btn_typo', '{{WRAPPER}} .nt-vegas-slide-content .dis' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $settingsid = $this->get_id();
        $sliderattr = '';

        $autoplay = 'yes' == $settings['autoplay'] ? 'true' : 'false';
        $shuffle = 'yes' == $settings['shuffle'] ? 'true' : 'false';
        $timer = 'yes' == $settings['timer'] ? 'true' : 'false';
        $overlay = 'none' == $settings['overlay'] ? 'false' : 'true';


        $slides = array();
        foreach ( $settings['slides'] as $i ) {
            $sdelay = $i['sdelay'] ? ',"delay":'.$i['sdelay'] : '';
            $mute = 'yes' == $i['mute'] ? 'true' : 'false';
            $bgcolor = $i['bgcolor'] ? ',"color":"'.$i['bgcolor'].'"' : '';
            if ( $i['vurl'] != '' ) {
                $slides[] .= '{"src":"'.$i['image']['url'].'","video": {"src":"'.$i['vurl'].'","loop": false,"mute":'.$mute.'}'.$sdelay.$bgcolor.'}';
            } else {
                $slides[] .= '{"src":"'.$i['image']['url'].'"'.$sdelay.$bgcolor.'}';
            }
        }

        $animation = array();
        foreach ( $settings['animation'] as $anim ) {
            $animation[] .=  '"'.$anim.'"';
        }

        $transition = array();
        foreach ( $settings['transition'] as $trans ) {
            $transition[] .=  '"'.$trans.'"';
        }

        $sliderattr .= '"slides":['.implode(',', $slides).'],';
        $sliderattr .= '"animation":['.implode(',', $animation).'],';
        $sliderattr .= '"transition":['.implode(',', $transition).'],';
        $sliderattr .= '"delay":'.$settings['delay'].',';
        $sliderattr .= '"duration":'.$settings['duration'].',';
        $sliderattr .= '"timer":"'.$settings['timer'].'",';
        $sliderattr .= '"shuffle":"'.$settings['shuffle'].'",';
        $sliderattr .= '"overlay":"'.$settings['overlay'].'",';
        $sliderattr .= '"autoplay":'.$autoplay;

        echo '<div class="home-slider-vegas-wrapper slider-vegas-'.$settingsid.'">';
            if ( 'yes' == $settings['header'] ) {
                if ( 'template' == $settings['header_type'] && !empty( $settings['template'] ) ) {
                    echo '<div class="header-template-wrapper">';
                        $style = \Elementor\Plugin::$instance->editor->is_edit_mode() ? true : false;
                        $template_id = $settings['template'];
                        $mega_content = new Frontend;
                        echo $mega_content->get_builder_content_for_display($template_id, $style );
                    echo '</div>';
                } else {
                    do_action('wavo_header_action');
                }
            }
            echo '<div id="slider-'.$settingsid.'" class="nt-home-slider-vegas" data-slider-settings=\'{'.$sliderattr.'}\'></div>';
            $countt = 1;
            foreach ( $settings['slides'] as $item ) {
                $target = $item['btn_link']['is_external'] ? ' target="_blank"' : '';
                $nofollow = $item['btn_link']['nofollow'] ? ' rel="nofollow"' : '';
                $hasvideo = '' != $item['vurl'] ? ' has-bg-video' : '';
                $vertical_alignment = '' != $item['vertical_alignment'] ? ' style="align-items:'.$item['vertical_alignment'].';"' : '';
                echo '<div class="nt-vegas-slide-content '.$item['text_alignment'].$hasvideo.'"'.$vertical_alignment.'>';
                    if( $item['overlayclr'] ){
                        echo '<div class="nt-vegas-overlay" style="background-color:'.$item['overlayclr'].';"></div>';
                    }
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-12">';

                                if( $item['title'] ){
                                    $titleclr = $item['titleclr'] ? ' style="color:'.$item['titleclr'].';"' : '';
                                    echo '<h1 class="slider_hero_title"'.$titleclr.' data-splitting>'.$item['title'].'</h1>';
                                }
                                if( $item['desc'] ){
                                    $descclr = $item['descclr'] ? ' style="color:'.$item['descclr'].';"' : '';
                                    echo '<p class="slider_hero_desc"'.$descclr.'>'.$item['desc'].'</p>';
                                }
                                if( $item['btn_title'] ){
                                    $splitting = 'dis' == $item['btn_type'] ? ' data-splitting' : '';
                                    $btnclr = $item['descclr'] ? ' style="color:'.$item['btnclr'].';"' : '';
                                    $lineclr = $item['descclr'] ? ' style="color:'.$item['btnclr'].';"' : '';
                                    $line = 'dis' == $item['btn_type'] ? ' <div class="line"'.$lineclr.'></div>' : '';
                                    echo '<a href="'.$item['btn_link']['url'].'" '.$target.$nofollow.' class="'.$item['btn_type'].'"'.$btnclr.' '.$splitting.'>'.$line.$item['btn_title'].'</a>';
                                }

                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                    if ( '' != $item['vurl'] && 'yes' != $item['mute'] ) {
                        echo '<div class="equaliser-container">';
                          echo '<ol class="equaliser-column"><li class="colour-bar"></li></ol>';
                          echo '<ol class="equaliser-column"><li class="colour-bar"></li></ol>';
                          echo '<ol class="equaliser-column"><li class="colour-bar"></li></ol>';
                          echo '<ol class="equaliser-column"><li class="colour-bar"></li></ol>';
                          echo '<ol class="equaliser-column"><li class="colour-bar"></li></ol>';
                          echo '<ol class="equaliser-column"><li class="colour-bar"></li></ol>';
                          echo '<ol class="equaliser-column"><li class="colour-bar"></li></ol>';
                          echo '<ol class="equaliser-column"><li class="colour-bar"></li></ol>';
                          echo '<ol class="equaliser-column"><li class="colour-bar"></li></ol>';
                        echo '</div>';
                    }
                echo '</div>';
                $countt++;
            }

            if ( 'text' == $settings['social_type'] ) {
                if ( $settings['socials'] ) {
                    echo '<div class="social"><span class="icon"><i class="fas fa-share-alt"></i></span>';
                    foreach ( $settings['socials'] as $item ) {
                        $target = $item['link']['is_external'] ? ' target="_blank"' : '';
                        echo '<a class="social_link" href="'.esc_attr( $item['link']['url'] ).'"'.$target.'>'.$item['social_text'].'</a>';
                    }
                    echo '</div>';
                }

            } else {

                if ( $settings['social2'] ) {
                    echo '<div class="social"><span class="icon"><i class="fas fa-share-alt"></i></span>';
                    foreach ( $settings['social2'] as $item ) {
                        $target = $item['link2']['is_external'] ? ' target="_blank"' : '';
                        echo '<a class="social_link" href="'.esc_attr( $item['link2']['url'] ).'"'.$target.'>';
                            if ( ! empty($item['social']['value']) ) {
                                Icons_Manager::render_icon( $item['social'], [ 'aria-hidden' => 'true' ] );
                            }
                        echo '</a>';
                    }
                    echo '</div>';
                }
            }
            echo '<div class="nt-vegas-slide-counter">';
                echo '<span class="current">0</span>';
                echo '<span class="separator"> / </span>';
                echo '<span class="total">4</span>';
            echo '</div>';

            echo '<div class="vegas-control">';
                echo '<span id="vegas-control-prev" class="vegas-control-prev vegas-control-btn"><i class="fas fa-caret-left"></i></span>';
                echo '<span id="vegas-control-next" class="vegas-control-next vegas-control-btn"><i class="fas fa-caret-right"></i></span>';
            echo '</div>';
        echo '</div>';

        // Not in edit mode
        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) { ?>
            <script>
            jQuery(document).ready(function ($) {

                var myEl       = $('.slider-vegas-<?php echo $settingsid; ?>'),
                    myVegasId  = myEl.find('.nt-home-slider-vegas').attr('id'),
                    myVegas    = $( '#' + myVegasId ),
                    myPrev     = myEl.find('.vegas-control-prev'),
                    myNext     = myEl.find('.vegas-control-next'),
                    mySettings = myEl.find('.nt-home-slider-vegas').data('slider-settings'),
                    myContent  = myEl.find('.nt-vegas-slide-content'),
                    myCounter  = myEl.find('.nt-vegas-slide-counter'),
                    mySocials  = myEl.find('.social .icon');

                if( mySettings.slides.length ) {

                    myVegas.vegas({
                        autoplay: <?php echo $autoplay; ?>,
                        delay: <?php echo $settings['delay']; ?>,
                        timer: <?php echo $timer; ?>,
                        shuffle: <?php echo $shuffle; ?>,
                        animation: [<?php echo implode(',', $animation); ?>],
                        transition: [<?php echo implode(',', $transition); ?>],
                        transitionDuration: <?php echo $settings['duration']; ?>,
                        overlay: <?php echo $overlay; ?>,
                        slides: [<?php echo implode(',', $slides); ?>],
                        init: function (globalSettings) {
                            myContent.eq(0).addClass('active');
                            var total = myContent.size();
                            myCounter.find('.total').html(total);
                        },
                        walk: function (index, slideSettings) {
                            myContent.removeClass('active').eq(index).addClass('active');
                            var current = index +1;
                            myCounter.find('.current').html(current);
                        }
                    });
                    myPrev.on('click', function () {
                        myVegas.vegas('previous');
                    });

                    myNext.on('click', function () {
                        myVegas.vegas('next');
                    });
                    mySocials.on( 'click', function () {
                        $( this ).parent().toggleClass( "active" );
                    });
                }
            });
            </script>
            <?php
        }
    }
}
