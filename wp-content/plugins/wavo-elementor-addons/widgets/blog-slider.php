<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wavo_Blog_Slider extends Widget_Base {
    use Wavo_Helper;
    public function get_name() {
        return 'wavo-blog-slider';
    }
    public function get_title() {
        return 'Blog Posts (N)';
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
        return [ 'swiper', 'wow' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('wavo_blog_general_settings',
            [
                'label' => esc_html__( 'General', 'wavo' ),
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
        $this->add_responsive_control( 'alignment',
            [
                'label' => esc_html__( 'Content Alignment', 'wavo' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .nt-blog-grid .item .cont,{{WRAPPER}} .nt-blog-grid .item .post-img .img' => 'text-align: {{VALUE}};'],
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
                'condition' => ['type' => '2']
            ]
        );
        $this->add_control( 'column',
            [
                'label' => esc_html__( 'Column', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => 'true',
                'default' => '4',
                'options' => [
                    '' => esc_html__( 'Select Column', 'wavo' ),
                    '3' => esc_html__( '4 Column', 'wavo' ),
                    '4' => esc_html__( '3 Column', 'wavo' ),
                    '6' => esc_html__( '2 Column', 'wavo' )
                ],
                'condition' => ['type' => '2']
            ]
        );
        $this->add_group_control(
        Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'exclude' => [ 'custom' ],
                'default' => 'large',
            ]
        );
        $this->add_control( 'pattern_img',
            [
                'label' => esc_html__( 'Background Pattern Image', 'wavo' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => plugins_url( 'assets/front/img/pattern.svg', __DIR__ )],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   END CONTROLS SECTION   ******/
        $this->start_controls_section( 'projects_slider_section',
            [
                'label' => esc_html__( 'Slider Options', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => ['type!' => '2']
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
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'nt_post_query',
            [
                'label' => esc_html__( 'Query', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'btn_title',
            [
                'label' => esc_html__( 'Read More Title', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Read more',
                'label_block' => true,
            ]
        );
        $this->add_control( 'author_filter_heading',
            [
                'label' => esc_html__( 'Author Filter', 'wavo' ),
                'type' => Controls_Manager::HEADING
            ]
        );
        $this->add_control( 'author_filter',
            [
                'label' => esc_html__( 'Author', 'wavo' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->wavo_get_users(),
                'description' => 'Select Author(s)'
            ]
        );
        $this->add_control( 'author_exclude_filter',
            [
                'label' => esc_html__( 'Exclude Author', 'wavo' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->wavo_get_users(),
                'description' => 'Select Author(s) to Exclude',
                'separator' => 'after'
            ]
        );
        $this->add_control( 'category_filter_heading',
            [
                'label' => esc_html__( 'Category Filter', 'wavo' ),
                'type' => Controls_Manager::HEADING
            ]
        );
        $this->add_control( 'category_filter',
            [
                'label' => esc_html__( 'Category', 'wavo' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->wavo_get_categories(),
                'description' => 'Select Category(s)'
            ]
        );
        $this->add_control( 'category_exclude_filter',
            [
                'label' => esc_html__( 'Exclude Category', 'wavo' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->wavo_get_categories(),
                'description' => 'Select Category(s) to Exclude',
                'separator' => 'after'
            ]
        );
        $this->add_control( 'tag_filter_heading',
            [
                'label' => esc_html__( 'Tag Filter', 'wavo' ),
                'type' => Controls_Manager::HEADING
            ]
        );
        $this->add_control( 'tag_filter',
            [
                'label' => esc_html__( 'Tag', 'wavo' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->wavo_get_tags(),
                'description' => 'Select Tag(s)'
            ]
        );
        $this->add_control( 'tag_exclude_filter',
            [
                'label' => esc_html__( 'Exclude Tag', 'wavo' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->wavo_get_tags(),
                'description' => 'Select Tag(s) to Exclude',
                'separator' => 'after'
            ]
        );
        $this->add_control( 'post_filter_heading',
            [
                'label' => esc_html__( 'Post Filter', 'wavo' ),
                'type' => Controls_Manager::HEADING
            ]
        );
        $this->add_control( 'post_filter',
            [
                'label' => esc_html__( 'Specific Post(s)', 'wavo' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->wavo_get_posts(),
                'description' => 'Select Specific Post(s)'
            ]
        );
        $this->add_control( 'post_exclude_filter',
            [
                'label' => esc_html__( 'Exclude Post', 'wavo' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->wavo_get_posts(),
                'description' => 'Select Post(s) to Exclude',
                'separator' => 'after'
            ]
        );
        $this->add_control( 'post_other_heading',
            [
                'label' => esc_html__( 'Other Filter', 'wavo' ),
                'type' => Controls_Manager::HEADING
            ]
        );
        $this->add_control('post_per_page',
            [
                'label' => esc_html__( 'Posts Per Page', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000,
                'default' => 2
            ]
        );
        $this->add_control('offset',
            [
                'label' => esc_html__( 'Offset', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 1000
            ]
        );
        $this->add_control( 'order',
            [
                'label' => esc_html__( 'Select Order', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => 'Ascending',
                    'DESC' => 'Descending'
                ],
                'default' => 'ASC'
            ]
        );
        $this->add_control( 'orderby',
            [
                'label' => esc_html__( 'Order By', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => 'None',
                    'ID' => 'Post ID',
                    'author' => 'Author',
                    'title' => 'Title',
                    'name' => 'Slug',
                    'date' => 'Date',
                    'modified' => 'Last Modified Date',
                    'parent' => 'Post Parent ID',
                    'rand' => 'Random',
                    'comment_count' => 'Number of Comments',
                ],
                'default' => 'none'
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'wavo_post_options',
            [
                'label' => esc_html__( 'Post Options', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'hidetitle',
            [
                'label' => esc_html__( 'Hide Title', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no'
            ]
        );
        $this->add_control( 'hidemeta',
            [
                'label' => esc_html__( 'Hide Meta', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no'
            ]
        );
        $this->add_control( 'hideexcerpt',
            [
                'label' => esc_html__( 'Hide Excerpt', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no'
            ]
        );
        $this->add_control( 'excerpt_limit',
            [
                'label' => esc_html__( 'Excerpt Word Limit', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'default' => 20,
                'condition' => ['hideexcerpt!' => 'yes']
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_box_style_section',
            [
                'label'=> esc_html__( 'Box Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['type' => '2']
            ]
        );
        $this->add_control( 'post_box_heading',
            [
                'label' => esc_html__( 'BOX', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'post_box_background',
            [
                'label' => esc_html__( 'Background', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .nt-blog-grid .item,{{WRAPPER}} .nt-blog-grid .item .cont' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'post_box_border',
                'label' => esc_html__( 'Border', 'wavo' ),
                'selector' => '{{WRAPPER}} .nt-blog-grid .item'
            ]
        );
        $this->add_responsive_control( 'post_box_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'wavo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .nt-blog-grid .item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        $this->add_responsive_control( 'post_box_padding',
            [
                'label' => esc_html__( 'Padding', 'wavo' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => ['{{WRAPPER}} .nt-blog-grid .item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'post_box_bxshdw',
                'label' => esc_html__( 'Box Shadow', 'wavo' ),
                'selector' => '{{WRAPPER}} .nt-blog-grid .item'
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_tags_style_section',
            [
                'label'=> esc_html__( 'Tags Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['type' => '1']
            ]
        );
        $this->wavo_style_typo( 'post_tags_typo','{{WRAPPER}} .nt-blog .item .content .tags' );
        $this->wavo_style_color( 'post_tags_color','{{WRAPPER}} .nt-blog .item .content .tags' );
        $this->wavo_style_padding( 'post_tags_padding','{{WRAPPER}} .nt-blog .item .content .tags' );
        $this->wavo_style_margin( 'post_tags_margin','{{WRAPPER}} .nt-blog .item .content .tags' );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_meta_style_section',
            [
                'label'=> esc_html__( 'Meta Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['hidemeta!' => 'yes']
            ]
        );
        $this->wavo_style_typo( 'post_meta_typo','{{WRAPPER}} .nt-blog .item .content .info a, {{WRAPPER}} .nt-blog-grid .item .info a' );
        $this->wavo_style_color( 'post_meta_color','{{WRAPPER}} .nt-blog .item .content .info a, {{WRAPPER}} .nt-blog-grid .item .info a' );
        $this->wavo_style_padding( 'post_meta_padding','{{WRAPPER}} .nt-blog .item .content .info a, {{WRAPPER}} .nt-blog-grid .item .info a' );
        $this->wavo_style_margin( 'post_meta_margin','{{WRAPPER}} .nt-blog .item .content .info a, {{WRAPPER}} .nt-blog-grid .item .info a' );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_title_style_section',
            [
                'label'=> esc_html__( 'Title Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['hidetitle!' => 'yes']
            ]
        );
        $this->wavo_style_typo( 'post_title_typo','{{WRAPPER}} .nt-blog .item .content .title h4 a,{{WRAPPER}} .nt-blog-grid .item .post--title a' );
        $this->wavo_style_color( 'post_title_color','{{WRAPPER}} .nt-blog .item .content .title h4 a,{{WRAPPER}} .nt-blog-grid .item .post--title a' );
        $this->add_control( 'post_title_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .nt-blog .item .content .title h4 a:hover,{{WRAPPER}} .nt-blog-grid .item .post--title a:hover' => 'color:{{VALUE}};' ],
            ]
        );
        $this->wavo_style_padding( 'post_title_padding','{{WRAPPER}} .nt-blog .item .content .title h4 a,{{WRAPPER}} .nt-blog-grid .item .post--title a' );
        $this->wavo_style_margin( 'post_title_margin','{{WRAPPER}} .nt-blog .item .content .title h4 a,{{WRAPPER}} .nt-blog-grid .item .post--title a' );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_text_style_section',
            [
                'label'=> esc_html__( 'Excerpt Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['hideexcerpt!' => 'yes']
            ]
        );
        $this->wavo_style_typo( 'post_text_typo','{{WRAPPER}} .nt-blog .item .content .text p,{{WRAPPER}} .nt-blog-grid .item .cont .text p' );
        $this->wavo_style_color( 'post_text_color','{{WRAPPER}} .nt-blog .item .content .text p,{{WRAPPER}} .nt-blog-grid .item .cont .text p' );
        $this->wavo_style_padding( 'post_text_padding','{{WRAPPER}} .nt-blog .item .content .text p,{{WRAPPER}} .nt-blog-grid .item .cont .text p' );
        $this->wavo_style_margin( 'post_text_margin','{{WRAPPER}} .nt-blog .item .content .text p,{{WRAPPER}} .nt-blog-grid .item .cont .text p' );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_btn_style_section',
            [
                'label'=> esc_html__( 'Button Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wavo_style_typo( 'post_btn_typo','{{WRAPPER}} .nt-blog .item .content .more a,{{WRAPPER}} .nt-blog-grid .item .more' );
        $this->wavo_style_color( 'post_btn_color','{{WRAPPER}} .nt-blog .item .content .more a,{{WRAPPER}} .nt-blog-grid .item .more' );
        $this->add_control( 'post_btn_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .nt-blog .swiper-slide .item .content .more a:hover,{{WRAPPER}} .nt-blog-grid .item .cont .more:hover' => 'border-bottom-color:{{VALUE}};',
                    '{{WRAPPER}} .nt-blog .item .content .more a:hover,{{WRAPPER}} .nt-blog-grid .item .more:hover' => 'color:{{VALUE}};',
                ],
            ]
        );
        $this->add_control( 'post_btn_linecolor',
            [
                'label' => esc_html__( 'Border Bottom Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .nt-blog .item .content .more a,{{WRAPPER}} .nt-blog-grid .item .more' => 'border-bottom-color:{{VALUE}};' ],
            ]
        );
        $this->wavo_style_padding( 'post_btn_padding','{{WRAPPER}} .nt-blog .item .content .more a,{{WRAPPER}} .nt-blog-grid .item .more' );
        $this->wavo_style_margin( 'post_btn_margin','{{WRAPPER}} .nt-blog .item .content .more a,{{WRAPPER}} .nt-blog-grid .item .more' );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('post_box_nav_style_section',
            [
                'label'=> esc_html__( 'Nav Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['type' => '2']
            ]
        );
        $this->add_control( 'post_navs_bgcolor',
            [
                'label' => esc_html__( 'Nav Background Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .nt-blog .controls' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'post_navs_bg_after_color',
            [
                'label' => esc_html__( 'Nav Background Overlay Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .nt-blog .controls:after' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'post_navs_color',
            [
                'label' => esc_html__( 'Nav Button Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .nt-blog .controls .swiper-button-next.next-ctrl, {{WRAPPER}} .nt-blog .controls .swiper-button-prev.prev-ctrl' => 'color:{{VALUE}};' ],
                'separator' => 'before',
            ]
        );
        $this->add_control( 'post_navs_hvr_color',
            [
                'label' => esc_html__( 'Nav Button Hover Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .nt-blog .controls .swiper-button-next.next-ctrl:hover, {{WRAPPER}} .nt-blog .controls .swiper-button-prev.prev-ctrl:hover' => 'color:{{VALUE}};' ],
            ]
        );
        $this->add_control( 'post_navs_fraction_color',
            [
                'label' => esc_html__( 'Nav Fraction Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .nt-blog .controls .swiper-pagination-fraction span' => 'color:{{VALUE}};' ],
                'separator' => 'before',
            ]
        );
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $args = array(
            'post_type'        => 'post',
            'author__in'       => $settings['author_filter'],
            'author__not_in'   => $settings['author_exclude_filter'],
            'category__in'     => $settings['category_filter'],
            'category__not_in' => $settings['category_exclude_filter'],
            'tag__in'          => $settings['tag_filter'],
            'tag__not_in'      => $settings['tag_exclude_filter'],
            'post__in'         => $settings['post_filter'],
            'post__not_in'     => $settings['post_exclude_filter'],
            'posts_per_page'   => $settings['post_per_page'],
            'offset'           => $settings['offset'],
            'order'            => $settings['order'],
            'orderby'          => $settings['orderby'],
        );
        $speed     = $settings['speed'] ? $settings['speed'] : 1000;
        $autoplay  = 'yes' == $settings['autoplay'] ? 'true' : 'false';
        $loop      = 'yes' == $settings['loop'] ? 'true' : 'false';

        $the_query = new \WP_Query( $args );
        if( $the_query->have_posts() ) {
            if ( '1' == $settings['type'] ) {
                echo '<div class="nt-blog" data-slider-settings=\'{"autoplay":'.$autoplay.',"loop":'.$loop.',"speed":'.$speed.'}\'>';
                    echo '<div class="stories bg-img no-cover bg-pattern" data-wavo-background="'.$settings['pattern_img']['url'].'">';
                        echo '<div class="container-fluid">';
                            echo '<div class="row">';
                                echo '<div class="col-lg-6 no-padding">';
                                    echo '<div class="swiper-container swiper-img">';
                                        echo '<div class="swiper-wrapper">';

                                            while ($the_query->have_posts()) {
                                                $the_query->the_post();
                                                if( has_post_thumbnail() ) {
                                                    echo '<div class="swiper-slide">';
                                                        echo '<div class="item wow fadeIn" data-wow-delay=".2s">';
                                                            echo '<div class="img">';
                                                                the_post_thumbnail( $settings['thumbnail_size'] );
                                                            echo '</div>';
                                                        echo '</div>';
                                                    echo '</div>';
                                                }
                                            }
                                            wp_reset_postdata();

                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';

                                echo '<div class="col-lg-6 no-padding valign">';
                                    echo '<div class="swiper-container swiper-content">';
                                        echo '<div class="swiper-wrapper">';

                                            while ($the_query->have_posts()) {
                                                $the_query->the_post();
                                                if( has_post_thumbnail() ) {
                                                    echo '<div class="swiper-slide">';
                                                        echo '<div class="item wow fadeIn" data-wow-delay=".2s">';
                                                            echo '<div class="content">';

                                                                if ( 'yes' != $settings[ 'hidemeta' ] ) {

                                                                    if ( has_tag() ) {
                                                                        echo '<div class="tags">';
                                                                            the_tags( '', ' | ', '' );
                                                                        echo '</div>';
                                                                    }

                                                                    $post_author = get_author_posts_url( get_the_author_meta( 'ID' ) );
                                                                    echo '<div class="info">';
                                                                        echo '<a href="'.get_permalink().'"><i class="far fa-clock"></i> '.get_the_date().'</a>';
                                                                        echo '<a href="'.$post_author.'">by '.get_the_author().'</a>';
                                                                    echo '</div>';
                                                                }

                                                                if ( 'yes' != $settings[ 'hidetitle' ] ) {
                                                                    echo '<div class="title"><h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4></div>';
                                                                }

                                                                if ( 'yes' != $settings[ 'hideexcerpt' ] ) {
                                                                    if ( has_excerpt() ) {
                                                                        echo '<div class="text"><p>'.wp_trim_words( get_the_excerpt(), $settings['excerpt_limit'] ).'</p></div>';
                                                                    } else {
                                                                        echo '<div class="text"><p>'.wp_trim_words( trim( strip_tags( get_the_content() ) ), $settings['excerpt_limit'] ).'</p></div>';
                                                                    }
                                                                }

                                                                if ( $settings[ 'btn_title' ] ){
                                                                    echo '<div class="more"><a href="'.get_permalink().'">'.$settings[ 'btn_title' ].'</a></div>';
                                                                }

                                                            echo '</div>';
                                                        echo '</div>';
                                                    echo '</div>';
                                                }
                                            }
                                            wp_reset_postdata();

                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';

                            echo '<div class="controls">
                                <div class="swiper-button-next swiper-nav-ctrl next-ctrl"><i class="fas fa-caret-up"></i></div>
                                <div class="swiper-button-prev swiper-nav-ctrl prev-ctrl"><i class="fas fa-caret-down"></i></div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>';
            }

            if ( '2' == $settings['type'] ) {
                echo '<div class="nt-blog-grid">';
                    echo '<div class="stories bg-img no-cover bg-pattern" data-wavo-background="'.$settings['pattern_img']['url'].'"></div>';
                    echo '<div class="container-off">';
                        echo '<div class="row">';
                            $count = 3;
                            while ($the_query->have_posts()) {
                                $the_query->the_post();
                                $delay = $count / 10;
                                $count++;
                                echo '<div class="col-lg-'.$settings['column'].'">';
                                    echo '<div class="item wow fadeInUp md-mb50" data-wow-delay="'.$delay.'s">';

                                        if ( has_post_thumbnail() ) {
                                            echo '<div class="post-img"><div class="img">';
                                                the_post_thumbnail($settings['thumbnail_size']);
                                            echo '</div></div>';
                                        }

                                        echo '<div class="cont">';
                                            if ( 'yes' != $settings[ 'hidemeta' ] ) {
                                                echo '<div class="info">';
                                                    wavo_post_meta_author();
                                                    wavo_post_meta_date();
                                                echo '</div>';
                                            }

                                            if ( 'yes' != $settings[ 'hidetitle' ] ) {
                                                printf( '<h5 class="post--title"><a href="%s" title="%s">%s</a></h5>',
                                                    get_permalink(),
                                                    the_title_attribute( 'echo=0' ),
                                                    get_the_title()
                                                );
                                            }

                                            if ( 'yes' != $settings[ 'hideexcerpt' ] ) {
                                                if ( has_excerpt() ) {
                                                    echo '<div class="text mb-15"><p>'.wp_trim_words( get_the_excerpt(), $settings['excerpt_limit'] ).'</p></div>';
                                                } else {
                                                    echo '<div class="text mb-15"><p>'.wp_trim_words( trim( strip_tags( get_the_content() ) ), $settings['excerpt_limit'] ).'</p></div>';
                                                }
                                            }

                                            if ( $settings[ 'btn_title' ] ) {
                                                echo '<a class="more" href="'.get_permalink().'"><span>'.$settings[ 'btn_title' ].' <i class="icofont-caret-right"></i></span></a>';
                                            }

                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            }
                            wp_reset_postdata();

                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }

        } else {
            echo '<p class="text">' . esc_html__( 'No post found!', 'wavo' ) . '</p>';
        }
    }
}
