<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wavo_Team_Member extends Widget_Base {
    use Wavo_Helper;
    public function get_name() {
        return 'wavo-team-member';
    }
    public function get_title() {
        return 'Team Member (N)';
    }
    public function get_icon() {
        return 'eicon-person';
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
        $this->start_controls_section( 'wavo_team_member_section',
            [
                'label' => esc_html__( 'Team Content', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'team_name',
            [
                'label' => esc_html__( 'Name', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'pleaceholder' => esc_html__( 'Enter name here', 'wavo' ),
                'default' => 'Alex Smith',
                'label_block' => true,
            ]
        );
        $this->add_control( 'team_pos',
            [
                'label' => esc_html__( 'Position', 'wavo' ),
                'type' => Controls_Manager::TEXTAREA,
                'pleaceholder' => esc_html__( 'Enter position here', 'wavo' ),
                'default' => 'Founder',
                'label_block' => true,
            ]
        );
        $this->add_control( 'team_image',
            [
                'label' => esc_html__( 'Avatar Image', 'wavo' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => plugins_url( 'assets/front/img/author.jpg', __DIR__ )],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'full',
                'condition' => [ 'team_image[url]!' => '' ],
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'social',
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
        $repeater->add_control( 'link',
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
                'fields' => $repeater->get_controls(),
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
                ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('team_info_style_section',
            [
                'label'=> esc_html__( 'Team Info Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'team_info_color',
            [
                'label' => esc_html__( 'Info Background', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .team .item .img .info' => 'background-color:{{VALUE}};' ],
                'separator' => 'before',
            ]
        );
        $this->add_control( 'team_name_heading',
            [
                'label' => esc_html__( 'NAME', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'team_name_color',
            [
                'label' => esc_html__( 'Name Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .team .item .img .info h6' => 'color:{{VALUE}};' ],
            ]
        );
        $this->wavo_style_typo( 'team_name_typo','{{WRAPPER}} .team .item .img .info h6' );

        $this->add_control( 'team_job_heading',
            [
                'label' => esc_html__( 'POSITION', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'team_job_color',
            [
                'label' => esc_html__( 'Position Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .team .item .img .info p' => 'color:{{VALUE}};' ],
            ]
        );
        $this->wavo_style_typo( 'team_job_typo','{{WRAPPER}} .team .item .img .info p' );

        $this->add_control( 'team_socials_heading',
            [
                'label' => esc_html__( 'SOCIALS', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->start_controls_tabs( 'team_socials_tabs');
        $this->start_controls_tab( 'team_socials_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'wavo' ) ]
        );
        $this->add_control( 'team_socials_color',
            [
                'label' => esc_html__( 'Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .team .item .img .info .social a' => 'color:{{VALUE}};' ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab( 'team_socials_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wavo' ) ]
        );
        $this->add_control( 'team_socials_hvr_color',
            [
                'label' => esc_html__( 'Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .team .item .img .info .social a:hover' => 'color:{{VALUE}};' ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }
    protected function render() {
        $settings   = $this->get_settings_for_display();
        $elementid  = $this->get_id();
        $image      = $this->get_settings( 'team_image' );
        $image_url  = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumbnail', $settings );
        $imagealt   = esc_attr(get_post_meta($image['id'], '_wp_attachment_image_alt', true));
        $imagealt   = $imagealt ? $imagealt : basename ( get_attached_file( $image['id'] ) );
        $imageurl   = empty( $image_url ) ? $image['url'] : $image_url;

        if ( $imageurl ) {
            echo '<div class="team">';
                echo '<div class="item">';
                    echo '<div class="img">';
                        echo '<img class="thumparallax" src="'.$imageurl.'" alt="'.$imagealt.'">';
                        echo '<div class="info">';
                            if ( $settings['team_name'] ) {
                                echo '<h6 class="team-name">'.$settings['team_name'].'</h6>';
                            }
                            if ( $settings['team_pos'] ) {
                                echo '<p>'.$settings['team_pos'].'</p>';
                            }
                            echo '<div class="social">';
                                foreach ( $settings['socials'] as $item ) {
                                    $target = $item['link']['is_external'] ? ' target="_blank"' : '';
                                    echo '<a class="social-link" href="'.esc_attr( $item['link']['url'] ).'"'.$target.'>';
                                        if ( ! empty($item['social']['value']) ) {
                                            Icons_Manager::render_icon( $item['social'], [ 'aria-hidden' => 'true' ] );
                                        }
                                    echo '</a>';
                                }
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

        }
    }
}
