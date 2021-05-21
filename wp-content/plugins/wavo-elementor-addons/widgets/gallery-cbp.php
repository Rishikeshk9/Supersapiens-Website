<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wavo_Gallery_Cbp extends Widget_Base {
    use Wavo_Helper;
    public function get_name() {
        return 'wavo-gallery-cbp';
    }
    public function get_title() {
        return 'Cube Portfolio (N)';
    }
    public function get_icon() {
        return 'eicon-gallery-grid';
    }
    public function get_categories() {
        return [ 'wavo-cpt' ];
    }
    public function get_style_depends() {
        return [ 'cubeportfolio', 'cubeportfolio-custom', 'magnific' ];
    }
    public function get_script_depends() {
        return [ 'cubeportfolio', 'magnific' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_query_section',
            [
                'label' => esc_html__( 'Projects Query', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'query_type',
            [
                'label' => esc_html__( 'Query Type', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => 'true',
                'default' => 'thm',
                'options' => [
                    'thm' => esc_html__( 'Theme Project', 'wavo' ),
                    'custom' => esc_html__( 'Custom Post Type', 'wavo' ),
                ]
            ]
        );
        $this->add_control( 'category_filter_heading',
            [
                'label' => esc_html__( 'Category Filter', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'condition' => ['query_type!' => 'custom']
            ]
        );
        $this->add_control( 'category_exclude',
            [
                'label' => esc_html__( 'Exclude Category', 'wavo' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->wavo_cpt_taxonomies( array ( 'taxonomy' => 'projects_cat','hide_empty' => true) ),
                'description' => 'Select Category(s) to Exclude',
                'condition' => ['query_type!' => 'custom']
            ]
        );
        $this->add_control( 'tags_exclude',
            [
                'label' => esc_html__( 'Exclude Tags', 'wavo' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->wavo_cpt_taxonomies( array ( 'taxonomy' => 'projects_tag','hide_empty' => true) ),
                'description' => 'Select Category(s) to Exclude',
                'condition' => ['query_type!' => 'custom']
            ]
        );
        $this->add_control( 'posts_other_heading',
            [
                'label' => esc_html__( 'Other Filter', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['query_type!' => 'custom']
            ]
        );
        $this->add_control( 'per_page',
            [
                'label' => esc_html__( 'Posts Per Page', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000,
                'default' => 20,
                'condition' => ['query_type!' => 'custom']
            ]
        );
        $this->add_control( 'order',
            [
                'label' => esc_html__( 'Select Order', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => esc_html__( 'Ascending', 'wavo' ),
                    'DESC' => esc_html__( 'Descending', 'wavo' )
                ],
                'default' => 'ASC',
                'condition' => ['query_type!' => 'custom']
            ]
        );
        $this->add_control( 'orderby',
            [
                'label' => esc_html__( 'Order By', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'id' => esc_html__( 'Post ID', 'wavo' ),
                    'menu_order' => esc_html__( 'Menu Order', 'wavo' ),
                    'rand' => esc_html__( 'Random', 'wavo' ),
                    'date' => esc_html__( 'Date', 'wavo' ),
                    'title' => esc_html__( 'Title', 'wavo' )
                ],
                'default' => 'id',
                'condition' => ['query_type!' => 'custom']
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'custom_query_section',
            [
                'label' => esc_html__( 'Custom Query', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => ['query_type' => 'custom']
            ]
        );
        $this->wavo_query_controls( 'projects', $pag=false, $filter=true );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        // Preset
        $this->start_controls_section( 'grid_preset_section',
            [
                'label' => esc_html__( 'Preset', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'layoutmode',
            [
                'label' => esc_html__( 'Layout Mode', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'grid' => esc_html__( 'grid masonry', 'wavo' ),
                    'slider' => esc_html__( 'slider', 'wavo' ),
                ],
                'default' => 'grid'
            ]
        );
        $this->add_control( 'navigation',
            [
                'label' => esc_html__( 'Slider Navigation', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => ['layoutmode' => 'slider']
            ]
        );
        $this->add_control( 'spagination',
            [
                'label' => esc_html__( 'Slider Dots', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'condition' => ['layoutmode' => 'slider']
            ]
        );
        $this->add_control( 'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => ['layoutmode' => 'slider']
            ]
        );
        $this->add_control( 'pause',
            [
                'label' => esc_html__( 'Pause on Hover', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => ['layoutmode' => 'slider']
            ]
        );
        $this->add_responsive_control( 'timeout',
            [
                'label' => esc_html__( 'Autoplay Timeout', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10000,
                'default' => 5000,
                'condition' => ['layoutmode' => 'slider']
            ]
        );
        $this->add_responsive_control( 'maxh',
            [
                'label' => esc_html__( 'Max Height', 'agrikon' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000,
                'default' => '',
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .cbp .cbp-item, {{WRAPPER}} .cbp .cbp-item .cbp-caption-defaultWrap' => 'max-height: {{SIZE}}px;'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
            'name' => 'thumbnail',
            'default' => 'large'
            ]
        );
        $this->add_control( 'gap_divider',
            [
                'label' => esc_html__( 'GAP', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_control( 'horizontalgap',
            [
                'label' => __( 'Horizontal Gap', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 30
            ]
        );
        $this->add_control( 'verticalgap',
            [
                'label' => __( 'Vertical Gap', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 30
            ]
        );
        $this->add_control( 'column_divider',
            [
                'label' => esc_html__( 'COLUMN', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'xlcount',
            [
                'label' => esc_html__( 'X-Large Device Column', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => 3
            ]
        );
        $this->add_control( 'lgcount',
            [
                'label' => esc_html__( 'Desktop Column', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => 3
            ]
        );
        $this->add_control( 'smcount',
            [
                'label' => esc_html__( 'Tablet Column', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => 2
            ]
        );
        $this->add_control( 'xscount',
            [
                'label' => esc_html__( 'Phone Column', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => 1
            ]
        );
        $this->add_control( 'filter_divider',
            [
                'label' => esc_html__( 'FILTER', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'showfilter',
            [
                'label' => esc_html__( 'Show Filter', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );
        $this->add_control( 'filteralltext',
            [
                'label' => esc_html__( 'Filter First Text ( All )', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'All',
                'condition' => ['showfilter' => 'yes']
            ]
        );
        $this->add_control( 'filtercounter',
            [
                'label' => esc_html__( 'Filter Counter', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => ['showfilter' => 'yes']
            ]
        );
        $this->add_control( 'animation_divider',
            [
                'label' => esc_html__( 'ANIMATION', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'animationfilter',
            [
                'label' => esc_html__( 'Filter Animation', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'fadeOut' => 'fadeOut',
                    'quicksand' => 'quicksand',
                    'bounceLeft' => 'bounceLeft',
                    'bounceTop' => 'bounceTop',
                    'bounceBottom' => 'bounceBottom',
                    'moveLeft' => 'moveLeft',
                    'slideLeft' => 'slideLeft',
                    'fadeOutTop' => 'fadeOutTop',
                    'sequentially' => 'sequentially',
                    'skew' => 'skew',
                    'slideDelay' => 'slideDelay',
                    'rotateSides' => 'rotateSides',
                    'flipOutDelay' => 'flipOutDelay',
                    'flipOut' => 'flipOut',
                    'unfold' => 'unfold',
                    'foldLeft' => 'foldLeft',
                    'scaleDown' => 'scaleDown',
                    'scaleSides' => 'scaleSides',
                    'frontRow' => 'frontRow',
                    'flipBottom' => 'flipBottom',
                    'rotateRoom' => 'rotateRoom'
                ],
                'default' => 'sequentially',
                'condition' => ['showfilter' => 'yes']
            ]
        );
        $this->add_control( 'animationcaption',
            [
                'label' => esc_html__( 'Caption Animation', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'pushTop',
                'options' => [
                    'pushTop' => 'pushTop',
                    'pushDown' => 'pushDown',
                    'revealBottom' => 'revealBottom',
                    'revealTop' => 'revealTop',
                    'revealLeft' => 'revealLeft',
                    'moveRight' => 'moveRight',
                    'overlayBottom' => 'overlayBottom',
                    'overlayBottomPush' => 'overlayBottomPush',
                    'overlayBottomReveal' => 'overlayBottomReveal',
                    'overlayBottomAlong' => 'overlayBottomAlong',
                    'minimal' => 'minimal',
                    'fadeIn' => 'fadeIn',
                    'zoom' => 'zoom',
                    'opacity' => 'opacity'
                ]
            ]
        );
        $this->add_control( 'pagination_divider',
            [
                'label' => esc_html__( 'POST PAGINATION', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['layoutmode!' => 'slider']
            ]
        );
        $this->add_control( 'pagination',
            [
                'label' => esc_html__( 'Pagination', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'condition' => ['layoutmode!' => 'slider']
            ]
        );
        $this->add_responsive_control('pagination_alignment',
            [
                'label' => esc_html__( 'Alignment', 'wavo' ),
                'type' => Controls_Manager::CHOOSE,
                'toggle' => true,
                'selectors' => ['{{WRAPPER}} .portfolio-wrapper .post-nav' => 'text-align: {{VALUE}};'],
                'default' => 'left',
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
                'condition' => ['layoutmode!' => 'slider']
            ]
        );
        $this->add_control( 'prevtext',
            [
                'label' => esc_html__( 'Pagination Text ( Previous Page )', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Previous Page',
                'condition' => ['layoutmode!' => 'slider']
            ]
        );
        $this->add_control( 'nexttext',
            [
                'label' => esc_html__( 'Pagination Text ( Next Page )', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Next Page',
                'condition' => ['layoutmode!' => 'slider']
            ]
        );
        $this->add_control( 'other_divider',
            [
                'label' => esc_html__( 'OTHER', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'lazy',
            [
                'label' => esc_html__( 'Lazy Load', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_control( 'ltitle',
            [
                'label' => esc_html__( 'Lightbox Post Title', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_options_section',
            [
                'label' => esc_html__( 'Post Options', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'showicon',
            [
                'label' => esc_html__( 'Post Icon', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );
        $this->add_control( 'showtitle',
            [
                'label' => esc_html__( 'Post Title', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control( 'showcat',
            [
                'label' => esc_html__( 'Post Category', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes'
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_style_section',
            [
                'label' => esc_html__( 'STYLE', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'filter_sdivider',
            [
                'label' => esc_html__( 'FILTER', 'wavo' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_responsive_control( 'filter_alignment',
            [
                'label' => esc_html__( 'Alignment', 'wavo' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .posts-filter.cbp-l-filters-button' => 'text-align: {{VALUE}};'],
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
                'default' => 'center'
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'filter_typo',
                'label' => esc_html__( 'Typography', 'wavo' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .cbp-l-filters-button .cbp-filter-item'
            ]
        );
        $this->add_responsive_control( 'filter_padding',
            [
                'label' => esc_html__( 'Padding', 'wavo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .cbp-l-filters-button .cbp-filter-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                'separator' => 'before'
            ]
        );
        $this->add_responsive_control( 'filter_margin',
            [
                'label' => esc_html__( 'Margin', 'wavo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .cbp-l-filters-button .cbp-filter-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
                'separator' => 'before'
            ]
        );
        $this->start_controls_tabs('filter_tabs');
        $this->start_controls_tab( 'filter_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'wavo' ) ]
        );
        $this->add_control( 'filter_bgcolor',
            [
                'label' => esc_html__( 'Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .cbp-l-filters-button .cbp-filter-item' => 'color: {{VALUE}};']
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'filter_border',
                'label' => esc_html__( 'Border', 'wavo' ),
                'selector' => '{{WRAPPER}} .cbp-l-filters-button .cbp-filter-item',
            ]
        );
        $this->add_responsive_control( 'filter_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'wavo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .cbp-l-filters-button .cbp-filter-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'filter_color',
            [
                'label' => esc_html__( 'Background Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .cbp-l-filters-button .cbp-filter-item' => 'background-color: {{VALUE}};']
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab('filter_hover_tab',
            [ 'label' => esc_html__( 'Hover/Active', 'wavo' ) ]
        );
        $this->add_control( 'filter_hvrcolor',
            [
                'label' => esc_html__( 'Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .cbp-l-filters-button .cbp-filter-item:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .cbp-l-filters-button .cbp-filter-item-active' => 'color: {{VALUE}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'filter_hvrborder',
                'label' => esc_html__( 'Border', 'wavo' ),
                'selector' => '{{WRAPPER}} .cbp-l-filters-button .cbp-filter-item:hover,{{WRAPPER}} .cbp-l-filters-button .cbp-filter-item-active',
            ]
        );
        $this->add_responsive_control( 'filter_hvrborder_radius',
            [
                'label' => esc_html__( 'Border Radius', 'wavo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .cbp-l-filters-button .cbp-filter-item:hover,{{WRAPPER}} .cbp-l-filters-button .cbp-filter-item-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control( 'filter_hvrbgcolor',
            [
                'label' => esc_html__( 'Background Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .cbp-l-filters-button .cbp-filter-item:hover,{{WRAPPER}} .cbp-l-filters-button .cbp-filter-item-active' => 'background-color: {{VALUE}};']
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control( 'filter_counter_sdivider',
            [
                'label' => esc_html__( 'FILTER COUNTER', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'filter_counter_color',
            [
                'label' => esc_html__( 'Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .cbp-l-filters-button .cbp-filter-counter' => 'color: {{VALUE}};']
            ]
        );
        $this->add_control( 'filter_counter_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .cbp-l-filters-button .cbp-filter-counter' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .cbp-l-filters-button .cbp-filter-counter:after' => 'border-top-color: {{VALUE}};',
                ]
            ]
        );
        $this->add_control( 'filter_counter_position',
            [
                'label' => esc_html__( 'Position', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .cbp-l-filters-button .cbp-filter-counter' => 'bottom: {{SIZE}}px;']
            ]
        );
        $this->add_control( 'box_sdivider',
            [
                'label' => esc_html__( 'POST BOX', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => esc_html__( 'Item Border', 'wavo' ),
                'selector' => '{{WRAPPER}} .cbp .cbp-item',
            ]
        );
        $this->add_control( 'activewrap_bgcolor',
            [
                'label' => esc_html__( 'Text Content Background Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .cbp-caption-active .cbp-caption-activeWrap' => 'background-color: {{VALUE}};']
            ]
        );
        $this->add_control( 'icon_sdivider',
            [
                'label' => esc_html__( 'ICON', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'icon_color',
            [
                'label' => esc_html__( 'Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .cbp-item i.x3' => 'color: {{VALUE}};']
            ]
        );
        $this->add_control( 'icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .cbp-item i.x3' => 'font-size: {{SIZE}}px;']
            ]
        );
        $this->add_control( 'title_sdivider',
            [
                'label' => esc_html__( 'TITLE', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'title_color',
            [
                'label' => esc_html__( 'Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .cbp-item .cbp-caption-activeWrap .wrap .post--title' => 'color: {{VALUE}};']
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typo',
                'label' => esc_html__( 'Typography', 'wavo' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .cbp-item .cbp-caption-activeWrap .wrap .post--title'
            ]
        );
        $this->add_control( 'cats_sdivider',
            [
                'label' => esc_html__( 'CATEGORIES', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'cats_color',
            [
                'label' => esc_html__( 'Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .cbp-item .cbp-caption-activeWrap .wrap .post--cat' => 'color: {{VALUE}};']
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'cats_typo',
                'label' => esc_html__( 'Typography', 'wavo' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .cbp-item .cbp-caption-activeWrap .wrap .post--cat'
            ]
        );
        $this->add_control( 'slidernav_sdivider',
            [
                'label' => esc_html__( 'NAV', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'slidernav_alignment',
            [
                'label' => esc_html__( 'Alignment', 'wavo' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .cbp-nav-controls' => 'justify-content: {{VALUE}};'],
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
                'default' => 'center'
            ]
        );
        $this->add_control( 'slidernav_color',
            [
                'label' => esc_html__( 'Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .cbp-nav-next, {{WRAPPER}} .cbp-nav-prev' => 'color: {{VALUE}};']
            ]
        );
        $this->add_control( 'slidernav_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .cbp-nav-next:hover, {{WRAPPER}} .cbp-nav-prev:hover' => 'color: {{VALUE}};']
            ]
        );
        $this->add_control( 'slidernav_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .cbp-nav-next, {{WRAPPER}} .cbp-nav-prev' => 'background-color: {{VALUE}};']
            ]
        );
        $this->add_control( 'slidernav_hvrbgcolor',
            [
                'label' => esc_html__( 'Hover Background Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .cbp-nav-next:hover, {{WRAPPER}} .cbp-nav-prev:hover' => 'background-color: {{VALUE}};']
            ]
        );
        $this->add_control( 'sliderdots_sdivider',
            [
                'label' => esc_html__( 'DOTS', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'sliderdots_alignment',
            [
                'label' => esc_html__( 'Alignment', 'wavo' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .cbp-nav-pagination' => 'text-align: {{VALUE}};'],
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
                'default' => 'center'
            ]
        );
        $this->add_control( 'sliderdots_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .cbp-nav-pagination-item' => 'background-color: {{VALUE}};']
            ]
        );
        $this->add_control( 'sliderdots_hvrbgcolor',
            [
                'label' => esc_html__( 'Hover Background Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .cbp-nav-pagination-item:hover, {{WRAPPER}} .cbp-nav-pagination-active' => 'background-color: {{VALUE}};']
            ]
        );
        $this->add_control( 'postpagination_sdivider',
            [
                'label' => esc_html__( 'POST PAGINATION', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'postpagination_alignment',
            [
                'label' => esc_html__( 'Alignment', 'wavo' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .portfolio-cbp-nav nav.pagination' => 'justify-content: {{VALUE}};'],
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
                'default' => 'center'
            ]
        );
        $this->add_control( 'postpagination_spacing',
            [
                'label' => esc_html__( 'Spacing', 'wavo' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 50
                    ]
                ],
                'selectors' => ['{{WRAPPER}} .portfolio-cbp-nav .page-numbers:not(:last-child)' => 'margin-right: {{SIZE}}px;']
            ]
        );
        $this->start_controls_tabs('postpagination_tabs');
        $this->start_controls_tab('postpagination_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'wavo' ) ]
        );
        $this->add_control( 'postpagination_color',
            [
                'label' => esc_html__( 'Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .portfolio-cbp-nav .page-numbers' => 'color: {{VALUE}};']
            ]
        );
        $this->add_control( 'postpagination_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .portfolio-cbp-nav .page-numbers' => 'background-color: {{VALUE}};']
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'postpagination_border',
                'label' => esc_html__( 'Border', 'wavo' ),
                'selector' => '{{WRAPPER}} .portfolio-cbp-nav .page-numbers',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab('postpagination_hover_tab',
            [ 'label' => esc_html__( 'Hover/Active', 'wavo' ) ]
        );
        $this->add_control( 'postpagination_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .portfolio-cbp-nav .page-numbers:hover, {{WRAPPER}} .portfolio-cbp-nav .page-numbers.current' => 'color: {{VALUE}};']
            ]
        );
        $this->add_control( 'postpagination_hvrbgcolor',
            [
                'label' => esc_html__( 'Background Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .portfolio-cbp-nav .page-numbers:hover, {{WRAPPER}} .portfolio-cbp-nav .page-numbers.current' => 'background-color: {{VALUE}};']
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'postpagination_hvrborder',
                'label' => esc_html__( 'Border', 'wavo' ),
                'selector' => '{{WRAPPER}} .portfolio-cbp-nav .page-numbers:hover, {{WRAPPER}} .portfolio-cbp-nav .page-numbers.current',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $settingsid = $this->get_id();

        $layoutmode       = $settings['layoutmode'] ? $settings['layoutmode'] : 'grid';
        $animationfilter  = $settings['animationfilter'] ? $settings['animationfilter'] : 'sequentially';
        $animationcaption = $settings['animationcaption'] ? $settings['animationcaption'] : 'pushTop';
        $horizontalgap    = $settings['horizontalgap'] ? $settings['horizontalgap'] : 30;
        $verticalgap      = $settings['verticalgap'] ? $settings['verticalgap'] : 30;
        $xlcount          = $settings['xlcount'] ? $settings['xlcount'] : '2';
        $lgcount          = $settings['lgcount'] ? $settings['lgcount'] : '3';
        $smcount          = $settings['smcount'] ? $settings['smcount'] : '2';
        $xscount          = $settings['xscount'] ? $settings['xscount'] : '1';
        $navigation       = 'yes' == $settings['navigation'] ? 'true' : 'false';
        $spagination      = 'yes' == $settings['spagination'] ? 'true' : 'false';
        $auto             = 'yes' == $settings['autoplay'] ? 'true' : 'false';
        $pause            = 'yes' == $settings['pause'] ? 'true' : 'false';
        $timeout          = $settings['timeout'] ? $settings['timeout'] : 5000;


        if ( is_home() || is_front_page()) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        } else {
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        }

        if ( 'custom' == $settings['query_type'] ) {

            $post_type = $settings['post_type'];

            $args['post_type']      = $settings['post_type'];
            $args['posts_per_page'] = $settings['posts_per_page'];
            $args['offset']         = $settings['offsets'];
            $args['order']          = $settings['orders'];
            $args['orderby']        = $settings['orderbys'];
            $args['paged']          = $paged;
            $args[$settings['author_filter_type']] = $settings['authors'];

            if ( ! empty( $settings[ $post_type . '_filter' ] ) ) {
                $args[ $settings[ $post_type . '_filter_type' ] ] = $settings[ $post_type . '_filter' ];
            }

            // Taxonomy Filter.
            $taxonomy = $this->get_post_taxonomies( $post_type );

            if ( ! empty( $taxonomy ) && ! is_wp_error( $taxonomy ) ) {

                foreach ( $taxonomy as $index => $tax ) {

                    $tax_control_key = $index . '_' . $post_type;

                    if ( $post_type == 'post' ) {
                        if ( $index == 'post_tag' ) {
                            $tax_control_key = 'tags';
                        } elseif ( $index == 'category' ) {
                            $tax_control_key = 'categories';
                        }
                    }

                    if ( ! empty( $settings[ $tax_control_key ] ) ) {

                        $operator = $settings[ $index . '_' . $post_type . '_filter_type' ];

                        $args['tax_query'][] = array(
                            'taxonomy' => $index,
                            'field'    => 'term_id',
                            'terms'    => $settings[ $tax_control_key ],
                            'operator' => $operator,
                        );
                    }
                }
            }

        } else {

            $args = array(
                'post_type'      => 'projects',
                'posts_per_page' => $settings['per_page'],
                'order'          => $settings['order'],
                'orderby'        => $settings['orderby'],
                'paged'          => $paged,
                'tax_query'      => array(
                    'relation' => 'OR',
                    array(
                        'taxonomy' => 'projects_cat',
                        'field'    => 'id',
                        'terms'    => $settings['category_exclude'],
                        'operator' => 'NOT IN'
                    ),
                    array(
                        'taxonomy' => 'projects_tag',
                        'field'    => 'id',
                        'terms'    => $settings['tags_exclude'],
                        'operator' => 'NOT IN'
                    )
                )
            );
        }

        $size = $settings['thumbnail_size'] ? $settings['thumbnail_size'] : 'full';
        if ( 'custom' == $size ) {
            $sizew = $settings['thumbnail_custom_dimension']['width'];
            $sizeh = $settings['thumbnail_custom_dimension']['height'];
            $size = [ $sizew, $sizeh ];
        }

        $the_query = new \WP_Query( $args );
        if ( $the_query->have_posts() ) {
            echo '<div class="gallery-cbp gallery-'.$settingsid.'">';

                if ( 'custom' == $settings['query_type'] ) {
                    $exclude = array();
                    $taxonomy = '';
                    $post_type = $this->wavo_get_post_types();
                    foreach ( $post_type as $slug => $label  ) {
                        if ( !empty($settings[ $slug.'_top_taxonomy' ]) ) {
                            $taxonomy = $settings[ $slug.'_top_taxonomy' ];
                        }
                        if ( !empty($settings[ $slug.'_top_filter' ]) ) {
                            $exclude = $settings[ $slug.'_top_filter' ];
                        }
                    }
                    $cats = get_terms( array (
                        'taxonomy'   => $taxonomy,
                        'order'      => $settings['orders'],
                        'orderby'    => $settings['orderbys'],
                        'hide_empty' => true,
                        'parent'     => 0,
                        'exclude'    => $exclude
                    ) );

                } else {

                    $cats = get_terms( array (
                        'taxonomy'   => 'projects_cat',
                        'order'      => $settings['order'],
                        'orderby'    => $settings['orderby'],
                        'hide_empty' => true,
                        'parent'     => 0,
                        'exclude'    => $settings['category_exclude']
                    ) );
                }

                if ( 'yes' == $settings['showfilter'] && 'slider' != $settings['layoutmode'] && $cats > 1 ) {
                    $filtercounter = $settings['filtercounter'] == 'yes' ? '<div class="cbp-filter-counter"></div>' : '';
                    echo '<div class="posts-filter cbp-l-filters-button">';
                        echo '<span data-filter=\'*\' class="cbp-filter-active cbp-filter-item">'.$settings['filteralltext'].$filtercounter.'</span>';
                        foreach ( $cats as $cat ) {
                            $filter = mb_strtolower( str_replace(' ', '-', $cat->name ) );
                            echo '<span data-filter=".'.$filter.'" class="cbp-filter-item">'.$cat->name.$filtercounter.'</span>';
                        }
                    echo '</div>';
                }

                $navdisplay  = 'show';
                $navdisplay  = ( $navdisplay == 'show' ) ? ' mt-60 nav-show' : ' nav-hide';
                $sliderclass = ( $layoutmode == 'slider' ) ? $navdisplay : '';

                echo '<div class="gallery-elementor cbp'.$sliderclass.' type-'.$layoutmode.'">';

                    while ( $the_query->have_posts() ) {
                        $the_query->the_post();

                        $linktype = get_post_meta( get_the_ID(), 'wavo_projects_link_type', true );
                        $vidurl   = get_post_meta( get_the_ID(), 'wavo_projects_video_url', true );
                        $c_url    = get_post_meta( get_the_ID(), 'wavo_projects_custom_url', true );
                        $gallery  = get_post_meta( get_the_ID(), 'wavo_port_gallery_image', true );


                        if ( has_post_thumbnail() ) {

                            if ( 'custom' == $settings['query_type'] ) {

                                foreach ( $taxonomy as $index => $tax ) {
                                    $terms = get_the_terms( get_the_ID(), $tax );
                                    // Get the terms related to post.
                                    if ( ! empty( $terms ) ) {
                                        foreach ( $terms as $term ) {
                                            if ( ! empty( $term->name ) ) {
                                                $links[] = mb_strtolower( $term->name );
                                            }
                                        }
                                    }
                                }
                                $links = str_replace(' ', '-', $links);
                                $tax = join( " ", array_unique($links) );
                                $taxi = join( " - ", array_unique($links) );

                            } else {
                                $terms = get_the_terms( get_the_ID(), 'projects_cat' );
                                // Get the terms related to post.
                                if ( $terms && ! is_wp_error( $terms ) ) {
                                    $links = array();
                                    foreach ( $terms as $term ) {
                                        if ( ! empty( $term->name ) ) {
                                            $links[] = mb_strtolower( $term->name );
                                        }
                                    }
                                    $links = str_replace( ' ', '-', $links );
                                    $tax = join( " ", array_unique( $links ) );
                                    $taxi = join( " - ", array_unique($links) );
                                } else {
                                    $tax = $taxi = '';

                                }
                            }
                            $thumbfull = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                            echo '<div class="cbp-item '.mb_strtolower( $tax ).'">';
                                switch ( $linktype ) {
                                    case 'permalink':
                                        echo '<a href="'.get_permalink().'" title="'.get_the_title().'">';
                                    break;
                                    case 'permalink-popup':
                                        echo '<a class="ajax-popup-link cbp-caption" href="'.get_permalink().'" title="'.get_the_title().'" data-effect="mfp-zoom-out cube-iframe">';
                                    break;
                                    case 'custom':
                                        echo '<a href="'.esc_url($c_url).'" title="'.get_the_title().'" target="_blank">';
                                    break;
                                    default:
                                        $lhtml= 'yes' == $settings['ltitle'] ? ' data-title="<h3>'.get_the_title().'  <span> / '.mb_strtolower($tax).'</span></h3>"' : '';
                                        if ( $vidurl != '' ) {
                                            echo '<a href="'.esc_url($vidurl).'" title="'.get_the_title().'"'.$lhtml.' class="cbp-lightbox cbp-caption">';
                                        } else {
                                            echo '<a href="'.$thumbfull.'" title="'.get_the_title().'"'.$lhtml.' class="cbp-lightbox cbp-caption">';
                                        }
                                    break;
                                }


                                    echo '<div class="cbp-caption-defaultWrap">';
                                        if( 'yes' == $settings['lazy'] ) {
                                            $img = wp_get_attachment_image_src( get_post_thumbnail_id(), $size );
                                            echo '<img src="data:image/gif;base64,R0lGODlhAQABAPAAAP///////yH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" data-cbp-src="'.$img[0].'" alt="'.get_the_title().'" width="'.$img[1].'" height="'.$img[2].'"/>';
                                        } else {
                                            echo get_the_post_thumbnail( get_the_ID(), $size );
                                        }
                                    echo '</div>';


                                    echo '<div class="cbp-caption-activeWrap">';
                                        echo '<div class="wrap">';
                                            switch ( $linktype ) {
                                                case 'permalink':
                                                    $icon = 'fas fa-link';
                                                break;
                                                case 'permalink-popup':
                                                    $icon = !empty( $gallery ) ? 'fas fa-images' : 'fas fa-expand';
                                                break;
                                                default:
                                                    $icon = !empty( $vidurl ) ? 'fas fa-video' : 'fas fa-images';
                                                break;
                                            }
                                            if ( $settings['showicon'] == 'yes' ) {
                                                echo '<i class="'.$icon.' x3"></i>';
                                            }
                                            if ( $settings['showcat'] == 'yes' ) {
                                                echo '<h3 class="post--title">'.get_the_title().'</h3>';
                                            }

                                            if ( $settings['showtitle'] == 'yes' ) {
                                                echo '<div class="post--cat">'.$taxi.'</div>';
                                            }

                                        echo '</div>';
                                    echo '</div>';
                                echo '</a>';
                            echo '</div>';
                        }
                    }
                echo '</div>';
                if ( $layoutmode != 'slider' && $settings['pagination'] == 'yes' ) {
                    $prevtext = $settings['prevtext'] ? $settings['prevtext'] : esc_html__( 'Previous Page', 'wavo' );
                    $nexttext = $settings['nexttext'] ? $settings['nexttext'] : esc_html__( 'Next Page', 'wavo' );

                    $total_pages = $the_query->max_num_pages;
                    $big = 999999999;
                    if ( $total_pages > 1 ) {
                        $current_page = max(1, $paged);
                        echo '<div class="portfolio-cbp-nav">';
                            echo '<nav class="pagination">';
                                echo paginate_links(array(
                                    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                    'format' => '?paged=%#%',
                                    'current' => $current_page,
                                    'total' => $total_pages,
                                    'prev_text' => $prevtext,
                                    'next_text' => $nexttext
                                ));
                            echo '</nav>';
                        echo '</div>';
                    }
                }
            echo '</div>';
            wp_reset_postdata();

            //if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
                ?>
                <script>

                jQuery(document).ready( function ($) {

                    var myGallery = jQuery('.gallery-<?php echo esc_attr($settingsid); ?> .gallery-elementor' ),
                        myfilter  = jQuery('.gallery-<?php echo esc_attr($settingsid); ?> .posts-filter' );

                    myGallery.cubeportfolio({
                        filters: myfilter,
                        layoutMode: "<?php echo esc_attr($layoutmode); ?>",
                        showNavigation: <?php echo esc_attr($navigation); ?>,
                        showPagination: <?php echo esc_attr($spagination); ?>,
                        auto: <?php echo esc_attr($auto); ?>,
                        autoTimeout: <?php echo esc_attr($timeout); ?>,
                        autoPauseOnHover: <?php echo esc_attr($pause); ?>,
                        mediaQueries: [
                            {
                                width: 1500,
                                cols: <?php echo esc_attr($xlcount); ?>,
                            },
                            {
                                width: 1100,
                                cols: <?php echo esc_attr($lgcount); ?>,
                            },
                            {
                                width: 480,
                                cols: <?php echo esc_attr($smcount); ?>,

                            },
                            {
                                width: 320,
                                cols: <?php echo esc_attr($xscount); ?>,
                            }
                        ],
                        defaultFilter: "*",
                        animationType: "<?php echo esc_attr($animationfilter); ?>",
                        gapHorizontal: <?php echo esc_attr($horizontalgap); ?>,
                        gapVertical: <?php echo esc_attr($verticalgap); ?>,
                        gridAdjustment: "responsive",
                        caption: "<?php echo esc_attr($animationcaption); ?>",
                        // singlePage popup
                        singlePageDelegate: ".cbp-singlePage",
                        singlePageAnimation: "left",
                        singlePageDeeplinking: true,
                        singlePageStickyNavigation: true,
                        singlePageCounter: '<div class="cbp-popup-singlePage-counter">{{current}} of {{total}}</div>',
                        singlePageCallback: function(url, element) {
                            // to update singlePage content use the following method: this.updateSinglePage(yourContent)
                            var t = this;

                            $.ajax({
                                url: url,
                                type: 'GET',
                                dataType: 'html',
                                timeout: 5000
                            })
                            .done(function(result) {
                                t.updateSinglePage(result);
                            })
                            .fail(function() {
                                t.updateSinglePage('AJAX Error! Please refresh the page!');
                            });
                        },
                        singlePageInlineCallback: function (item) {
                            // add content to singlePageInline
                            t.updateSinglePageInline();
                        }
                    });

                    jQuery('.cbp-filter-item .cbp-filter-counter').each( function(){
                        var counter = jQuery(this);
                        var val = counter.text();
                        if ( val == '0' ) {
                            jQuery(counter).parent().addClass('filter--empty');
                        }
                    });

                    $('.ajax-popup-link').magnificPopup({
                        type: 'iframe',
                        removalDelay: 500,
                        mainClass: 'cube-iframe',
                        callbacks: {
                            beforeOpen: function() {
                                this.st.mainClass = this.st.el.attr('data-effect');
                                setTimeout(function(){
                                    $(".mfp-iframe").contents().find('body').addClass('iframe-body');
                                }, 3000);
                            }
                        }
                    });

                });

                </script>
                <?php
            //}
        } else {
            echo '<p class="text">'.esc_html__('No post found!','wavo').'</p>';
        }

    }
}
