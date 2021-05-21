<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wavo_Project_Next extends Widget_Base {
    use Wavo_Helper;
    public function get_name() {
        return 'wavo-project-next';
    }
    public function get_title() {
        return 'Project Next Post (N)';
    }
    public function get_icon() {
        return 'eicon-image';
    }
    public function get_categories() {
        return [ 'wavo-cpt' ];
    }
    public function get_style_depends() {
        return [ 'splitting','splitting-cells' ];
    }
    public function get_script_depends() {
        return [ 'splitting' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'wavo_project_next_settings',
            [
                'label' => esc_html__('Projects Next Post', 'wavo'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'use_post_data',
            [
                'label' => esc_html__( 'Use Post Data ( Title / Permalink )', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Text Before Post Title', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Next Projects',
                'label_block' => true
            ]
        );
        $this->add_control( 'next_post_title',
            [
                'label' => esc_html__( 'Post Title', 'wavo' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => $this->wavo_cpt_get_next_post_title(),
                'label_block' => true,
                'condition' => ['use_post_data!' => 'yes']
            ]
        );
        $this->add_control( 'link',
            [
                'label' => esc_html__( 'Link', 'wavo' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => $this->wavo_cpt_get_next_post_permalink(),
                    'is_external' => ''
                ],
                'show_external' => true,
                'condition' => ['use_post_data!' => 'yes']
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section( 'wavo_project_next_bg_style',
            [
                'label' => esc_html__( 'Background', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'bg_type',
            [
                'label' => esc_html__( 'Background Type', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => 'true',
                'default' => 'image',
                'options' => [
                    'image' => esc_html__( 'Custom Image', 'wavo' ),
                    'thumb' => esc_html__( 'Post Tumbnail', 'wavo' ),
                    'bg' => esc_html__( 'Custom Background', 'wavo' )
                ]
            ]
        );
        $this->add_control( 'image',
            [
                'label' => esc_html__( 'Image', 'wavo' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => plugins_url( 'assets/front/img/1.jpg', __DIR__ )],
                'condition' => ['bg_type' => 'image']
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'project_next_bg',
                'label' => esc_html__( 'Background', 'wavo' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .nxt-img.bg-img',
                'condition' => ['bg_type' => 'bg']
            ]
        );
        $this->add_control( 'hide_overlay',
            [
                'label' => esc_html__( 'Hide Overlay Color', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'project_next_overlay',
            [
                'label' => esc_html__( 'Background Overlay Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .call-action.next:before' => 'background-color:{{VALUE}};' ],
                'condition' => [ 'hide_overlay!' => 'yes' ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section( 'wavo_project_next_title_style',
            [
                'label' => esc_html__( 'Text Before Post Title', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['title!' => '']
            ]
        );
        $this->wavo_style_typo( 'project_text_typo','{{WRAPPER}} .call-action.next .content h6' );
        $this->add_control( 'project_text_color',
            [
                'label' => esc_html__( 'Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .call-action.next .content h6' => 'color:{{VALUE}};' ]
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section( 'wavo_project_next_desc_style',
            [
                'label' => esc_html__( 'Next Post Title', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->wavo_style_typo( 'project_next_title_typo','{{WRAPPER}} .call-action.next .content h2' );
        $this->add_control( 'project_next_title_color',
            [
                'label' => esc_html__( 'Filled Text Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .call-action.next .content h2 > b.filled' => 'color:{{VALUE}};-webkit-text-stroke-color:{{VALUE}};-webkit-text-stroke-width:0;' ]
            ]
        );
        $this->add_control( 'project_next_title_otline_color',
            [
                'label' => esc_html__( 'Stroked Text Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .call-action.next .content h2' => '-webkit-text-stroke-color:{{VALUE}};' ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'project_next_title_otline_width',
            [
                'label' => esc_html__( 'Stroke Width', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .call-action.next .content h2' => '-webkit-text-stroke-width:{{SIZE}}px;' ],
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {
        $settings   = $this->get_settings_for_display();
        $hide_overlay = 'yes' == $settings['hide_overlay'] ? ' overlay-none' : '';

        $args = array('post_type'=>'projects', 'posts_per_page' => -1);
        $posts = get_posts($args);
        $last_id = end($posts);

        if ( 'yes' == $settings['use_post_data'] ) {

            $last_title = get_the_title( $last_id->ID );
            $last_link = get_permalink( $last_id->ID );
            $link       = $this->wavo_cpt_get_next_post_permalink() ? $this->wavo_cpt_get_next_post_permalink() : $last_link;
            $next_title = $this->wavo_cpt_get_next_post_title() ? $this->wavo_cpt_get_next_post_title() : $last_title;
            $word_count = !empty($next_title) ? explode(' ',trim($next_title)) : '';
            $title      = is_array( $word_count ) && !empty($word_count[0]) ? str_replace ( $word_count[0], '<b class="filled">'.$word_count[0].'</b>', $next_title ) : '';
        } else {
            $link       = $settings['link']['url'] ? $settings['link']['url'] : $this->wavo_cpt_get_next_post_permalink();
            $word_count = !empty($settings['next_post_title']) ? explode(' ',trim($settings['next_post_title'])) : '';
            $title      = is_array( $word_count ) && !empty($word_count[0]) ? str_replace ( $word_count[0], '<b class="filled">'.$word_count[0].'</b>', $settings['next_post_title'] ) : $settings['next_post_title'];
        }

        $next_post = get_next_post();
        if ( 'thumb' == $settings['bg_type'] && ! empty( $next_post ) ) {
            $imageurl = get_the_post_thumbnail_url( $next_post->ID,'full' );
        }
        if ( 'thumb' == $settings['bg_type'] && empty( $next_post ) ) {
            $imageurl = get_the_post_thumbnail_url( $last_id->ID,'full' );
        }
        if ( 'image' == $settings['bg_type'] && !empty( $next_post ) && !empty( $settings['image']['url'] ) ) {
            $imageurl = $settings['image']['url'];
        }
        if ( 'bg' == $settings['bg_type'] && !empty( $settings['project_next_bg_image']['url'] ) ) {
            $imageurl = $settings['project_next_bg_image']['url'];
        }

        echo '<div class="call-action nogif next'.$hide_overlay.'">';
            echo '<div class="container">';
                echo '<div class="row">';
                    echo '<div class="col-md-12">';
                        echo '<div class="content text-center">';
                            echo '<a href="'.$link.'">';
                                if ( $settings['title'] ) {
                                    echo '<h6 class="wow" data-splitting>'.$settings['title'].'</h6>';
                                }
                                if ( $title ) {
                                    echo '<h2 class="wow" data-splitting>'.$title.'</h2>';
                                }
                            echo '</a>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

            if ( $imageurl ) {
                $bgimage = '';
                if ( 'bg' != $settings['bg_type'] ) {
                    $bgimage = \Elementor\Plugin::$instance->editor->is_edit_mode() ? ' style="background-image:url('.$imageurl.');"' : ' data-wavo-background="'.$imageurl.'"';
                }
                echo '<div class="nxt-img bg-img"'.$bgimage.'></div>';
            }

        echo '</div>';
    }
}
