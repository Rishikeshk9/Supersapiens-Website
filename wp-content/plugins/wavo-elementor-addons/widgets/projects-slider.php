<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wavo_Projects_Slider extends Widget_Base {
    use Wavo_Helper;
    public function get_name() {
        return 'wavo-projects-slider';
    }
    public function get_title() {
        return 'Projects Slider (N)';
    }
    public function get_icon() {
        return 'eicon-slider-push';
    }
    public function get_categories() {
        return [ 'wavo-cpt' ];
    }
    public function get_style_depends() {
        return [ 'swiper' ];
    }
    public function get_script_depends() {
        return [ 'swiper' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'nt_post_query',
            [
                'label' => esc_html__( 'Query', 'wavo' ),
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
        $this->add_control( 'type',
            [
                'label' => esc_html__( 'Type', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => 'true',
                'default' => '1',
                'options' => [
                    '1' => esc_html__( 'Type 1', 'wavo' ),
                    '2' => esc_html__( 'Type 2', 'wavo' ),
                    '3' => esc_html__( 'Type 3', 'wavo' )
                ]
            ]
        );
        $this->add_control( 'btn_title',
            [
                'label' => esc_html__( 'Button Title', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Discover Work',
                'label_block' => true,
                'condition' => ['type' => '2']
            ]
        );
        $this->add_control( 'category_exclude',
            [
                'label' => esc_html__( 'Exclude Category', 'elementories' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->wavo_cpt_taxonomies(array ( 'taxonomy' => 'projects_cat','hide_empty' => true) ),
                'description' => 'Select Category(s) to Exclude',
                'condition' => ['query_type!' => 'custom']
            ]
        );
        $this->add_control( 'separator',
            [
                'label' => esc_html__( 'Category Separator', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'default' => ' & ',
            ]
        );
        $this->add_control( 'tags_exclude',
            [
                'label' => esc_html__( 'Exclude Tags', 'elementories' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->wavo_cpt_taxonomies( array ( 'taxonomy' => 'projects_tag','hide_empty' => true) ),
                'description' => 'Select Category(s) to Exclude',
                'condition' => ['query_type!' => 'custom']
            ]
        );
        $this->add_control( 'post_exclude',
            [
                'label' => esc_html__( 'Exclude Post', 'wavo' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->wavo_cpt_get_post_title( 'projects' ),
                'description' => 'Select Post(s) to Exclude',
                'separator' => 'before',
                'condition' => ['query_type!' => 'custom']
            ]
        );
        $this->add_control( 'post_per_page',
            [
                'label' => esc_html__( 'Posts Per Page', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000,
                'default' => 2,
                'separator' => 'before',
                'condition' => ['query_type!' => 'custom']
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
                'default' => 'ASC',
                'separator' => 'before',
                'condition' => ['query_type!' => 'custom']
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
                'default' => 'none',
                'separator' => 'before',
                'condition' => ['query_type!' => 'custom']
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
            'name' => 'thumbnail',
            'separator' => 'none',
            'default' => 'full',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   END CONTROLS SECTION   ******/
        $this->start_controls_section( 'custom_query_section',
            [
                'label' => esc_html__( 'Custom Query', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => ['query_type' => 'custom']
            ]
        );
        $this->wavo_query_controls( 'projects' );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   END CONTROLS SECTION   ******/
        $this->start_controls_section( 'projects_slider_section',
            [
                'label' => esc_html__( 'Slider Options', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'perview',
            [
                'label' => esc_html__( 'Per View', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 2
            ]
        );
        $this->add_control( 'mdperview',
            [
                'label' => esc_html__( 'Per View 1024px', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 2
            ]
        );
        $this->add_control( 'smperview',
            [
                'label' => esc_html__( 'Per View 768px', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 2
            ]
        );
        $this->add_control( 'xsperview',
            [
                'label' => esc_html__( 'Per View 480px', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 1,
                'default' => 1
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
                'default' => 'yes',
            ]
        );
        $this->add_control( 'loop',
            [
                'label' => esc_html__( 'Loop', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control( 'nav',
            [
                'label' => esc_html__( 'Navigation', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control( 'progress',
            [
                'label' => esc_html__( 'Progress bar', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control( 'spacenone',
            [
                'label' => esc_html__( 'Disable Space Between Items', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'selectors' => [ '{{WRAPPER}} .work-carousel .swiper-slide' => 'padding: 0;' ],
                'condition' => ['type' => '1']
            ]
        );
        $this->add_control( 'space',
            [
                'label' => esc_html__( 'Custom Space Between Items', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .work-carousel .swiper-slide' => 'padding: {{VALUE}}px;',
                    '{{WRAPPER}} .slider-portfolio .swiper-slide' => 'margin-right: {{VALUE}}px;'
                ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   END CONTROLS SECTION   ******/
        $this->start_controls_section( 'projects_slider_image_style_section',
            [
                'label' => esc_html__( 'Image Box Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'grayscale',
            [
                'label' => esc_html__( 'Gray Effect', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->wavo_style_border( 'projects_slider_image_border', '{{WRAPPER}} .swiper-slide' );
        $this->wavo_style_padding( 'projects_slider_image_padding', '{{WRAPPER}} .swiper-slide' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   END CONTROLS SECTION   ******/
        $this->start_controls_section( 'projects_slider_heading_style_section',
            [
                'label' => esc_html__( 'Text Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_responsive_control( 'projects_post_text_alignment',
            [
                'label' => esc_html__( 'Alignment', 'wavo' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .work-carousel .content .cont' => 'text-align: {{VALUE}};width:100%;left:0;padding:0 40px;'],
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
                'default' => ''
            ]
        );
        $this->add_control( 'projects_post_text_hvr_color',
            [
                'label' => esc_html__( 'Link Hover Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .work-carousel .content .cont .projects-post-title a:hover,
                    {{WRAPPER}} .work-carousel .content .cont .projects-post-cats a:hover' => 'color:{{VALUE}};'
                ],
            ]
        );
        $this->add_control( 'projects_post_title_heading',
            [
                'label' => esc_html__( 'POST TITLE', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->wavo_style_color( 'projects_post_title_color', '{{WRAPPER}} .work-carousel .content .cont .projects-post-title' );
        $this->wavo_style_typo( 'projects_post_title_typo', '{{WRAPPER}} .work-carousel .content .cont .projects-post-title' );

        $this->add_control( 'projects_post_cats_heading',
            [
                'label' => esc_html__( 'POST CATEGORY(S)', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->wavo_style_color( 'projects_post_cats_color', '{{WRAPPER}} .work-carousel .content .cont .projects-post-cats' );
        $this->wavo_style_typo( 'projects_post_cats_typo', '{{WRAPPER}} .work-carousel .content .cont .projects-post-cats' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('projects_slider_nav_style_section',
            [
                'label'=> esc_html__( 'Nav Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->start_controls_tabs( 'projects_slider_nav_tabs');
        $this->start_controls_tab( 'projects_slider_nav_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'wavo' ) ]
        );

        $this->wavo_style_bgcolor( 'projects_slider_nav_background','{{WRAPPER}} .work-carousel .swiper-button-next, {{WRAPPER}} .work-carousel .swiper-button-prev' );
        $this->wavo_style_color( 'projects_slider_color','{{WRAPPER}} .work-carousel .swiper-button-next, {{WRAPPER}} .work-carousel .swiper-button-prev' );
        $this->wavo_style_border( 'projects_slider_border','{{WRAPPER}} .work-carousel .swiper-button-next, {{WRAPPER}} .work-carousel .swiper-button-prev' );
        $this->end_controls_tab();

        $this->start_controls_tab( 'projects_slider_nav_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wavo' ) ]
        );

        $this->wavo_style_bgcolor( 'projects_slider_nav_hvr_background','{{WRAPPER}} .work-carousel .swiper-button-next:hover, {{WRAPPER}} .work-carousel .swiper-button-prev:hover' );
        $this->wavo_style_color( 'projects_slider_hvr_color','{{WRAPPER}} .work-carousel .swiper-button-next:hover, {{WRAPPER}} .work-carousel .swiper-button-prev:hover' );
        $this->wavo_style_border( 'projects_slider_hvr_border','{{WRAPPER}} .work-carousel .swiper-button-next:hover, {{WRAPPER}} .work-carousel .swiper-button-prev:hover' );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control( 'projects_slider_prev_heading',
            [
                'label' => esc_html__( 'PREV POSITION', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'projects_slider_prev_horizontal',
            [
                'label' => esc_html__( 'Horizontal Position ( % )', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .work-carousel .swiper-button-prev' => 'left:{{SIZE}}%;' ],
            ]
        );
        $this->add_responsive_control( 'projects_slider_prev_vertical',
            [
                'label' => esc_html__( 'Vertical Position ( % )', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .work-carousel .swiper-button-prev' => 'top:{{SIZE}}%;' ],
            ]
        );
        $this->add_control( 'projects_slider_next_heading',
            [
                'label' => esc_html__( 'NEXT POSITION', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'projects_slider_next_horizontal',
            [
                'label' => esc_html__( 'Horizontal Position ( % )', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .work-carousel .swiper-button-next' => 'left:{{SIZE}}%;' ],
            ]
        );
        $this->add_responsive_control( 'projects_slider_next_vertical',
            [
                'label' => esc_html__( 'Vertical Position ( % )', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .work-carousel .swiper-button-next' => 'top:{{SIZE}}%;' ],
            ]
        );
        $this->add_control( 'projects_slider_progressbar_color',
            [
                'label' => esc_html__( 'Progressbar Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .work-carousel .swiper-pagination-progressbar .swiper-pagination-progressbar-fill' => 'background-color:{{VALUE}};' ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control( 'projects_slider_progresbar_height',
            [
                'label' => esc_html__( 'Progressbar Height', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .work-carousel .swiper-container-horizontal>.swiper-pagination-progressbar' => 'height:{{SIZE}}px;' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $settingsid = $this->get_id();

        $speed     = $settings['speed'] ? $settings['speed'] : 1000;
        $perview   = $settings['perview'] ? $settings['perview'] : 3;
        $mdperview = $settings['mdperview'] ? $settings['mdperview'] : 3;
        $smperview = $settings['smperview'] ? $settings['smperview'] : 2;
        $xsperview = $settings['xsperview'] ? $settings['xsperview'] : 2;
        $spacenone = 'yes' == $settings['spacenone'] ? 'true' : 'false';
        $space     = $settings['space'] ? $settings['space'] : 30;
        $autoplay  = 'yes' == $settings['autoplay'] ? 'true' : 'false';
        $loop      = 'yes' == $settings['loop'] ? 'true' : 'false';
        $progress  = 'yes' == $settings['progress'] ? 'true' : 'false';
        $nav       = 'yes' == $settings['nav'] ? 'true' : 'false';
        $gray      = 'yes' == $settings['grayscale'] ? ' gray' : ' gray-none';
        $separator = $settings['separator'] ? $settings['separator'] : ' & ';
        $post_type = '';
        if ( 'custom' == $settings['query_type'] ) {

            $post_type = $settings['post_type'];

            $args['post_type']      = $settings['post_type'];
            $args['posts_per_page'] = $settings['posts_per_page'];
            $args['offset']         = $settings['offsets'];
            $args['order']          = $settings['orders'];
            $args['orderby']        = $settings['orderbys'];
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
                'post__not_in'   => $settings['post_exclude'],
                'posts_per_page' => $settings['post_per_page'],
                'order'          => $settings['order'],
                'orderby'        => $settings['orderby'],
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

        $the_query = new \WP_Query( $args );
        if( $the_query->have_posts() ) {

            if ( '2' == $settings['type'] ) {

                echo '<div class="slider-portfolio slider-scroll slide-controls" data-slider-settings=\'{"space": '.$space.',"nav":'.$nav.',"progress":'.$progress.',"autoplay":'.$autoplay.',"loop":'.$loop.',"speed":'.$speed.',"perview":'.$perview.',"mdperview":'.$mdperview.',"smperview":'.$smperview.',"xsperview":'.$xsperview.'}\'>';
                    echo '<div class="swiper-container">';
                        echo '<div class="swiper-wrapper">';
                            $count = 1;
                            while ( $the_query->have_posts() ) {
                                $the_query->the_post();
                                $delay = $count * 100;
                                if ( has_post_thumbnail() ) {
                                    $image_id = get_post_thumbnail_id();
                                    $image_url = get_the_post_thumbnail_url( get_the_ID(), $settings['thumbnail_size'] );

                                    echo '<div class="swiper-slide">';
                                        echo '<div class="bg-img valign" style="background-image:url(' . $image_url . ')" data-overlay-dark="3">';
                                            echo '<div class="caption">';
                                                echo '<h1 data-splitting><a href="' . get_permalink() . '">' . get_the_title() . '</a></h1>';
                                                if ( '' != $settings['btn_title'] ) {
                                                    echo '<a href="' . get_permalink() . '" class="dis">'.$settings['btn_title'].'</a>';
                                                }
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                }
                            }

                        echo '</div>';

                        if ( 'yes' == $settings['nav'] ) {
                            echo '<div class="swiper-button-next swiper-nav-ctrl next-ctrl"><i class="fas fa-caret-right"></i></div>
                            <div class="swiper-button-prev swiper-nav-ctrl prev-ctrl"><i class="fas fa-caret-left"></i></div>';
                        }
                        if ( 'yes' == $settings['progress'] ) {
                            echo '<div class="swiper-pagination"></div>';
                        }
                    echo '</div>';
                echo '</div>';

            } else {

                echo '<div class="work-carousel metro'.$gray.'" data-slider-settings=\'{"nav":'.$nav.',"progress":'.$progress.',"autoplay":'.$autoplay.',"loop":'.$loop.',"speed":'.$speed.',"perview":'.$perview.',"mdperview":'.$mdperview.',"smperview":'.$smperview.',"xsperview":'.$xsperview.'}\'>';
                    echo '<div class="swiper-container">';
                        echo '<div class="swiper-wrapper">';
                            $count = 1;
                            while ( $the_query->have_posts() ) {
                                $the_query->the_post();
                                $delay = $count * 100;
                                if ( has_post_thumbnail() ) {
                                    echo '<div class="swiper-slide">';
                                        echo '<div class="content type-'.$settings['type'].'">';
                                            echo '<div class="img">';
                                                $image_id = get_post_thumbnail_id();
                                                $image = Group_Control_Image_Size::get_attachment_image_src( $image_id, 'thumbnail', $settings );
                                                $imagealt = esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true));
                                                $cimgio = ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) ? 'cimgioo' :  'cimgio';

                                                if ( '3' == $settings['type'] ) {
                                                    $img1 = 'style="background-image: url('.get_the_post_thumbnail_url().')"';
                                                    $img2 = 'data-wavo-background="'.get_the_post_thumbnail_url().'"';
                                                    $img  = \Elementor\Plugin::$instance->editor->is_edit_mode() ? $img1 : $img2;

                                                    echo '<div class="bg-img" '.$img.'></div>';

                                                } else {

                                                    echo '<span class="imgio">';
                                                        echo '<span class="wow '.$cimgio.'" data-delay="'.$delay.'"></span>';
                                                        if ( 'custom' == $settings['thumbnail_size'] ) {

                                                            echo '<img src="'.$image.'" alt="'.$imagealt.'">';

                                                        } else {

                                                            echo get_the_post_thumbnail( get_the_ID(), $settings['thumbnail_size'] );

                                                        }
                                                    echo '</span>';

                                                }
                                            echo '</div>';
                                            echo '<div class="cont">';

                                                $terms = get_the_terms( get_the_ID() , 'projects_cat' );

                                                if ( 'custom' == $settings['query_type'] && 'post' == $post_type ) {
                                                    $terms = get_the_terms( get_the_ID() , 'category' );
                                                }

                                                $i = 1;
                                                if( $terms ) {
                                                    echo '<h6 class="projects-post-cats">';
                                                    foreach ( $terms as $term ) {
                                                        $term_link = get_term_link( $term, array( 'projects_cat' ) );
                                                         if( !is_wp_error( $term_link ) ) {
                                                             echo '<a href="' . $term_link . '" title="' . $term->name . '">' . $term->name . '</a>';
                                                             echo ( $i < count( $terms ) ) ? $separator : "";
                                                         }
                                                         $i++;
                                                    }
                                                    echo '</h6>';
                                                }
                                                echo '<h4 class="projects-post-title"><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h4>';
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                    $count++;
                                }
                            }

                        echo '</div>';

                        if ( 'yes' == $settings['nav'] ) {
                            echo '<div class="swiper-button-next swiper-nav-ctrl next-ctrl"><i class="ion-ios-arrow-right"></i></div>
                            <div class="swiper-button-prev swiper-nav-ctrl prev-ctrl"><i class="ion-ios-arrow-left"></i></div>';
                        }
                        if ( 'yes' == $settings['progress'] ) {
                            echo '<div class="swiper-pagination"></div>';
                        }

                    echo '</div>
                </div>';
            }

        } else {
                echo '<p class="text">No post found!</p>';
        }
        wp_reset_postdata();

    }
}
