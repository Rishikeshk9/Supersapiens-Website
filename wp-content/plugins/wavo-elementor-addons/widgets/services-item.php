<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wavo_Services_Item extends Widget_Base {
    use Wavo_Helper;
    public function get_name() {
        return 'wavo-services-item';
    }
    public function get_title() {
        return 'Services Item (N)';
    }
    public function get_icon() {
        return 'eicon-columns';
    }
    public function get_categories() {
        return [ 'wavo' ];
    }
    public function get_script_depends() {
        return [ 'drawsvg' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'wavo_services_one_items_settings',
            [
                'label' => esc_html__('Services Item', 'wavo')
            ]
        );
        $this->add_control( 'darkmode',
            [
                'label' => esc_html__( 'Dark Mode', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes',
            ]
        );
        $this->add_control( 'use_ionicon',
            [
                'label' => esc_html__( 'Use Ion Icon', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes'
            ]
        );
        $this->add_control( 'ionicon',
            [
                'label' => esc_html__( 'Icon Name', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'ion-ios-monitor',
                'pleaceholder' => 'ion-ios-monitor',
                'label_block' => true,
                'condition' => ['use_ionicon' => 'yes']
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
                'condition' => ['use_ionicon!' => 'yes']
            ]
        );
        $this->add_control( 'title',
            [
                'label' => esc_html__( 'Title', 'wavo' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Interface Design',
                'label_block' => true
            ]
        );
        $this->add_control( 'desc',
            [
                'label' => esc_html__( 'Description', 'wavo' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Implementation and rollout of new network infrastructure,including consolidation.',
                'label_block' => true
            ]
        );
        $this->add_control( 'link',
            [
                'label' => esc_html__( 'Link', 'wavo' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#0',
                    'is_external' => 'true',
                ],
                'placeholder' => esc_html__( 'Place URL here', 'wavo' )
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section( 'wavo_services_box_style',
            [
                'label' => esc_html__( 'Box', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->start_controls_tabs('services_box_tabs');
        $this->start_controls_tab( 'services_box_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'wavo' ) ]
        );
        $this->wavo_style_background( $id='services_box_normal_bg','{{WRAPPER}} .services.draw-hover.items',['classic','gradient'] );
        $this->wavo_style_border( 'services_box_normal_border','{{WRAPPER}} .services.draw-hover.items' );
        $this->wavo_style_box_shadow( 'services_box_normal_box_shadow','{{WRAPPER}} .services.draw-hover.items' );
        $this->end_controls_tab();

        $this->start_controls_tab('services_box_hover_tab',
            [ 'label' => esc_html__( 'Active', 'wavo' ) ]
        );
        $this->wavo_style_background( $id='services_box_hover_bg','{{WRAPPER}} .services.draw-hover.items.active',['classic','gradient'] );
        $this->wavo_style_border( 'services_box_hover_border','{{WRAPPER}} .services.draw-hover.items.active' );
        $this->wavo_style_box_shadow( 'services_box_hover_box_shadow','{{WRAPPER}} .services.draw-hover.items.active' );
        $this->add_control( 'services_active_icon',
            [
                'label' => esc_html__( 'Icon Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .services.active .services_icon.icon' => 'color:{{VALUE}};' ],
                'separator' => 'before'
            ]
        );
        $this->add_control( 'services_active_title',
            [
                'label' => esc_html__( 'Title Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .services.active .services_title' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'services_active_desc',
            [
                'label' => esc_html__( 'Description Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .services.active .service_summary' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'services_active_arrow',
            [
                'label' => esc_html__( 'Arrow Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .about .items .more-stroke span, {{WRAPPER}} .about .items .more-stroke span:after, {{WRAPPER}} .about .items .more-stroke span:before' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section( 'wavo_services_icon_style',
            [
                'label' => esc_html__( 'Icon', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wavo_style_controls(array('shadow','background'),$id='services_icon',$selector='.services_icon.icon, {{WRAPPER}} .services_icon .icon');
        $this->end_controls_section();

        $this->start_controls_section( 'wavo_services_title_style',
            [
                'label' => esc_html__( 'Title', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['title!' => '']
            ]
        );
        $this->wavo_style_controls(array('shadow'),$id='services_title',$selector='.services_title');
        $this->end_controls_section();

        $this->start_controls_section( 'wavo_services_desc_style',
            [
                'label' => esc_html__( 'Description', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['desc!' => '']
            ]
        );
        $this->wavo_style_controls(array('shadow'),$id='services_desc',$selector='.services .service_summary');
        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $target = $settings['link']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
        $darkmode = $settings['darkmode'] ? ' blc' : '';

        echo '<div class="about'.$darkmode.'">';
            echo '<div class="services draw-hover items">';
                echo '<div class="item wow fadeIn">';

                    if ( 'yes' == $settings['use_ionicon'] ) {
                        echo '<span class="services_icon icon"><i class="'.$settings['ionicon'].'"></i></span>';
                    } else {
                        if ( ! empty( $settings['icon']['value'] ) ) {
                            echo '<span class="services_icon icon">';
                                Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
                            echo '</span>';
                        }
                    }
                    if ( $settings['title'] ) {
                        echo '<h5 class="services_title">'.$settings['title'].'</h5>';
                    }
                    if ( $settings['desc'] ) {
                        echo '<p class="service_summary">'.$settings['desc'].'</p>';
                    }
                    if( $settings['link']['url'] ) {
                        echo '<a href="'.$settings['link']['url'].'"'.$target.$nofollow.' class="more-stroke"><span></span></a>';
                    }
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
}
