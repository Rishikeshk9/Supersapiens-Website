<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wavo_Home_Slider extends Widget_Base {
    use Wavo_Helper;
    public function get_name() {
        return 'wavo-home-slider';
    }
    public function get_title() {
        return 'Content Slider (N)';
    }
    public function get_icon() {
        return 'eicon-slider-push';
    }
    public function get_categories() {
        return [ 'wavo' ];
    }
    public function get_style_depends() {
        return [ 'swiper' ];
    }
    public function get_script_depends() {
        return [ 'swiper','splitting' ];
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
        $this->add_control( 'slider_position',
            [
                'label' => esc_html__( 'Position Type', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'fixed',
                'options' => [
                    'fixed' => esc_html__( 'Fixed', 'wavo' ),
                    'static' => esc_html__( 'Static', 'wavo' )
                ],
                'separator' => 'before',
            ]
        );
        $def_image = plugins_url( 'assets/front/img/bg4.jpg', __DIR__ );
        $repeater = new Repeater();
        $repeater->add_control( 'slider_image',
            [
                'label' => esc_html__( 'Image', 'wavo' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => $def_image]
            ]
        );
        $repeater->add_control( 'slider_image_768',
            [
                'label' => esc_html__( 'Responsive Image 768px', 'wavo' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => '']
            ]
        );
        $repeater->add_control( 'slider_image_576',
            [
                'label' => esc_html__( 'Responsive Image 576px', 'wavo' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => '']
            ]
        );
        $repeater->add_control( 'slider_title',
            [
                'label' => esc_html__( 'Title', 'wavo' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Slider Title',
                'pleaceholder' => esc_html__( 'Enter title here', 'wavo' )
            ]
        );
        $repeater->add_control( 'disable_stroke',
            [
                'label' => esc_html__( 'Default Text Style', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $repeater->add_control( 'slider_desc',
            [
                'label' => esc_html__( 'Description', 'wavo' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'pleaceholder' => esc_html__( 'Enter description here', 'wavo' )
            ]
        );
        $repeater->add_control( 'slider_btn_title',
            [
                'label' => esc_html__( 'Button Title', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Shop Now',
                'pleaceholder' => esc_html__( 'Enter button title here', 'wavo' )
            ]
        );
        $repeater->add_control( 'slider_btn_link',
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
        $repeater->add_responsive_control( 'overlay',
            [
                'label' => esc_html__( 'Overlay Dark Size', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 9,
                'step' => 1,
                'default' => 3
            ]
        );
        $repeater->add_control( 'delay',
            [
                'label' => esc_html__( 'Slide Item Autoplay Delay', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 20000,
                'step' => 100,
                'default' => '',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'slider_items',
            [
                'label' => esc_html__( 'Slide Items', 'wavo' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{slider_title}}',
                'default' => [
                    [
                        'slider_image' => ['url' => $def_image],
                        'slider_title' => 'From <span class="stroke">The</span><br> <span class="stroke">Inside</span> Out',
                        'slider_btn_title' => 'Discover Work',
                        'slider_btn_link' => '#0'
                    ],
                    [
                        'slider_image' => ['url' => $def_image],
                        'slider_title' => 'Luxury <br> <span class="stroke">Real</span>Estate',
                        'slider_btn_title' => 'Discover Work',
                        'slider_btn_link' => '#0'
                    ],
                    [
                        'slider_image' => ['url' => $def_image],
                        'slider_title' => 'Classic <br> <span class="stroke">&</span>Modern',
                        'slider_btn_title' => 'Discover Work',
                        'slider_btn_link' => '#0'
                    ],
                    [
                        'slider_image' => ['url' => $def_image],
                        'slider_title' => 'Explore <br> <span class="stroke">The</span>World',
                        'slider_btn_title' => 'Discover Work',
                        'slider_btn_link' => '#0'
                    ]
                ]
            ]
        );
        $this->add_control( 'home_slider_social_heading',
            [
                'label' => esc_html__( 'SOCIAL MEDIA', 'awam' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'social_type',
            [
                'label' => esc_html__( 'Social Media Type', 'awam' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'text',
                'options' => [
                    'text' => esc_html__( 'Text', 'awam' ),
                    'icon' => esc_html__( 'Icon', 'awam' )
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
                'label' => esc_html__( 'Socials', 'awam' ),
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

        $this->start_controls_section( 'home_slider_section',
            [
                'label' => esc_html__( 'Slider Options', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT
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
                'default' => 'yes',
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
        $this->add_control( 'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'loop',
            [
                'label' => esc_html__( 'Loop', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
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
        $this->add_control( 'home_slider_title_heading',
            [
                'label' => esc_html__( 'HEADING', 'wavo' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->wavo_style_color( 'home_slider_heading_color', '{{WRAPPER}} .swiper-slide .slider_hero_title' );
        $this->add_control( 'home_slider_heading_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide .slider_hero_title:not(.splitting) a:hover' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .swiper-slide .slider_hero_title.splitting a:hover > span:not(.stroke) span' => 'color:{{VALUE}};'
                ]
            ]
        );
        $this->add_control( 'home_slider_stroked_heading_color',
            [
                'label' => esc_html__( 'Stroked Text Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slider .parallax-slider .caption .slider_hero_title .stroke span' => 'stroke-color:{{VALUE}};' ],
            ]
        );
        $this->wavo_style_typo( 'home_slider_heading_typo', '{{WRAPPER}} .swiper-slide .slider_hero_title' );
        $this->add_control( 'home_slider_heading_heading',
            [
                'label' => esc_html__( 'DESCRIPTION', 'wavo' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->wavo_style_color( 'home_slider_desc_color', '{{WRAPPER}} .swiper-slide .slider_hero_desc' );
        $this->wavo_style_typo( 'home_slider_desc_typo', '{{WRAPPER}} .swiper-slide .slider_hero_desc' );
        $this->wavo_style_text_alignment( 'home_slider_heading_alignment', '{{WRAPPER}} .swiper-slide .caption' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   END CONTROLS SECTION   ******/
        $this->start_controls_section( 'home_slider_btn_style_section',
            [
                'label' => esc_html__( 'Button', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->wavo_style_color( 'home_slider_btn_color', '{{WRAPPER}} .swiper-slide .dis' );
        $this->wavo_style_typo( 'home_slider_btn_typo', '{{WRAPPER}} .swiper-slide .dis' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('home_slider_nav_style_section',
            [
                'label'=> esc_html__( 'Nav Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->start_controls_tabs( 'home_slider_nav_tabs');
        $this->start_controls_tab( 'home_slider_nav_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'wavo' ) ]
        );

		$this->wavo_style_bgcolor( 'home_slider_nav_background','{{WRAPPER}} .slide-controls .swiper-button-next, {{WRAPPER}} .slide-controls .swiper-button-prev' );
		$this->wavo_style_color( 'home_slider_color','{{WRAPPER}} .slide-controls .swiper-button-next, {{WRAPPER}} .slide-controls .swiper-button-prev' );
        $this->wavo_style_border( 'home_slider_border','{{WRAPPER}} .slide-controls .swiper-button-next, {{WRAPPER}} .slide-controls .swiper-button-prev' );
        $this->add_control( 'home_slider_line_color',
            [
                'label' => esc_html__( 'Line Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slide-controls .swiper-button-next i:after, .slide-controls .swiper-button-prev i:after' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab( 'home_slider_nav_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wavo' ) ]
        );

		$this->wavo_style_bgcolor( 'home_slider_nav_hvr_background','{{WRAPPER}} .slide-controls .swiper-button-next:hover, {{WRAPPER}} .slide-controls .swiper-button-prev:hover' );
		$this->wavo_style_color( 'home_slider_hvr_color','{{WRAPPER}} .slide-controls .swiper-button-next:hover, {{WRAPPER}} .slide-controls .swiper-button-prev:hover' );
        $this->wavo_style_border( 'home_slider_hvr_border','{{WRAPPER}} .slide-controls .swiper-button-next:hover, {{WRAPPER}} .slide-controls .swiper-button-prev:hover' );
        $this->add_control( 'home_slider_line_hvr_color',
            [
                'label' => esc_html__( 'Line Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slide-controls .swiper-button-next:hover i:after, .slide-controls .swiper-button-prev:hover i:after' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control( 'home_slider_prev_heading',
            [
                'label' => __( 'PREV POSITION', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'home_slider_prev_horizontal',
            [
                'label' => esc_html__( 'Horizontal Position ( % )', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slide-controls .swiper-button-prev' => 'left:{{SIZE}}%;' ],
            ]
        );
        $this->add_responsive_control( 'home_slider_prev_vertical',
            [
                'label' => esc_html__( 'Vertical Position ( % )', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slide-controls .swiper-button-prev' => 'top:{{SIZE}}%;' ],
            ]
        );
        $this->add_control( 'home_slider_next_heading',
            [
                'label' => __( 'NEXT POSITION', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'home_slider_next_horizontal',
            [
                'label' => esc_html__( 'Horizontal Position ( % )', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slide-controls .swiper-button-next' => 'left:{{SIZE}}%;' ],
            ]
        );
        $this->add_responsive_control( 'home_slider_next_vertical',
            [
                'label' => esc_html__( 'Vertical Position ( % )', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .slide-controls .swiper-button-next' => 'top:{{SIZE}}%;' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $settingsid = $this->get_id();

        $speed      = $settings['speed'] ? $settings['speed'] : 1000;
        $parallax   = 'yes' == $settings['parallax'] ? 'true' : 'false';
        $mobparallax= 'yes' == $settings['mobparallax'] ? 'true' : 'false';
        $autoplay   = 'yes' == $settings['autoplay'] ? 'true' : 'false';
        $loop       = 'yes' == $settings['loop'] ? 'true' : 'false';

        $count1 = 1;
        $count2 = 1;
        $tablet = array();
        $phone = array();

        foreach ( $settings['slider_items'] as $item ) {
            if( !empty( $item['slider_image_768']['url'] ) ){
                $tablet[] .= '.slider-id-'.$settingsid.' .bg-img.slide-item-'.$count1.'{background-image:url('.$item['slider_image_768']['url'].')!important;}';
            }
            $count1++;
        }
        foreach ( $settings['slider_items'] as $item ) {
            if( !empty( $item['slider_image_576']['url'] ) ){
                $phone[] .= '.slider-id-'.$settingsid.' .bg-img.slide-item-'.$count2.'{background-image:url('.$item['slider_image_576']['url'].')!important;}';
            }
            $count2++;
        }
        if( !empty( $tablet ) || !empty( $phone ) ){
            echo '<style>';
                if( !empty( $tablet ) ){
                    echo '@media(max-width:768px){';
                        echo implode('', $tablet);
                    echo '}';
                }
                if( !empty( $phone ) ){
                    echo '@media(max-width:576px){';
                        echo implode( '', $phone );
                    echo '}';
                }
            echo '</style>';
        }

        echo '<div class="slider home-slider '.$settings['slider_position'].'-slider slide-controls slider-id-'.$settingsid.'" data-slider-settings=\'{"autoplay":'.$autoplay.',"parallax":'.$parallax.',"mobparallax":'.$mobparallax.',"loop":'.$loop.',"speed":'.$speed.'}\'>';
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
            echo '<div class="swiper-container parallax-slider">';
                echo '<div class="swiper-wrapper">';
                    $countt = 1;
                    foreach ( $settings['slider_items'] as $item ) {
                        $res_tablet = !empty( $item['slider_image_768']['url'] ) ? $item['slider_image_768']['url'] : '';
                        $res_phone = !empty( $item['slider_image_576']['url'] ) ? $item['slider_image_576']['url'] : '';
                        $bgimg = ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) ? 'style="background-image:url('.$item['slider_image']['url'].');"' : 'data-wavo-background="'.$item['slider_image']['url'].'"';
                        $target = $item['slider_btn_link']['is_external'] ? ' target="_blank"' : '';
                        $nofollow = $item['slider_btn_link']['nofollow'] ? ' rel="nofollow"' : '';
                        $deftitle = 'yes' == $item['disable_stroke'] ? ' clasc' : '';
                        $delay = 'yes' == $settings['autoplay'] && $item['delay'] ? ' data-swiper-autoplay="'.$item['delay'].'"' : '';
                        echo '<div class="swiper-slide"'.$delay.'>';
                            echo '<div class="bg-img valign slide-item-'.$countt.'" '.$bgimg.' data-overlay-dark="'.$item['overlay'].'" data-responsive-img=\'{"phone":"'.$res_phone.'","tablet":"'.$res_tablet.'"}\'>';
                                echo '<div class="container">';
                                    echo '<div class="row">';
                                        echo '<div class="col-lg-10 offset-lg-1">';
                                            echo '<div class="caption'.$deftitle.'">';
                                                if( $item['slider_title'] ){
                                                    if( $item['slider_btn_link']['url'] ){
                                                        echo '<h1 class="slider_hero_title" data-splitting><a href="'.$item['slider_btn_link']['url'].'"'.$target.$nofollow.'>'.$item['slider_title'].'</a></h1>';
                                                    } else {
                                                        echo '<h1 class="slider_hero_title" data-splitting>'.$item['slider_title'].'</h1>';
                                                    }
                                                }
                                                if( $item['slider_desc'] ){
                                                    echo '<p class="slider_hero_desc">'.$item['slider_desc'].'</p>';
                                                }
                                                if( $item['slider_btn_title'] ){
                                                    $splitting = 'dis' == $item['btn_type'] ? ' data-splitting' : '';
                                                    echo '<a href="'.$item['slider_btn_link']['url'].'" '.$target.$nofollow.' class="'.$item['btn_type'].'" '.$splitting.'>'.$item['slider_btn_title'].'</a>';
                                                }
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                        $countt++;
                    }

                echo '</div>';

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
                echo '<div class="swiper-button-next swiper-nav-ctrl next-ctrl"><i class="fas fa-caret-right"></i></div>
                <div class="swiper-button-prev swiper-nav-ctrl prev-ctrl"><i class="fas fa-caret-left"></i></div>
                <div class="swiper-pagination"></div>';

            echo '</div>';
        echo '</div>';
    }
}
