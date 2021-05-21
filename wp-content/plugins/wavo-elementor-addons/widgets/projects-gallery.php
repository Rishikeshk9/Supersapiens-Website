<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wavo_Projects_Gallery extends Widget_Base {
    use Wavo_Helper;
    public function get_name() {
        return 'wavo-projects-gallery';
    }
    public function get_title() {
        return 'Projects Gallery (N)';
    }
    public function get_icon() {
        return 'eicon-gallery-grid';
    }
    public function get_categories() {
        return [ 'wavo-cpt' ];
    }
    public function get_script_depends() {
        return [ 'isotope','wow' ];
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
        // Category Filter Heading
        $this->add_control( 'category_filter_heading',
            [
                'label' => esc_html__( 'Category Filter', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'condition' => ['query_type!' => 'custom']
            ]
        );
        // Exclude Category
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
        // Exclude Category
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
        // Other Filter Heading
        $this->add_control( 'posts_other_heading',
            [
                'label' => esc_html__( 'Other Filter', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => ['query_type!' => 'custom']
            ]
        );
        // Posts Per Page
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
        // Order
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
        // Other Filter Heading
        $this->add_control( 'post_column_heading',
            [
                'label' => esc_html__( 'Column', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'layoutmode',
            [
                'label' => esc_html__( 'Layout Mode', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => 'true',
                'default' => 'fitRows',
                'options' => [
                    'fitRows' => esc_html__( 'Fit Rows', 'wavo' ),
                    'masonry' => esc_html__( 'masonry', 'wavo' ),
                ]
            ]
        );
        $this->add_control( 'column',
            [
                'label' => esc_html__( 'Column Width', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'label_block' => 'true',
                'default' => '4',
                'options' => [
                    '6' => esc_html__( '2 Column', 'wavo' ),
                    '4' => esc_html__( '3 Column', 'wavo' ),
                    '3' => esc_html__( '4 Column', 'wavo' )
                ]
            ]
        );

        $this->add_responsive_control( 'gaphor',
            [
                'label' => esc_html__( 'Gap Horizontal', 'plugin-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 15
                ],
                'selectors' => ['{{WRAPPER}} .portfolio .gallery .items' => 'padding: 0 {{SIZE}}{{UNIT}};']
            ]
        );
        $this->add_responsive_control( 'gapver',
            [
                'label' => esc_html__( 'Gap Vertical', 'plugin-domain' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 40
                ],
                'selectors' => ['{{WRAPPER}} .portfolio .gallery .items' => 'margin-top: {{SIZE}}{{UNIT}};']
            ]
        );
        $this->add_control( 'hidetitle',
            [
                'label' => esc_html__( 'Hide Post Title', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'wavo' ),
                'label_off' => esc_html__( 'No', 'wavo' ),
                'return_value' => 'yes',
                'default' => 'no',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'hideexcerpt',
            [
                'label' => esc_html__( 'Hide Excerpt', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes',
                'separator' => 'before',
            ]
        );
        $this->add_control( 'excerpt_limit',
            [
                'label' => esc_html__( 'Excerpt Word Limit', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'default' => 20,
                'condition' => [ 'hideexcerpt!' => 'yes' ]
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
        $this->start_controls_section( 'post_filter_section',
            [
                'label' => esc_html__( 'Filters', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'hide_filters',
            [
                'label' => esc_html__( 'Hide Filters', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes'
            ]
        );
        $this->add_control( 'all_text',
            [
                'label' => esc_html__( 'All Text', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'All',
                'label_block' => true,
                'condition' => [ 'hide_filters!' => 'yes' ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'projects_gallery_style_section',
            [
                'label' => esc_html__( 'Item Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'projects_gallery_image_heading',
            [
                'label' => esc_html__( 'IMAGE', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->wavo_style_border( 'projects_gallery_image_border', '{{WRAPPER}} .portfolio .gallery .items .item-img' );
        $this->wavo_style_padding( 'projects_gallery_image_padding', '{{WRAPPER}} .portfolio .gallery .items .item-img' );

        $this->add_control( 'projects_post_title_heading',
            [
                'label' => esc_html__( 'TITLE', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->wavo_style_color( 'projects_gallery_title_color', '{{WRAPPER}} .portfolio .gallery .items .overlay-info h5' );
        $this->wavo_style_typo( 'projects_gallery_title_typo', '{{WRAPPER}} .portfolio .gallery .items .overlay-info h5' );

        $this->add_control( 'projects_post_excerpt_heading',
            [
                    'label' => esc_html__( 'EXCERPT', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->wavo_style_color( 'projects_gallery_excerpt_color', '{{WRAPPER}} .portfolio .gallery .items .overlay-info P' );
        $this->wavo_style_typo( 'projects_gallery_excerpt_typo', '{{WRAPPER}} .portfolio .gallery .items .overlay-info P' );
        $this->wavo_style_padding( 'projects_gallery_excerpt_padding', '{{WRAPPER}} .portfolio .gallery .items .overlay-info P' );
        $this->wavo_style_margin( 'projects_gallery_excerpt_margin', '{{WRAPPER}} .portfolio .gallery .items .overlay-info P' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'projects_gallery_filter_style_section',
            [
                'label' => esc_html__( 'Fılter Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [ 'hide_filters!' => 'yes' ]
            ]
        );
        $this->add_responsive_control( 'projects_gallery_filter_alignment',
            [
                'label' => esc_html__( 'Alignment', 'wavo' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .portfolio .filter' => 'text-align: {{VALUE}};'],
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
        $this->add_responsive_control( 'projects_gallery_filter_space',
            [
                'label' => esc_html__( 'Space Between Item', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .portfolio .filtering span' => 'margin:0 {{SIZE}}px;' ],
            ]
        );
        $this->start_controls_tabs( 'projects_gallery_filter_tabs');
        $this->start_controls_tab( 'projects_gallery_filter_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'wavo' ) ]
        );
        $this->wavo_style_color( 'projects_slider_color','{{WRAPPER}} .portfolio .filtering span' );
        $this->wavo_style_bgcolor( 'projects_gallery_filter_background','{{WRAPPER}} .portfolio .filtering span' );
        $this->end_controls_tab();

        $this->start_controls_tab( 'projects_gallery_filter_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wavo' ) ]
        );
        $this->wavo_style_color( 'projects_gallery_filter_hvr_color','{{WRAPPER}} .portfolio .filtering span:hover, {{WRAPPER}} .portfolio .filtering span.active' );
        $this->wavo_style_bgcolor( 'projects_gallery_filter_hvr_background','{{WRAPPER}} .portfolio .filtering span:hover, {{WRAPPER}} .portfolio .filtering span.active' );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control( 'projects_gallery_filter_point_heading',
            [
                'label' => esc_html__( 'FILTER POINT', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control( 'projects_gallery_filter_point_color',
            [
                'label' => esc_html__( 'Filter Point Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .portfolio .filtering span:after' => 'background-color:{{VALUE}};' ],
            ]
        );
        $this->add_responsive_control( 'projects_gallery_filter_point_position',
            [
                'label' => esc_html__( 'Filter Point Position', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => -100,
                'max' => 100,
                'step' => 1,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .portfolio .filtering span:after' => 'right:{{SIZE}}px;' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $settingsid = $this->get_id();

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
                'posts_per_page' => $settings['per_page'],
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
            echo '<div class="portfolio" id="gallery-'.$settingsid.'">';
                echo '<div class="container-off">';
                    echo '<div class="row">';

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

                        if ( 'yes' != $settings['hide_filters'] && $cats > 1 ) {
                            echo '<div class="filtering col-12">';
                                echo '<div class="filter">';
                                    echo '<span data-filter=\'*\' class="active">'.$settings['all_text'].'</span>';
                                    foreach ( $cats as $cat ) {
                                        $filter = mb_strtolower( str_replace(' ', '-', $cat->name ) );
                                        echo '<span data-filter=\'.'.$filter.'\'>'.$cat->name.'</span>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        }

                        echo '<div class="gallery full-width" data-layout-mode="'.$settings['layoutmode'].'">';
                        echo '<div class="grid-sizer col-md-'.$settings['column'].'"></div>';
                            $count = 3;
                            while ( $the_query->have_posts() ) {
                                $the_query->the_post();
                                $delay = $count / 10;
                                $count++;
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
                                        } else {
                                            $tax = '';
                                        }
                                    }

                                    echo '<div class="col-md-'.$settings['column'].' '.$tax.' items wavo-project-id-'.get_the_ID().'" data-project-id="'.get_the_ID().'">';
                                        echo '<div class="item-img wow fadeInUp">';
                                        if ( !( \Elementor\Plugin::$instance->editor->is_edit_mode() ) ) {
                                            echo '<div class="item-img-overlay-two wow2"></div>';
                                        }
                                            echo '<a href="' . get_permalink() . '">';
                                                echo get_the_post_thumbnail( get_the_ID(), 'full' );
                                                echo '<div class="item-img-overlay valign">';
                                                    echo '<div class="overlay-info full-width">';
                                                        if ( 'yes' != $settings['hidetitle'] ) {
                                                            echo '<h5 data-splitting>' . get_the_title() . '</h5>';
                                                        }
                                                        if ( has_excerpt() && 'yes' != $settings['hideexcerpt'] ) {
                                                            echo wpautop( wp_trim_words( get_the_excerpt(), $settings['excerpt_limit'] ) );
                                                        }
                                                    echo '</div>';
                                                echo '</div>';
                                            echo '</a>';
                                        echo '</div>';
                                    echo '</div>';
                                }
                            }
                            wp_reset_postdata();
                        echo '</div>';

                    echo '</div>';
                echo '</div>';
            echo '</div>';
            if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) { ?>
                <script>

                //jQuery(document).ready( function ($) {

                    var myGallery = jQuery( '#gallery-<?php echo esc_attr($settingsid); ?>' );
                    var myIsotope = myGallery.find(".gallery");
                    var myFilters = myGallery.find(".filtering");
                    if ( myGallery ) {
                        myGallery.isotope(
                            {
                                itemSelector: '.items',
                                layoutMode: '<?php echo $settings['layoutmode']; ?>'
                            }
                        );
                        var $gallery = myIsotope.isotope();
                        myFilters.on('click', 'span', function () {
                            var filterValue = jQuery(this).attr('data-filter');
                            $gallery.isotope({
                                filter: filterValue
                            });
                        });
                        myFilters.on('click', 'span', function () {
                            jQuery(this).addClass('active').siblings().removeClass('active');
                            myIsotope.find('.item-img').removeClass('wow fadeInUp').removeAttr('style');
                            myIsotope.find('.item-img-overlay-two').removeClass('item-img-overlay-two wow2').removeAttr('style');
                        });
                    }

                //});

                </script>
                <?php
            }
        } else {
            echo '<p class="text">'.esc_html__('No post found!','wavo').'</p>';
        }

    }
}
