<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wavo_Blog_Grid_Two extends Widget_Base {
    use Wavo_Helper;
    public function get_name() {
        return 'wavo-blog-grid-two';
    }
    public function get_title() {
        return 'Blog Grid (N)';
    }
    public function get_icon() {
        return 'eicon-gallery-grid';
    }
    public function get_categories() {
        return [ 'wavo' ];
    }
    public function get_style_depends() {
        return [ 'swiper' ];
    }
    public function get_script_depends() {
        return [ 'swiper','wow' ];
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
        $this->add_control( 'pagination',
            [
                'label' => esc_html__( 'Pagination', 'betakit' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before'
            ]
        );
        $this->add_control( 'pag_prev',
            [
                'label' => esc_html__( 'Pagination Prev Text', 'betakit' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'PREV',
                'condition' => ['pagination' => 'yes']
            ]
        );
        $this->add_control( 'pag_next',
            [
                'label' => esc_html__( 'Pagination Next Text', 'betakit' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'NEXT',
                'condition' => ['pagination' => 'yes']
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
        $this->add_control( 'box_type',
            [
                'label' => esc_html__( 'Box Type', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => esc_html__( 'Type 1', 'wavo' ),
                    '2' => esc_html__( 'Type 2', 'wavo' ),
                ],
                'default' => '1'
            ]
        );
        $this->add_control( 'collg',
            [
                'label' => esc_html__( 'Column for Large Device', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '3' => esc_html__( '4 Column', 'wavo' ),
                    '4' => esc_html__( '3 Column', 'wavo' ),
                    '6' => esc_html__( '2 Column', 'wavo' ),
                    '12' => esc_html__( '1 Column', 'wavo' ),
                ],
                'default' => '4'
            ]
        );
        $this->add_control( 'colmd',
            [
                'label' => esc_html__( 'Column for Medium Device', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '4' => esc_html__( '3 Column', 'wavo' ),
                    '6' => esc_html__( '2 Column', 'wavo' ),
                    '12' => esc_html__( '2 Column', 'wavo' ),
                ],
                'default' => '6'
            ]
        );
        $this->add_control( 'colsm',
            [
                'label' => esc_html__( 'Column for Small Device', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '6' => esc_html__( '2 Column', 'wavo' ),
                    '12' => esc_html__( '1 Column', 'wavo' ),
                ],
                'default' => '12',
                'condition' => ['box_type' => '1']
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
        $this->add_control('gap',
            [
                'label' => esc_html__( 'Gap', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'default' => 15,
                'selectors' => [
                    '{{WRAPPER}} .nt-blog .row' => 'margin: 0 -{{SIZE}}px;',
                    '{{WRAPPER}} .nt-blog.blog-grid-two .row' => 'margin-bottom: calc( -{{SIZE}}px * 2 );',
                    '{{WRAPPER}} .nt-blog .item-column' => 'padding: 0 {{SIZE}}px;',
                    '{{WRAPPER}} .nt-blog.blog-grid-two .item-column' => 'margin-bottom: calc( {{SIZE}}px * 2 );',
                ],
                'condition' => ['box_type' => '1']
            ]
        );
        $this->add_responsive_control( 'alignment',
            [
                'label' => esc_html__( 'Content Alignment', 'wavo' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .nt-blog .item .content' => 'text-align: {{VALUE}};'],
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
                'condition' => ['box_type' => '1']
            ]
        );
        $this->add_control( 'hideanim',
            [
                'label' => esc_html__( 'Disable Animation', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => ['box_type' => '1']
            ]
        );
        $this->add_control( 'hidetitle',
            [
                'label' => esc_html__( 'Hide Title', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'hidetags',
            [
                'label' => esc_html__( 'Hide Tags', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'hidemeta',
            [
                'label' => esc_html__( 'Hide Meta', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => ['box_type' => '1']
            ]
        );
        $this->add_control( 'hidedate',
            [
                'label' => esc_html__( 'Hide Date', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => ['box_type' => '2']
            ]
        );
        $this->add_control( 'hideexcerpt',
            [
                'label' => esc_html__( 'Hide Excerpt', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
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
        $this->add_control( 'hidebtn',
            [
                'label' => esc_html__( 'Hide Button', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'btn_title',
            [
                'label' => esc_html__( 'Read More Title', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Read more',
                'label_block' => true,
                'condition' => ['hidebtn!' => 'yes']
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_box_style_section',
            [
                'label'=> esc_html__( 'Box Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['box_type' => '1']
            ]
        );
        $this->wavo_style_padding( 'post_box_padding','{{WRAPPER}} .nt-blog .item' );
        $this->wavo_style_margin( 'post_box_margin','{{WRAPPER}} .nt-blog .item' );
        //  Tabs
        $this->start_controls_tabs('post_box_tabs');
        $this->start_controls_tab( 'post_box_normal_tab',
            [ 'label' => esc_html__( 'Normal', 'wavo' ) ]
        );
        $this->wavo_style_border( 'post_box_border','{{WRAPPER}} .nt-blog .item' );
        $this->wavo_style_box_shadow( 'post_box_shadow','{{WRAPPER}} .nt-blog .item' );
        $this->end_controls_tab();
        $this->start_controls_tab('post_box_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wavo' ) ]
        );
        $this->wavo_style_border( 'post_box_hvrborder','{{WRAPPER}} .nt-blog .item:hover .content' );
        $this->wavo_style_box_shadow( 'post_box_hvrshadow','{{WRAPPER}} .nt-blog .item:hover .content' );
        $this->add_control( 'post_box_tags_hvrcolor',
            [
                'label' => esc_html__( 'Hover Tags Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog .item:hover .content .tags' => 'color: {{VALUE}};' ],
                'condition' => ['hidetags!' => 'yes']
            ]
        );
        $this->add_control( 'post_box_meta_hvrcolor',
            [
                'label' => esc_html__( 'Hover Meta Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog .item:hover .content .info a' => 'color: {{VALUE}};' ],
                'condition' => ['hidemeta!' => 'yes']
            ]
        );
        $this->add_control( 'post_box_title_hvrcolor',
            [
                'label' => esc_html__( 'Hover Title Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog .item:hover .content .title h4 a' => 'color: {{VALUE}};' ],
                'condition' => ['hidetitle!' => 'yes']
            ]
        );
        $this->add_control( 'post_box_text_hvrcolor',
            [
                'label' => esc_html__( 'Hover Excerpt Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog .item:hover .content .text' => 'color: {{VALUE}};' ],
                'condition' => ['hideexcerpt!' => 'yes']
            ]
        );
        $this->add_control( 'post_box_btn_hvrcolor',
            [
                'label' => esc_html__( 'Hover Button Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog .item:hover .content .more a' => 'color: {{VALUE}};' ],
                'condition' => ['hidebtn!' => 'yes']
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_texcontent_style_section',
            [
                'label'=> esc_html__( 'Text Content Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['box_type' => '1']
            ]
        );
        $this->wavo_style_padding( 'post_texcontent_padding','{{WRAPPER}} .nt-blog .item .content .content-footer' );
        $this->wavo_style_margin( 'post_texcontent_margin','{{WRAPPER}} .nt-blog .item .content .content-footer' );
        $this->wavo_style_border( 'post_texcontent_border','{{WRAPPER}} .nt-blog .item .content .content-footer' );
        $this->wavo_style_box_shadow( 'post_texcontent_shadow','{{WRAPPER}} .nt-blog .item .content .content-footer' );
        $this->add_control( 'post_texcontent_hvrcolor',
            [
                'label' => esc_html__( 'Background Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog .item .content .content-footer' => 'background-color: {{VALUE}};' ],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_image_style_section',
            [
                'label'=> esc_html__( 'Image Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wavo_style_padding( 'post_image_padding','{{WRAPPER}} .nt-blog .item .content .img, {{WRAPPER}} .nt-blog-pg .item .content .img' );
        $this->wavo_style_margin( 'post_image_margin','{{WRAPPER}} .nt-blog .item .content .img, {{WRAPPER}} .nt-blog-pg .item .content .img' );
        $this->wavo_style_border( 'post_image_border','{{WRAPPER}} .nt-blog .item .img, {{WRAPPER}} .nt-blog-pg .item .content .img' );
        $this->wavo_style_box_shadow( 'post_image_shadow','{{WRAPPER}} .nt-blog .item .img, {{WRAPPER}} .nt-blog-pg .item .content .img' );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_tags_style_section',
            [
                'label'=> esc_html__( 'Tags Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['hidetags!' => 'yes']
            ]
        );
        $this->wavo_style_typo( 'post_tags_typo','{{WRAPPER}} .nt-blog .item .content .tags,{{WRAPPER}} .nt-blog .item .content .tags a, {{WRAPPER}} .nt-blog-pg .posts .item .content .tags a' );
        $this->wavo_style_color( 'post_tags_color','{{WRAPPER}} .nt-blog .item .content .tags,{{WRAPPER}} .nt-blog .item .content .tags a, {{WRAPPER}} .nt-blog-pg .posts .item .content .tags a' );
        $this->add_control( 'post_tags_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog .item .content .tags a:hover, {{WRAPPER}} .nt-blog-pg .posts .item .content .tags a:hover' => 'color: {{VALUE}};' ]
            ]
        );
        $this->wavo_style_padding( 'post_tags_padding','{{WRAPPER}} .nt-blog .item .content .tags, {{WRAPPER}} .nt-blog-pg .posts .item .content .tags a' );
        $this->wavo_style_margin( 'post_tags_margin','{{WRAPPER}} .nt-blog .item .content .tags, {{WRAPPER}} .nt-blog-pg .posts .item .content .tags a' );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_meta_style_section',
            [
                'label'=> esc_html__( 'Meta Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'box_type',
                            'operator' => '==',
                            'value' => '1'
                        ],
                        [
                            'name' => 'hidemeta',
                            'operator' => '!=',
                            'value' => 'yes'
                        ]
                    ]
                ]
            ]
        );
        $this->wavo_style_typo( 'post_meta_typo','{{WRAPPER}} .nt-blog .item .content .info a' );
        $this->wavo_style_color( 'post_meta_color','{{WRAPPER}} .nt-blog .item .content .info a' );
        $this->add_control( 'post_meta_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog .item .content .info a:hover' => 'color: {{VALUE}};' ]
            ]
        );
        $this->wavo_style_padding( 'post_meta_padding','{{WRAPPER}} .nt-blog .item .content .info a' );
        $this->wavo_style_margin( 'post_meta_margin','{{WRAPPER}} .nt-blog .item .content .info a' );
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
        $this->wavo_style_typo( 'post_title_typo','{{WRAPPER}} .nt-blog .item .content .title h4, {{WRAPPER}} .nt-blog-pg .posts .item .content h4' );
        $this->wavo_style_color( 'post_title_color','{{WRAPPER}} .nt-blog .item .content .title h4, {{WRAPPER}} .nt-blog-pg .posts .item .content h4' );
        $this->add_control( 'post_title_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog .item .content .title h4 a:hover, {{WRAPPER}} .nt-blog-pg .posts .item .content h4 a:hover' => 'color: {{VALUE}};' ]
            ]
        );
        $this->wavo_style_padding( 'post_title_padding','{{WRAPPER}} .nt-blog .item .content .title h4, {{WRAPPER}} .nt-blog-pg .posts .item .content h4 ' );
        $this->wavo_style_margin( 'post_title_margin','{{WRAPPER}} .nt-blog .item .content .title h4, {{WRAPPER}} .nt-blog-pg .posts .item .content h4 ' );
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
        $this->wavo_style_typo( 'post_text_typo','{{WRAPPER}} .nt-blog .item .content .text p, {{WRAPPER}} .nt-blog-pg .posts .item .content p' );
        $this->wavo_style_color( 'post_text_color','{{WRAPPER}} .nt-blog .item .content .text p, {{WRAPPER}} .nt-blog-pg .posts .item .content p' );
        $this->wavo_style_padding( 'post_text_padding','{{WRAPPER}} .nt-blog .item .content .text p, {{WRAPPER}} .nt-blog-pg .posts .item .content p' );
        $this->wavo_style_margin( 'post_text_margin','{{WRAPPER}} .nt-blog .item .content .text p, {{WRAPPER}} .nt-blog-pg .posts .item .content p' );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_date_style_section',
            [
                'label'=> esc_html__( 'Date Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['box_type' => '2']
            ]
        );
        $this->add_control( 'post_date_bgcolor',
            [
                'label' => esc_html__( 'Background Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog-pg .posts .item .content .date a' => 'background-color: {{VALUE}};' ]
            ]
        );
        $this->add_control( 'post_date_brdcolor',
            [
                'label' => esc_html__( 'Border Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog-pg .posts .item .content .date a' => 'border-color: {{VALUE}};' ]
            ]
        );
        $this->add_control( 'post_date_color',
            [
                'label' => esc_html__( 'Number Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog-pg .posts .item .content .date .num' => 'color: {{VALUE}};' ]
            ]
        );
        $this->add_control( 'post_date_hvrcolor',
            [
                'label' => esc_html__( 'Hover Number Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog-pg .posts .item .content .date a:hover .num' => 'color: {{VALUE}};' ]
            ]
        );
        $this->add_control( 'post_date_month_color',
            [
                'label' => esc_html__( 'Month Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog-pg .posts .item .content .date a span:not(.num)' => 'color: {{VALUE}};' ]
            ]
        );
        $this->add_control( 'post_date_month_hvrcolor',
            [
                'label' => esc_html__( 'Hover Month Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog-pg .posts .item .content .date:hover a span:not(.num)' => 'color: {{VALUE}};' ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'post_btn_style_section',
            [
                'label'=> esc_html__( 'Button Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['hidebtn!' => 'yes']
            ]
        );
        $this->wavo_style_typo( 'post_btn_typo','{{WRAPPER}} .nt-blog .item .content .more a, {{WRAPPER}} .nt-blog-pg .posts .item .content .more' );
        $this->wavo_style_color( 'post_btn_color','{{WRAPPER}} .nt-blog .item .content .more a, {{WRAPPER}} .nt-blog-pg .posts .item .content .more' );
        $this->add_control( 'post_btn_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .nt-blog .item .content .more a:hover, {{WRAPPER}} .nt-blog-pg .posts .item .content .more:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .nt-blog-pg .posts .item .content .more:hover:after' => 'background-color: {{VALUE}};',
                ]
            ]
        );
        $this->wavo_style_padding( 'post_btn_padding','{{WRAPPER}} .nt-blog .item .content .more a' );
        $this->wavo_style_margin( 'post_btn_margin','{{WRAPPER}} .nt-blog .item .content .more a' );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'pagination_style_section',
            [
                'label'=> esc_html__( 'Pagination Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['pagination' => 'yes']
            ]
        );
        $this->wavo_style_typo( 'pagination_typo','{{WRAPPER}} .nt-blog-widget .nt-pagination .page-numbers' );
        $this->add_control( 'pagination_bg',
            [
                'label' => esc_html__( 'Background', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog-widget .nt-pagination .page-numbers' => 'background-color: {{VALUE}};' ]
            ]
        );
        $this->add_control( 'pagination_hvrbg',
            [
                'label' => esc_html__( 'Hover/Active Background', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog-widget .nt-pagination .page-numbers.current, {{WRAPPER}} .nt-blog-widget .nt-pagination .page-numbers:hover' => 'background-color: {{VALUE}};' ]
            ]
        );
        $this->add_control( 'pagination_color',
            [
                'label' => esc_html__( 'Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog-widget .nt-pagination .page-numbers' => 'color: {{VALUE}};' ]
            ]
        );
        $this->add_control( 'pagination_hvrcolor',
            [
                'label' => esc_html__( 'Hover Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [ '{{WRAPPER}} .nt-blog-widget .nt-pagination .page-numbers:hover' => 'color: {{VALUE}};' ]
            ]
        );
        $this->add_responsive_control( 'pag_alignment',
            [
                'label' => esc_html__( 'Alignment', 'wavo' ),
                'type' => Controls_Manager::CHOOSE,
                'selectors' => ['{{WRAPPER}} .nt-blog-widget .nt-pagination' => 'justify-content: {{VALUE}}!important;'],
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
                'default' => 'center',
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $paged = get_query_var( 'paged') ? get_query_var('paged') : 1;
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
            'paged'            => $paged
        );

        $blogattr = '2' == $settings[ 'box_type' ] ? ' nt-blog-pg nt-blog-widget' : ' nt-blog nt-blog-widget';
        $the_query = new \WP_Query( $args );
        if( $the_query->have_posts() ) {
            echo '<div class="blog-grid-two'.$blogattr.'">';
                echo '<div class="container-off">';
                    echo '<div class="row">';

                        $delay = 2;

                        while ($the_query->have_posts()) {
                            $the_query->the_post();

                            if ( '2' == $settings[ 'box_type' ] ) {
                                echo '<div class="col-12 col-sm-12 col-md-'.$settings[ 'colmd' ].' col-lg-'.$settings[ 'collg' ].'">';
                                    echo '<div class="posts">';
                                        echo '<div id="post-'.get_the_ID().'" class="item mb-80">';

                                            if ( has_post_thumbnail() ) {
                                                echo '<div class="img">';
                                                    echo '<a href="'.esc_url( get_permalink() ).'" title="'.get_the_title().'">';
                                                        $size = $settings['thumbnail_size'] ? $settings['thumbnail_size'] : 'wavo-single';
                                                        the_post_thumbnail( $size );
                                                    echo '</a>';
                                                echo '</div>';
                                            }

                                            echo '<div class="content">';
                                                echo '<div class="row">';
                                                    $columnleft = 'yes' == $settings[ 'hidedate' ] ? 12 : 9;
                                                    echo '<div class="col-lg-'.$columnleft.' col-sm-12">';

                                                        if ( has_tag() && 'yes' != $settings[ 'hidetags' ] ) {
                                                            the_tags('<div class="tags">','','</div>');
                                                        }

                                                        if ( 'yes' != $settings[ 'hidetitle' ] ) {
                                                            the_title( sprintf( '<h4 class="title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
                                                        }

                                                        if ( 'yes' != $settings[ 'hideexcerpt' ] ) {
                                                            if ( has_excerpt() ) {
                                                                echo '<p>'.wp_trim_words( get_the_excerpt(), $settings['excerpt_limit'] ).'</p>';
                                                            } else {
                                                                echo '<p>'.wp_trim_words( trim( strip_tags( get_the_content() ) ), $settings['excerpt_limit'] ).'</p>';
                                                            }
                                                        }

                                                        if ( $settings[ 'btn_title' ] && 'yes' != $settings[ 'hidebtn' ] ){
                                                            echo '<a  class="more" href="'.get_permalink().'" title="'.get_the_title().'">';
                                                                echo '<span>'.$settings[ 'btn_title' ].'<i class="icofont-caret-right"></i></span>';
                                                            echo '</a>';
                                                        }

                                                    echo '</div>';

                                                    $archive_year  = get_the_time( 'Y' );
                                                    $archive_month = get_the_time( 'm' );
                                                    $archive_day   = get_the_time( 'd' );

                                                    if ( 'yes' != $settings[ 'hidedate' ] ) {
                                                        echo '<div class="col-lg-3 col-sm-12 valign">';
                                                            echo '<div class="date">';
                                                                echo '<a href="'.esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ).'">';
                                                                    echo '<span class="num">'.get_the_date('d').'</span>';
                                                                    echo '<span>'.get_the_date('M').'</span>';
                                                                echo '</a>';
                                                            echo '</div>';
                                                        echo '</div>';
                                                    }
                                                echo '</div>';
                                            echo '</div>';

                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';

                            } else {

                                $animation = 'yes' == $settings['hideanim'] ? '"' : ' wow fadeIn" data-wow-delay="'.($delay / 10).'s"';
                                echo '<div class="col-12 col-sm-'.$settings[ 'colsm' ].' col-md-'.$settings[ 'colmd' ].' col-lg-'.$settings[ 'collg' ].' item-column">';
                                    echo '<div class="item'.$animation.'>';
                                        echo '<div class="content">';
                                            if( has_post_thumbnail() ) {
                                                echo '<div class="img"><a class="img-link" href="'.get_permalink().'">';
                                                    $size = $settings['thumbnail_size'] ? $settings['thumbnail_size'] : 'full';
                                                    the_post_thumbnail( $size );
                                                echo '</a></div>';
                                            }
                                            echo '<div class="content-footer">';
                                                if ( has_tag() && 'yes' != $settings[ 'hidetags' ] ) {
                                                    echo '<div class="tags">';
                                                        the_tags( '', ' | ', '' );
                                                    echo '</div>';
                                                }
                                                if ( 'yes' != $settings[ 'hidemeta' ] ) {
                                                    $post_author = get_author_posts_url( get_the_author_meta( 'ID' ) );
                                                    echo '<div class="info">';
                                                        echo '<a href="'.get_permalink().'"><i class="far fa-clock"></i> '.get_the_date().'</a>';
                                                        echo '<a href="'.$post_author.'"><i class="far fa-user"></i> '.get_the_author().'</a>';
                                                    echo '</div>';
                                                }

                                                if ( 'yes' != $settings[ 'hidetitle' ] ) {
                                                    echo '<div class="title"><h4><a href="'.get_permalink().'">'.get_the_title().'</a></h4></div>';
                                                }

                                                if ( 'yes' != $settings[ 'hideexcerpt' ] ) {
                                                    if ( has_excerpt() ){
                                                        echo '<div class="text"><p>'.wp_trim_words( get_the_excerpt(), $settings['excerpt_limit'] ).'</p></div>';
                                                    } else {
                                                        echo '<div class="text"><p>'.wp_trim_words( trim( strip_tags( get_the_content() ) ), $settings['excerpt_limit'] ).'</p></div>';
                                                    }
                                                }
                                                if ( $settings[ 'btn_title' ] && 'yes' != $settings[ 'hidebtn' ] ){
                                                    echo '<div class="more"><a href="'.get_permalink().'">'.$settings[ 'btn_title' ].'</a></div>';
                                                }

                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                                $delay++;
                            }
                        }
                        wp_reset_postdata();
                    echo '</div>';
                    if ( $settings['pagination'] == 'yes' ) {
                        echo '<div class="nt-pagination d-flex justify-content-center align-items-center">';
                            $total_pages = $the_query->max_num_pages;
                            $big = 999999999;
                            if ( $total_pages > 1){
                                echo paginate_links(array(
                                    'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                    'format'    => '?paged=%#%',
                                    'current'   => max(1, $paged),
                                    'total'     => $total_pages,
                                    'type'      => '',
                                    'prev_text' => $settings['pag_prev'] ? esc_html($settings['pag_prev']) : 'PREV',
                                    'next_text' => $settings['pag_next'] ? esc_html($settings['pag_next']) : 'NEXT',
                                    'before_page_number' => '<div class="nt-pagination-item">',
                                    'after_page_number' => '</div>'
                                ));
                            }
                        echo '</div>';
                    }
                echo '</div>';
            echo '</div>';

        } else {
            echo '<p class="text">' . esc_html__( 'No post found!', 'wavo' ) . '</p>';
        }
    }
}
