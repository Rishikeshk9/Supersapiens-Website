<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wavo_About_Two_Images extends Widget_Base {
    use Wavo_Helper;
    public function get_name() {
        return 'wavo-about-two-images';
    }
    public function get_title() {
        return 'Two Images (N)';
    }
    public function get_icon() {
        return 'eicon-image';
    }
    public function get_categories() {
        return [ 'wavo' ];
    }
    public function get_script_depends() {
        return [ 'simple-parallax' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'wavo_about_two_images_settings',
            [
                'label' => esc_html__('Two Parallax Images', 'wavo'),
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
                    '2' => esc_html__( 'Type 2', 'wavo' )
                ]
            ]
        );
        $this->add_control( 'image1',
            [
                'label' => esc_html__( 'Image 1', 'wavo' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => plugins_url( 'assets/front/img/1.jpg', __DIR__ )],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'full',
                'condition' => [ 'image1[url]!' => '' ],
            ]
        );
        $this->add_control( 'image2',
            [
                'label' => esc_html__( 'Image 2', 'wavo' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => plugins_url( 'assets/front/img/2.jpg', __DIR__ )],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail2',
                'default' => 'full',
                'condition' => [ 'image2[url]!' => '' ],
            ]
        );
        $this->add_control( 'icon',
            [
                'label' => esc_html__('Icon', 'wavo'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-home',
                    'library' => 'fa-solid'
                ],
                'condition' => ['type' => '1']
            ]
        );
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'default' => '28',
                'label_block' => true
            ]
        );
        $this->add_control( 'desc',
            [
                'label' => esc_html__( 'Description', 'wavo' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Years Of Experience',
                'label_block' => true
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section( 'wavo_services_title_style',
            [
                'label' => esc_html__( 'Title', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['title!' => '']
            ]
        );
        $this->wavo_style_controls(array('shadow'),$id='services_title',$selector='.agency .imgsec .exp .nmb-font, {{WRAPPER}} .agency .img .exp .nmb-font');
        $this->end_controls_section();

        $this->start_controls_section( 'wavo_services_desc_style',
            [
                'label' => esc_html__( 'Description', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['desc!' => '']
            ]
        );
        $this->wavo_style_controls(array('shadow'),$id='services_desc',$selector='.agency .imgsec .exp h6, {{WRAPPER}} .agency .img .exp h6');
        $this->end_controls_section();

        $this->start_controls_section( 'wavo_services_icon_style',
            [
                'label' => esc_html__( 'Icon', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control( 'icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 60
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .agency .img .icon' => 'font-size: {{SIZE}}px;'],
            ]
        );
        $this->add_control( 'icon_color',
            [
                'label' => esc_html__( 'Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .agency .img .icon' => 'color: {{VALUE}};']
            ]
        );
        $this->add_control( 'icon_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .agency .img .icon' => 'background-color: {{VALUE}};']
            ]
        );
        $this->add_control( 'icon_bgcolor2',
            [
                'label' => esc_html__( 'Background 2 Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .agency .img .icon:after' => 'background-color: {{VALUE}};']
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {
        $settings   = $this->get_settings_for_display();

        $image      = $this->get_settings( 'image1' );
        $image_url  = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumbnail', $settings );
        $imagealt   = esc_attr(get_post_meta($image['id'], '_wp_attachment_image_alt', true));
        $imagealt   = $imagealt ? $imagealt : basename ( get_attached_file( $image['id'] ) );
        $imageurl   = empty( $image_url ) ? $image['url'] : $image_url;

        $image2      = $this->get_settings( 'image2' );
        $image_url2  = Group_Control_Image_Size::get_attachment_image_src( $image2['id'], 'thumbnail2', $settings );
        $imagealt2   = esc_attr(get_post_meta($image2['id'], '_wp_attachment_image_alt', true));
        $imagealt2   = $imagealt2 ? $imagealt2 : basename ( get_attached_file( $image2['id'] ) );
        $imageurl2   = empty( $image_url2 ) ? $image2['url'] : $image_url2;

        echo '<div class="agency">';
            if ( '1' == $settings['type'] ) {
                echo '<div class="img">';
                    if ( $imageurl2 ) {
                        echo '<div class="imgone" data-wow-delay=".3s">';
                            echo '<img class="thumparallax" src="'.$imageurl.'" alt="'.$imagealt.'"/>';
                        echo '</div>';
                    }
                    if ( $imageurl2 ) {
                        echo '<div class="imgtwo" data-wow-delay=".2s">';
                            echo '<img class="thumparallax-down" src="'.$imageurl2.'" alt="'.$imagealt.'"/>';
                        echo '</div>';
                    }
                    if ( ! empty($settings['icon']['value']) ) {
                        echo '<span class="icon wow fadeIn" data-wow-delay=".1s">';
                            Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
                        echo '</span>';
                    }
                    if ( $settings['title'] || $settings['desc'] ) {
                        echo '<div class="exp">';
                            if ( $settings['title'] ) {
                                echo '<h2 class="nmb-font">'.$settings['title'].'</h2>';
                            }
                            if ( $settings['desc'] ) {
                                echo '<h6>'.$settings['desc'].'</h6>';
                            }
                        echo '</div>';
                    }
                echo '</div>';

            } else {

                echo '<div class="imgsec">';
                    echo '<div class="row">';
                        if ( $imageurl2 ) {
                        echo '<div class="col-md-6">';
                        } else {
                        echo '<div class="col-md-12">';
                        }
                            echo '<div class="item">';
                                echo '<div class="imgone big-bord" data-wow-delay=".3s">';
                                    echo '<img class="thumparallax-down lazyload" src="'.$imageurl.'" alt="'.$imagealt.'"/>';
                                echo '</div>';
                                if ( $settings['title'] || $settings['desc'] ) {
                                    echo '<div class="exp">';
                                        if ( $settings['title'] ) {
                                            echo '<h2 class="nmb-font">'.$settings['title'].'</h2>';
                                        }
                                        if ( $settings['desc'] ) {
                                            echo '<h6 class="service_summary">'.$settings['desc'].'</h6>';
                                        }
                                    echo '</div>';
                                }
                            echo '</div>';
                        echo '</div>';

                        if ( $imageurl2 ) {
                            if ( $imageurl ) {
                            echo '<div class="col-md-6">';
                            } else {
                            echo '<div class="col-md-12">';
                            }
                                echo '<div class="item">';
                                    echo '<div class="imgtwo big-bord" data-wow-delay=".2s">';
                                        echo '<img class="thumparallax" src="'.$imageurl2.'" alt="'.$imagealt.'"/>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        }
                    echo '</div>';
                echo '</div>';
            }
        echo '</div>';

    }
}
