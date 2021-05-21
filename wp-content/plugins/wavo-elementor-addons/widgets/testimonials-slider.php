<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wavo_Testimonials extends Widget_Base {
    use Wavo_Helper;
    public function get_name() {
        return 'wavo-testimonials';
    }
    public function get_title() {
        return 'Testimonials Carousel (N)';
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
        $this->start_controls_section( 'wavo_testimonials_settings',
            [
                'label' => esc_html__('General', 'wavo'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Section Title', 'wavo' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Testimonials',
                'label_block' => true,
            ]
        );
        $this->add_control( 'title_type',
            [
                'label' => esc_html__( 'Title Type', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => 'true',
                'default' => '1',
                'options' => [
                    '1' => esc_html__( 'Type 1', 'wavo' ),
                    '2' => esc_html__( 'Type 2', 'wavo' )
                ],
                'condition' => [ 'title!' => '' ],
            ]
        );
        $this->add_control( 'quote_icon',
            [
                'label' => esc_html__( 'Quote Image', 'wavo' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => plugins_url( 'assets/front/img/quote.svg', __DIR__ )],
            ]
        );
        $this->add_control( 'speed',
            [
                'label' => esc_html__( 'Speed', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 5000,
                'step' => 100,
                'default' => 300,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control( 'arrows',
            [
                'label' => esc_html__( 'Arrows', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control( 'fade',
            [
                'label' => esc_html__( 'Fade', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'wavo_testimonials_one_items_settings',
            [
                'label' => esc_html__('Testimonials Items', 'wavo'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'testi_name',
            [
                'label' => esc_html__( 'Name', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Sam Peters',
                'label_block' => true,
            ]
        );
        $repeater->add_control( 'testi_pos',
            [
                'label' => esc_html__( 'Position', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'CEO Solar Systems LLC',
                'label_block' => true,
            ]
        );
        $repeater->add_control( 'testi_text',
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
        $repeater->add_control( 'testi_image',
            [
                'label' => esc_html__( 'Avatar', 'wavo' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => $def_img],
            ]
        );
        $this->add_control( 'testi_items',
            [
                'label' => esc_html__( 'Items', 'wavo' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{testi_name}}',
                'default' => [
                    [
                        'testi_name' => 'Alex Martin',
                        'testi_pos' => 'Envato Customer',
                        'testi_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel purus fringilla, lobortis libero ut, interdum lacus. Ut quis urna sollicitudin, iaculis dolor sed, sodales mi. Proin a velit convallis, fermentum orci in, rutrum diam. Duis elementum odio a pharetra commodo. Sed eget massa sit amet nunc egestas tristique.'
                    ],
                    [
                        'testi_name' => 'Terry Figueroa',
                        'testi_pos' => 'Marketing Manager',
                        'testi_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel purus fringilla, lobortis libero ut, interdum lacus. Ut quis urna sollicitudin, iaculis dolor sed, sodales mi. Proin a velit convallis, fermentum orci in, rutrum diam. Duis elementum odio a pharetra commodo. Sed eget massa sit amet nunc egestas tristique.'
                    ],
                    [
                        'testi_name' => 'Kaycee Hess',
                        'testi_pos' => 'Human Resources',
                        'testi_text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras vel purus fringilla, lobortis libero ut, interdum lacus. Ut quis urna sollicitudin, iaculis dolor sed, sodales mi. Proin a velit convallis, fermentum orci in, rutrum diam. Duis elementum odio a pharetra commodo. Sed eget massa sit amet nunc egestas tristique.'
                    ]
                ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('testi_haeding_style_section',
            [
                'label'=> esc_html__( 'Heading Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->wavo_style_typo( 'testi_title_typo','{{WRAPPER}} .testimonials .title h5, {{WRAPPER}} .testimonials.no-bg .text-bg' );
        $this->add_control( 'testi_title_color',
            [
                'label' => esc_html__( 'Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .testimonials .title h5' => 'color:{{VALUE}};' ]
            ]
        );
        $this->add_responsive_control( 'testi_title_horizontal',
            [
                'label' => esc_html__( 'Horizontal Position ( % )', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => -100,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .testimonials .title h5, {{WRAPPER}} .testimonials.no-bg .text-bg' => 'left:{{SIZE}}%;' ]
            ]
        );
        $this->add_responsive_control( 'testi_title_vertical',
            [
                'label' => esc_html__( 'Vertical Position ( % )', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => -100,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .testimonials .title h5, {{WRAPPER}} .testimonials.no-bg .text-bg' => 'top:{{SIZE}}px;' ]
            ]
        );
        $this->add_control( 'testi_title_otline_color',
            [
                'label' => esc_html__( 'Stroke Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .testimonials.no-bg .text-bg' => '-webkit-text-stroke-color:{{VALUE}};' ],
                'separator' => 'before',
                'condition' => [ 'title_type' => '2' ]
            ]
        );
        $this->add_responsive_control( 'testi_title_otline_width',
            [
                'label' => esc_html__( 'Stroke Width', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .testimonials .title h5, {{WRAPPER}} .testimonials.no-bg .text-bg' => '-webkit-text-stroke-width:{{SIZE}}px;' ],
                'condition' => [ 'title_type' => '2' ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('testi_quote_style_section',
            [
                'label'=> esc_html__( 'Quote Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->wavo_style_typo( 'testi_quote_typo','{{WRAPPER}} .testimonials p' );
        $this->wavo_style_color( 'testi_quote_typo','{{WRAPPER}} .testimonials p' );
        $this->wavo_style_padding( 'testi_quote_padding','{{WRAPPER}} .testimonials p' );
        $this->wavo_style_margin( 'testi_quote_margin','{{WRAPPER}} .testimonials p' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('testi_name_style_section',
            [
                'label'=> esc_html__( 'Name Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->wavo_style_typo( 'testi_name_typo','{{WRAPPER}} .testimonials h6' );
        $this->wavo_style_color( 'testi_name_typo','{{WRAPPER}} .testimonials h6' );
        $this->wavo_style_padding( 'testi_name_padding','{{WRAPPER}} .testimonials h6' );
        $this->wavo_style_margin( 'testi_name_margin','{{WRAPPER}} .testimonials h6' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('testi_job_style_section',
            [
                'label'=> esc_html__( 'Job / Position Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->wavo_style_typo( 'testi_job_typo','{{WRAPPER}} .testimonials h6 span' );
        $this->wavo_style_color( 'testi_job_typo','{{WRAPPER}} .testimonials h6 span' );
        $this->wavo_style_padding( 'testi_job_padding','{{WRAPPER}} .testimonials h6 span' );
        $this->wavo_style_margin( 'testi_job_margin','{{WRAPPER}} .testimonials h6 span' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('testi_img_style_section',
            [
                'label'=> esc_html__( 'Image Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wavo_style_slider_width( 'testi_avatar_width',array( '{{WRAPPER}} .testimonials .author' => 'width: {{SIZE}}px' ), $min=0, $max=500, $unit='px' );
        $this->wavo_style_slider_height( 'testi_avatar_height',array( '{{WRAPPER}} .testimonials .author' => 'height: {{SIZE}}px' ), $min=0, $max=500, $unit='px' );
        $this->wavo_style_border( 'testi_avatar_border','{{WRAPPER}} .testimonials .author' );
        $this->wavo_style_box_shadow( 'testi_avatar_border','{{WRAPPER}} .testimonials .author' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('testi_box_nav_style_section',
            [
                'label'=> esc_html__( 'Nav Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wavo_style_slider_width( 'testi_navs_width',array( '{{WRAPPER}} .testimonials .navs span' => 'width: {{SIZE}}px' ), $min=0, $max=200, $unit='px' );
        $this->wavo_style_slider_height( 'testi_navs_height',array( '{{WRAPPER}} .testimonials .navs span' => 'height: {{SIZE}}px' ), $min=0, $max=200, $unit='px' );

        $this->start_controls_tabs( 'testi_navs_tabs');
        $this->start_controls_tab( 'testi_navs_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'wavo' ) ]
        );

		$this->wavo_style_background( 'testi_navs_background','{{WRAPPER}} .testimonials .navs span',array( 'classic','gradient' ) );
        $this->wavo_style_border( 'testi_navs_border','{{WRAPPER}} .testimonials .navs span' );
        $this->end_controls_tab();

        $this->start_controls_tab( 'testi_navs_hover_tab',
            [ 'label' => esc_html__( 'Hover / Active', 'wavo' ) ]
        );
		$this->wavo_style_background( 'testi_navs_hvr_background','{{WRAPPER}} .testimonials .navs span:hover',array( 'classic','gradient' ) );
        $this->wavo_style_border( 'testi_navs_hvr_border','{{WRAPPER}} .testimonials .navs span:hover' );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('testi_after_style_section',
            [
                'label'=> esc_html__( 'Half Background Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->add_control( 'testi_after_width',
            [
                'label' => esc_html__( 'Half Background Width ( % )', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [ '%' => [ 'min' => 0,'max' => 100 ] ],
                'selectors' => ['{{WRAPPER}} .testimonials:after' => 'width:{{SIZE}}%',]
            ]
        );
        $this->add_control( 'testi_after_top',
            [
                'label' => esc_html__( 'Half Background Top Offset ( px )', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [ 'px' => [ 'min' => -100,'max' => 100 ] ],
                'selectors' => ['{{WRAPPER}} .testimonials:after' => 'top:{{SIZE}}%',]
            ]
        );
        $this->add_control( 'testi_after_bottom',
            [
                'label' => esc_html__( 'Half Background Bottom Offset ( px )', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [ 'px' => [ 'min' => -100,'max' => 100 ] ],
                'selectors' => ['{{WRAPPER}} .testimonials:after' => 'bottom:{{SIZE}}%',]
            ]
        );
        $this->wavo_style_background( 'testi_after_background','{{WRAPPER}} .testimonials:after',array( 'classic','gradient' ) );
        $this->wavo_style_border( 'testi_after_border','{{WRAPPER}} .testimonials:after' );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'testi_after_shadow',
                'label' => esc_html__( 'Box shadow', 'wavo' ),
                'selector' => '{{WRAPPER}} .testimonials:after',
                'separator' => 'before'
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        $testibg = '2' == $settings['title_type'] ? ' no-bg' : '';
        $autoplay = 'yes' == $settings['autoplay'] ? 'true' : 'false';
        $arrows = 'yes' == $settings['arrows'] ? 'true' : 'false';
        $fade = 'yes' == $settings['fade'] ? 'true' : 'false';
        echo '<div class="testimonials'.$testibg.'" data-slider-settings=\'{"autoplay":'.$autoplay.',"arrows":'.$arrows.',"fade":'.$fade.',"speed":'.$settings['speed'].'}\'>';
            if ( '2' == $settings['title_type']  && $settings['title'] ) {
                echo '<div class="text-bg">'.$settings['title'].'</div>';
            }
            echo '<div class="container">';
                if ( '1' == $settings['title_type']  && $settings['title'] ) {
                    echo '<div class="title">';
                        echo '<h5 class="wow" data-splitting>'.$settings['title'].'</h5>';
                    echo '</div>';
                }

                echo '<div class="row">';
                    echo '<div class="col-lg-3 offset-lg-1 positive-r">';
                        echo '<div class="slider-for">';

                            foreach ($settings['testi_items'] as $item) {
                                $timagealt = esc_attr(get_post_meta($item['testi_image']['id'], '_wp_attachment_image_alt', true));
                                $timagealt = $timagealt ? $timagealt : basename ( get_attached_file( $item['testi_image']['id'] ) );
                                $image = Group_Control_Image_Size::get_attachment_image_src( $item['testi_image']['id'], 'thumbnail', $settings );

                                echo '<div class="info">';
                                    if ($item['testi_image']['url']) {
                                        echo '<div class="author"><img class="testi-img" src="'.$image.'" alt="'.$timagealt.'"></div>';
                                    }
                                    if ( $item['testi_name'] ) {
                                        $testipos = $item['testi_pos'] ? ' <span class="testi-pos">'.$item['testi_pos'].'</span>' : '';
                                        echo '<h6 class="testi-name">'.$item['testi_name'].' '.$testipos.' </h6>';
                                    }
                                echo '</div>';
                            }

                        echo '</div>';
                        if ( 'yes' == $settings['arrows'] || 'yes' != $settings['autoplay'] ) {
                            echo '<div class="navs">';
                                echo '<span class="next"><i class="ion-ios-arrow-right"></i></span>';
                                echo '<span class="prev"><i class="ion-ios-arrow-left"></i></span>';
                            echo '</div>';
                        }
                    echo '</div>';

                    echo '<div class="col-lg-8 quote-text">';
                        echo '<div class="slider-nav">';
                            foreach ($settings['testi_items'] as $item) {
                                echo '<div class="item">';
                                    echo '<div class="cont">';
                                        if ( $item['testi_text'] ) {
                                            echo '<p  class="testi-text">'.$item['testi_text'].'</p>';
                                        }
                                    echo '</div>';
                                echo '</div>';
                            }

                        echo '</div>';
                        if ( $settings['quote_icon']['url'] ) {
                            $timagealt = esc_attr(get_post_meta( $settings['quote_icon']['id'], '_wp_attachment_image_alt', true));
                            $timagealt = $timagealt ? $timagealt : basename ( get_attached_file( $settings['quote_icon']['id'] ) );
                            echo '<span class="quote-icon "><img src="'.$settings['quote_icon']['url'].'" alt="'.$timagealt.'"></span>';
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';

    }
}
