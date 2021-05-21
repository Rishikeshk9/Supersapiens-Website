<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wavo_Post_Data extends Widget_Base {
    use Wavo_Helper;
    public function get_name() {
        return 'wavo-post-data';
    }
    public function get_title() {
        return 'Post Data (N)';
    }
    public function get_icon() {
        return 'eicon-shortcode';
    }
    public function get_categories() {
        return [ 'wavo-post' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }


    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'wavo_post_data_settings',
            [
                'label' => esc_html__('Post Data', 'wavo'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'data',
            [
                'label' => esc_html__( 'Data Type', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'title' => esc_html__( 'Title', 'wavo' ),
                    'featured' => esc_html__( 'Featured Image', 'wavo' ),
                    'author' => esc_html__( 'Author Name', 'wavo' ),
                    'desc' => esc_html__( 'Author Description', 'wavo' ),
                    'avatar' => esc_html__( 'Author Avatar', 'wavo' ),
                    'date' => esc_html__( 'Date', 'wavo' ),
                    'cat' => esc_html__( 'Category', 'wavo' ),
                    'tag' => esc_html__( 'Tags', 'wavo' ),
                    'commnet-number' => esc_html__( 'Comment Number', 'wavo' ),
                    'comment-template' => esc_html__( 'Comment Template', 'wavo' ),
                    'related' => esc_html__( 'Related Post', 'wavo' ),
                    'nav' => esc_html__( 'Navigation', 'wavo' ),
                    'prev' => esc_html__( 'Previous Post', 'wavo' ),
                    'next' => esc_html__( 'Next Post', 'wavo' ),
                ],
                'default' => 'title'
            ]
        );
        $this->add_control( 'tag',
            [
                'label' => esc_html__( 'Tag', 'elementories' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'p',
                'options' => [
                    'h1' => esc_html__( 'h1', 'elementories' ),
                    'h2' => esc_html__( 'h2', 'elementories' ),
                    'h3' => esc_html__( 'h3', 'elementories' ),
                    'h4' => esc_html__( 'h4', 'elementories' ),
                    'h5' => esc_html__( 'h5', 'elementories' ),
                    'h6' => esc_html__( 'h6', 'elementories' ),
                    'div' => esc_html__( 'div', 'elementories' ),
                    'p' => esc_html__( 'p', 'elementories' ),
                    'span' => esc_html__( 'span', 'elementories' )
                ],
                'separator' => 'before',
                'conditions' => [
    				'relation' => 'or',
    				'terms' => [
    					[ 'name' => 'data','operator' => '==','value' => 'date' ],
    					[ 'name' => 'data','operator' => '==','value' => 'cat' ],
    					[ 'name' => 'data','operator' => '==','value' => 'commnet-number' ],
    					[ 'name' => 'data','operator' => '==','value' => 'tag' ],
    					[ 'name' => 'data','operator' => '==','value' => 'title' ],
    					[ 'name' => 'data','operator' => '==','value' => 'author' ],
    					[ 'name' => 'data','operator' => '==','value' => 'desc' ]
    				]
    			]
            ]
        );
        $this->add_responsive_control( 'perpage',
            [
                'label' => esc_html__( 'Post Per Page', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => 6,
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_responsive_control( 'title',
            [
                'label' => esc_html__( 'Section Title', 'wavo' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Related Posts',
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_responsive_control( 'subtitle',
            [
                'label' => esc_html__( 'Section Subtitle', 'wavo' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Awesome Works',
                'condition' => [ 'data' => 'related' ]
            ]
        );
        $this->add_control( 'post_style',
            [
                'label' => esc_html__( 'Post Type', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => esc_html__( 'Type 1', 'wavo' ),
                    '2' => esc_html__( 'Type 2', 'wavo' ),
                ],
                'default' => '1'
            ]
        );
        $this->add_control( 'pattern',
            [
                'label' => esc_html__( 'Pattern Image', 'wavo' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [ 'url' => plugins_url( 'assets/front/img/pattern.svg', __DIR__ ) ],
            ]
        );
        $this->end_controls_section();

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('team_info_style_section',
            [
                'label'=> esc_html__( 'Data Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'conditions' => [
    				'relation' => 'or',
    				'terms' => [
    					[ 'name' => 'data','operator' => '==','value' => 'date' ],
    					[ 'name' => 'data','operator' => '==','value' => 'cat' ],
    					[ 'name' => 'data','operator' => '==','value' => 'commnet-number' ],
    					[ 'name' => 'data','operator' => '==','value' => 'tag' ],
    					[ 'name' => 'data','operator' => '==','value' => 'title' ],
    					[ 'name' => 'data','operator' => '==','value' => 'author' ],
    					[ 'name' => 'data','operator' => '==','value' => 'desc' ]
    				]
    			]
            ]
        );

        $this->add_control( 'post_data_color',
            [
                'label' => esc_html__( 'Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .post--data, {{WRAPPER}} .post--data a' => 'color:{{VALUE}};' ],
                'separator' => 'before',
            ]
        );
        $this->wavo_style_typo( 'post_data_typo','{{WRAPPER}} .post--data' );
        $this->wavo_style_text_alignment( 'post_data_typo','{{WRAPPER}} .post--data' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    public function post_related() {
        $settings = $this->get_settings_for_display();
        global $post;
        $cats = get_the_category( $post->ID );
        $args = array(
            'post__not_in' => array( $post->ID ),
            'posts_per_page' => $settings['perpage']
        );

        $the_query = new \WP_Query( $args );

        if( $the_query->have_posts() ) {
            wp_enqueue_style( 'swiper' );
            wp_enqueue_script( 'swiper' );
        ?>

            <?php if ( '1' == $settings['post_style'] ) { ?>
            <div class="work-carousel ptb-120 bg-img nt-related-post post--data">
                <div class="stories bg-img no-cover bg-pattern" data-wavo-background="<?php echo esc_url( $settings['pattern']['url'] ); ?>"></div>
            <?php } else { ?>
            <div class="work-carousel ptb-120 nt-related-post">
            <?php } ?>

                <?php if ( $settings['subtitle'] ) { ?>
                    <div class="text-bg"><?php echo esc_html( $settings['subtitle'] ); ?></div>
                <?php } ?>

                <?php if ( $settings['subtitle'] || $settings['title'] ) { ?>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-11">
                                <div class="section-head">

                                    <?php if ( $settings['subtitle'] ) { ?>
                                        <h6 class="wow" data-splitting><?php echo esc_html( $settings['subtitle'] );; ?></h6>
                                    <?php } ?>

                                    <?php if ( $settings['title'] ) { ?>
                                        <h3 class="wow" data-splitting><?php echo esc_html( $settings['title'] );; ?></h3>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <?php if ( '1' == $settings['post_style'] ) { ?>
                    <div class="nt-blog-grid ptb-0">

                        <div class="container-fluid">
                            <div class="row justify-content-center">
                                <div class="col-lg-12 no-padding">
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper">
                                        <?php
                                            while( $the_query->have_posts() ) {

                                                $the_query->the_post();
                                                if ( has_post_thumbnail() ) {
                                                    ?>
                                                    <div class="swiper-slide">
                                                        <div class="item">
                                                            <div class="post-img">
                                                                <div class="img">
                                                                    <?php echo get_the_post_thumbnail( get_the_ID(), array( 450, 300 ) ); ?>
                                                                </div>
                                                            </div>
                                                            <div class="cont">
                                                                <div class="info">
                                                                    <?php wavo_post_meta_author(); ?>
                                                                    <?php wavo_post_meta_date(); ?>
                                                                </div>

                                                                <h5>
                                                                    <?php
                                                                        printf( '<a href="%s" title="%s">%s</a>',
                                                                            get_permalink(),
                                                                            the_title_attribute( 'echo=0' ),
                                                                            get_the_title()
                                                                        );
                                                                    ?>
                                                                </h5>

                                                                <?php
                                                                    printf( '<a  class="more" href="%s" title="%s"><span>%s<i class="icofont-caret-right"></i></span></a>',
                                                                        get_permalink(),
                                                                        the_title_attribute( 'echo=0' ),
                                                                        esc_html__( 'Read More', 'wavo' )
                                                                    );
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                        <!-- slider setting -->
                                        <div class="swiper-button-next swiper-nav-ctrl next-ctrl"><i class="ion-ios-arrow-right"></i></div>
                                        <div class="swiper-button-prev swiper-nav-ctrl prev-ctrl"><i class="ion-ios-arrow-left"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } else { ?>

                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 no-padding">
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <?php
                                            while( $the_query->have_posts() ) {

                                                $the_query->the_post();
                                                if ( has_post_thumbnail() ) {
                                                    $thumb_url = get_the_post_thumbnail_url();
                                                    ?>
                                                    <div class="swiper-slide">
                                                        <div class="content">
                                                            <div class="img">
                                                                <span class="imgio">
                                                                    <div class="wow cimgio" data-delay="300"></div>
                                                                    <?php echo get_the_post_thumbnail( get_the_ID(), array( 450, 300 ) ); ?>
                                                                </span>
                                                            </div>
                                                            <div class="cont">
                                                                <?php if ( has_category() ) { ?>
                                                                    <h6><?php the_category(' & '); ?></h6>
                                                                <?php } ?>
                                                                <h4><?php printf( '<a href="%s" title="%s">%s</a>',
                                                                    get_permalink(),
                                                                    the_title_attribute( 'echo=0' ),
                                                                    get_the_title()
                                                                ); ?></h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                        ?>
                                    </div>
                                    <!-- slider setting -->
                                    <div class="swiper-button-next swiper-nav-ctrl next-ctrl"><i class="ion-ios-arrow-right"></i></div>
                                    <div class="swiper-button-prev swiper-nav-ctrl prev-ctrl"><i class="ion-ios-arrow-left"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>

            </div>
            <?php
            wp_reset_postdata();
        }
    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        global $post;
        $tag = $settings['tag'];
        if ( 'title' == $settings['data'] ) {
            echo '<'.$tag.' class="post--data post--title post--id-'.$post->ID.'">'.get_the_title( $post->ID ).'</'.$tag.'>';
        }
        if ( 'featured' == $settings['data'] ) {
            echo '<div class="post--data post--img post--id-'.$post->ID.' img">' . get_the_post_thumbnail( get_the_ID(), 'full', array( 'class' => 'thumparallax' ) ) . '</div>';
        }
        if ( 'cat' == $settings['data'] && has_category() ) {
            echo '<'.$tag.' class="post--data post--cat post--id-'.$post->ID.'">';
            the_category(', ');
            echo '</'.$tag.'>';
        }
        if ( 'tag' == $settings['data'] && has_tag() ) {
            echo '<'.$tag.' class="post--data post--tags post--id-'.$post->ID.'">';
            the_tags('', ', ', '');
            echo '</'.$tag.'>';
        }
        if ( 'date' == $settings['data'] && function_exists( 'wavo_post_meta_date' ) ) {
            echo '<'.$tag.' class="post--data post--date post--id-'.$post->ID.'">';
            wavo_post_meta_date();
            echo '</'.$tag.'>';
        }
        if ( 'comment-number' == $settings['data'] && function_exists( 'wavo_post_meta_comment_number' ) ) {
            echo '<'.$tag.' class="post--data post--author post--id-'.$post->ID.'">';
            wavo_post_meta_comment_number();
            echo '</'.$tag.'>';
        }
        if ( 'comment-template' == $settings['data'] ) {
            echo '<div class="post--data wavo-comments-wrapper post--id-'.$post->ID.'" id="wavo-comments-wrapper">';
            wavo_single_post_comment_template();
            echo'</div>';
        }
        if ( 'nav' == $settings['data'] && function_exists( 'wavo_single_navigation' ) ) {
            echo '<div class="post--data post--nav">';
            wavo_single_navigation();
            echo '</div>';
        }
        if ( 'related' == $settings['data'] ) {
            $this->post_related();
        }
        if ( 'author' == $settings['data'] && function_exists( 'wavo_post_meta_author' ) ) {
            echo '<'.$tag.' class="post--data post--author post--id-'.$post->ID.'">';
            wavo_post_meta_author();
            echo '</'.$tag.'>';
        }
        if ( 'desc' == $settings['data'] && get_the_author_meta('user_description', $post->post_author) ) {
            $desc = get_the_author_meta( 'user_description', $post->post_author );
            echo '<'.$tag.' class="post--data post--author post--id-'.$post->ID.'">'.$desc.'</'.$tag.'>';
        }
        if ( 'avatar' == $settings['data'] ) {
            if ( function_exists( 'get_avatar' ) ) {
                echo '<div class="post--data author--img post--id-'.$post->ID.'">'.get_avatar( get_the_author_meta( 'email' ), '140').'</div>';
            }
        }

    }
}
