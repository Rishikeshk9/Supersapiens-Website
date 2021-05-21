<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wavo_Vegas_Template extends Widget_Base {
    use Wavo_Helper;
    public function get_name() {
        return 'wavo-vegas-template';
    }
    public function get_title() {
        return 'Vegas Slider Template (N)';
    }
    public function get_icon() {
        return 'eicon-slider-push';
    }
    public function get_categories() {
        return [ 'wavo' ];
    }
    public function get_style_depends() {
        return [ 'vegas' ];
    }
    public function get_script_depends() {
        return [ 'vegas','wow' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   END CONTROLS SECTION   ******/
        $this->start_controls_section( 'home_slider_content_section',
            [
                'label' => esc_html__( 'Content', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'header',
            [
                'label' => esc_html__( 'Show Header', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'header_type',
            [
                'label' => esc_html__( 'Header Template', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'overlay',
                'options' => [
                    'overlay' => esc_html__( 'Default Overlay Menu', 'wavo' ),
                    'template' => esc_html__( 'Elementor Template', 'wavo' )
                ],
                'condition' => [ 'header' => 'yes' ]
            ]
        );
        $this->add_control( 'header_template',
            [
                'label' => esc_html__( 'Select Header Template', 'wavo' ),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple' => false,
                'options' => $this->wavo_get_elementor_templates(),
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'header',
                            'operator' => '==',
                            'value' => 'yes'
                        ],
                        [
                            'name' => 'header_type',
                            'operator' => '==',
                            'value' => 'template'
                        ]
                    ]
                ]
            ]
        );
        $this->add_control( 'content_template',
            [
                'label' => esc_html__( 'Content Template', 'wavo' ),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple' => false,
                'options' => $this->wavo_get_elementor_templates(),
            ]
        );
        $this->add_responsive_control( 'minheight',
            [
                'label' => esc_html__( 'Min Height ( vh )', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 100,
                'selectors' => ['{{WRAPPER}} .slider-vegas-template .elementor-top-section.vegas-slide-template-section' => 'height: {{SIZE}}vh;min-height: {{SIZE}}vh;'],
                'separator' => 'before',
            ]
        );
        $this->add_control( 'content_aligment',
            [
                'label' => esc_html__( 'Content Alignment', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => '100%',
                'options' => [
                    '100%' => esc_html__( 'Default Template', 'wavo' ),
                    'auto' => esc_html__( 'Center', 'wavo' )
                ],
                'selectors' => ['{{WRAPPER}} .slider-vegas-template .elementor-top-section.vegas-slide-template-section.elementor-section>.elementor-container' => 'height: {{VALUE}};'],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
        
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'slider_options_section',
            [
                'label' => esc_html__( 'Slider Options', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'animation',
            [
                'label' => esc_html__( 'Animation Type', 'wavo' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'default' => ['kenburns'],
                'options' => [
                    'kenburns' => esc_html__( 'kenburns', 'wavo' ),
                    'kenburnsUp' => esc_html__( 'kenburnsUp', 'wavo' ),
                    'kenburnsDown' => esc_html__( 'kenburnsDown', 'wavo' ),
                    'kenburnsLeft' => esc_html__( 'kenburnsLeft', 'wavo' ),
                    'kenburnsRight' => esc_html__( 'kenburnsRight', 'wavo' ),
                    'kenburnsUpLeft' => esc_html__( 'kenburnsUpLeft', 'wavo' ),
                    'kenburnsUpRight' => esc_html__( 'kenburnsUpRight', 'wavo' ),
                    'kenburnsDownLeft' => esc_html__( 'kenburnsDownLeft', 'wavo' ),
                    'kenburnsDownRight' => esc_html__( 'kenburnsDownRight', 'wavo' ),
                ]
            ]
        );
        $this->add_control( 'transition',
            [
                'label' => esc_html__( 'Transition Type', 'wavo' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'default' => ['zoomIn','slideLeft','slideRight'],
                'options' => [
                    'fade' => esc_html__( 'fade', 'wavo' ),
                    'fade2' => esc_html__( 'fade2', 'wavo' ),
                    'slideLeft' => esc_html__( 'slideLeft', 'wavo' ),
                    'slideLeft2' => esc_html__( 'slideLeft2', 'wavo' ),
                    'slideRight' => esc_html__( 'slideRight', 'wavo' ),
                    'slideRight2' => esc_html__( 'slideRight2', 'wavo' ),
                    'slideUp' => esc_html__( 'slideUp', 'wavo' ),
                    'slideUp2' => esc_html__( 'slideUp2', 'wavo' ),
                    'slideDown' => esc_html__( 'slideDown', 'wavo' ),
                    'slideDown2' => esc_html__( 'slideDown2', 'wavo' ),
                    'zoomIn' => esc_html__( 'zoomIn', 'wavo' ),
                    'zoomIn2' => esc_html__( 'zoomIn2', 'wavo' ),
                    'zoomOut' => esc_html__( 'zoomOut', 'wavo' ),
                    'zoomOut2' => esc_html__( 'zoomOut2', 'wavo' ),
                    'swirlLeft' => esc_html__( 'swirlLeft', 'wavo' ),
                    'swirlLeft2' => esc_html__( 'swirlLeft2', 'wavo' ),
                    'swirlRight' => esc_html__( 'swirlRight', 'wavo' ),
                    'swirlRight2' => esc_html__( 'swirlRight2', 'wavo' ),
                    'burn' => esc_html__( 'burn', 'wavo' ),
                    'burn2' => esc_html__( 'burn2', 'wavo' ),
                    'blur' => esc_html__( 'blur', 'wavo' ),
                    'blur2' => esc_html__( 'blur2', 'wavo' ),
                    'flash' => esc_html__( 'flash', 'wavo' ),
                    'flash2' => esc_html__( 'flash2', 'wavo' ),
                ]
            ]
        );
        $this->add_control( 'overlay',
            [
                'label' => esc_html__( 'Overlay Image Type', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    'none' => esc_html__( 'None', 'wavo' ),
                    '01' => esc_html__( 'Overlay 1', 'wavo' ),
                    '02' => esc_html__( 'Overlay 2', 'wavo' ),
                    '03' => esc_html__( 'Overlay 3', 'wavo' ),
                    '04' => esc_html__( 'Overlay 4', 'wavo' ),
                    '05' => esc_html__( 'Overlay 5', 'wavo' ),
                    '06' => esc_html__( 'Overlay 6', 'wavo' ),
                    '07' => esc_html__( 'Overlay 7', 'wavo' ),
                    '08' => esc_html__( 'Overlay 8', 'wavo' ),
                    '09' => esc_html__( 'Overlay 9', 'wavo' ),
                ]
            ]
        );
        $this->add_control( 'delay',
            [
                'label' => esc_html__( 'Delay ( ms )', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 7000,
            ]
        );
        $this->add_control( 'duration',
            [
                'label' => esc_html__( 'Transition Duration ( ms )', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 2000,
            ]
        );
        $this->add_control( 'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control( 'shuffle',
            [
                'label' => esc_html__( 'Shuffle', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control( 'timer',
            [
                'label' => esc_html__( 'Timer', 'wavo' ),
                'type' => Controls_Manager::SWITCHER,
                'selectors'  => ['{{WRAPPER}} .vegas-timer' => 'display:block!important;'],
            ]
        );
        $this->add_control( 'timer_size',
            [
                'label' => esc_html__( 'Timer Height', 'wavo' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 5,
                'selectors'  => ['{{WRAPPER}} .vegas-timer' => 'height:{{VALUE}}px;'],
                'condition'  => ['timer' => 'yes'],
            ]
        );
        $this->add_control( 'timer_color',
            [
                'label' => esc_html__( 'Timer Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors'  => ['{{WRAPPER}} .vegas-timer-progress' => 'background-color:{{VALUE}};'],
                'condition'  => ['timer' => 'yes'],
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   END CONTROLS SECTION   ******/
        $this->start_controls_section( 'home_slider_heading_style_section',
            [
                'label' => esc_html__( 'Heading', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->wavo_style_color( 'home_slider_heading_color', '{{WRAPPER}} .nt-vegas-slide-content .slider_hero_title' );
        $this->wavo_style_typo( 'home_slider_heading_typo', '{{WRAPPER}} .nt-vegas-slide-content .slider_hero_title' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   END CONTROLS SECTION   ******/
        $this->start_controls_section( 'home_slider_btn_style_section',
            [
                'label' => esc_html__( 'Button', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->wavo_style_color( 'home_slider_btn_color', '{{WRAPPER}} .nt-vegas-slide-content .dis' );
        $this->wavo_style_typo( 'home_slider_btn_typo', '{{WRAPPER}} .nt-vegas-slide-content .dis' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $settingsid = $this->get_id();
        $sliderattr = '';

        $autoplay = 'yes' == $settings['autoplay'] ? 'true' : 'false';
        $shuffle = 'yes' == $settings['shuffle'] ? 'true' : 'false';
        $timer = 'yes' == $settings['timer'] ? 'true' : 'false';
        $overlay = 'none' == $settings['overlay'] ? 'false' : 'true';

/*
        $slides = array();
        foreach ( $settings['slides'] as $i ) {
            $sdelay = $i['sdelay'] ? ',"delay":'.$i['sdelay'] : '';
            $mute = 'yes' == $i['mute'] ? 'true' : 'false';
            $bgcolor = $i['bgcolor'] ? ',"color":"'.$i['bgcolor'].'"' : '';
            if ( $i['vurl'] != '' ) {
                $slides[] .= '{"src":"'.$i['image']['url'].'","video": {"src":"'.$i['vurl'].'","loop": false,"mute":'.$mute.'}'.$sdelay.$bgcolor.'}';
            } else {
                $slides[] .= '{"src":"'.$i['image']['url'].'"'.$sdelay.$bgcolor.'}';
            }
        }
*/
        $animation = array();
        foreach ( $settings['animation'] as $anim ) {
            $animation[] .=  '"'.$anim.'"';
        }

        $transition = array();
        foreach ( $settings['transition'] as $trans ) {
            $transition[] .=  '"'.$trans.'"';
        }

        //$sliderattr .= '"slides":['.implode(',', $slides).'],';
        $sliderattr .= '"animation":['.implode(',', $animation).'],';
        $sliderattr .= '"transition":['.implode(',', $transition).'],';
        $sliderattr .= '"delay":'.$settings['delay'].',';
        $sliderattr .= '"duration":'.$settings['duration'].',';
        $sliderattr .= '"timer":"'.$settings['timer'].'",';
        $sliderattr .= '"shuffle":"'.$settings['shuffle'].'",';
        $sliderattr .= '"overlay":"'.$settings['overlay'].'",';
        $sliderattr .= '"autoplay":'.$autoplay;
        
        $wrapper = \Elementor\Plugin::$instance->editor->is_edit_mode() ? 'front-'.$settingsid : 'wrapper';

        echo '<div class="slider-vegas-template slider-vegas-template-'.$wrapper.'">';
                if ( 'yes' == $settings['header'] ) {
                    if ( 'template' == $settings['header_type'] && !empty( $settings['header_template'] ) ) {
                        echo '<div class="header-template-wrapper">';
                            $style = \Elementor\Plugin::$instance->editor->is_edit_mode() ? true : false;
                            $template_id = $settings['header_template'];
                            $header_content = new Frontend;
                            echo $header_content->get_builder_content_for_display($template_id, $style );
                        echo '</div>';
                    } else {
                        do_action('wavo_header_action');
                    }
                }
                echo '<div id="slider-'.$settingsid.'" class="slider-vegas-template" data-slider-settings=\'{'.$sliderattr.'}\'></div>';
                if ( !empty( $settings['content_template'] ) ) {
                    $style = \Elementor\Plugin::$instance->editor->is_edit_mode() ? true : false;
                    $content_template_id = $settings['content_template'];
                    $content_template = new Frontend;
                    echo $content_template->get_builder_content_for_display($content_template_id, $style );
                }
                echo '<div class="nt-vegas-slide-counter">';
                    echo '<span class="current">0</span>';
                    echo '<span class="separator"> / </span>';
                    echo '<span class="total">4</span>';
                echo '</div>';
    
                echo '<div class="vegas-control">';
                    echo '<span id="vegas-control-prev" class="vegas-control-prev vegas-control-btn"><i class="fas fa-caret-left"></i></span>';
                    echo '<span id="vegas-control-next" class="vegas-control-next vegas-control-btn"><i class="fas fa-caret-right"></i></span>';
                echo '</div>';

        echo '</div>';

        // Not in edit mode
        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) { 
        ?>
            <script>
            jQuery(document).ready(function ($) {

                var myEl       = $('.slider-vegas-template-front-<?php echo $settingsid; ?>'),
                    myVegasId  = myEl.find('.slider-vegas-template').attr('id'),
                    myVegas    = $( '#' + myVegasId ),
                    myPrev     = myEl.find( '.vegas-control-prev' ),
                    myNext     = myEl.find( '.vegas-control-next' ),
                    myContent  = myEl.find( '.elementor-top-section' ),
                    myCounter  = myEl.find( '.nt-vegas-slide-counter' ),
                    mySocials  = myEl.find( '.social .icon' );
                    
                myEl.parents('.elementor-widget-wavo-vegas-template').removeClass('elementor-invisible');
                
                var mySlides = [];
                myEl.find( '.elementor-top-section' ).each( function(){
                    var mySlide = $(this),
                        bgImage = mySlide.css('background-image');
                        bgImage = bgImage.replace(/.*\s?url\([\'\"]?/, '').replace(/[\'\"]?\).*/, ''),
                        bgImage = {"src": bgImage};
                        
                    mySlides.push( bgImage );
                    mySlide.addClass('vegas-slide-template-section').css({
                        'background-image' : 'none',
                        'background-color' : 'transparent',
                    });
                });

                if( mySlides.length ) {

                    myVegas.vegas({
                        autoplay: <?php echo $autoplay; ?>,
                        delay: <?php echo $settings['delay']; ?>,
                        timer: <?php echo $timer; ?>,
                        shuffle: <?php echo $shuffle; ?>,
                        animation: [<?php echo implode(',', $animation); ?>],
                        transition: [<?php echo implode(',', $transition); ?>],
                        transitionDuration: <?php echo $settings['duration']; ?>,
                        overlay: <?php echo $overlay; ?>,
                        slides: mySlides,
                        init: function (globalSettings) {
                            myContent.eq(0).addClass('active');
                            var total = myContent.size();
                            myCounter.find('.total').html(total);
                            
                            myContent.find( '[data-split-settings]' ).each( function(){
                                var mySplit = $(this),
                                    myData = mySplit.data('split-settings'),
                                    myAnim = myData.animation;
                                myContent.find('.elementor-heading-title').removeClass('wow animated');
                            });
                        },
                        walk: function (index, slideSettings) {
                            myContent.removeClass('active').eq(index).addClass('active');
                            myContent.find( '[data-split-settings]' ).each( function(){
                                var mySplit = $(this),
                                    myData = mySplit.data('split-settings'),
                                    myAnim = myData.animation;
                                    
                                    myContent.find('.elementor-heading-title').removeClass('animated');
                                    myContent.eq(index).find('.elementor-heading-title').addClass('animated');
                            });
                            myContent.each( function(){
                                var myElAnim = $(this).find( '.elementor-element[data-settings]' ),
                                    myData = myElAnim.data('settings'),
                                    myAnim = myData && myData._animation ? myData._animation : '',
                                    myDelay = myData && myData._animation_delay ? myData._animation_delay / 1000 : '';
                                
                                if (myData && myAnim ) {
                                    myElAnim.removeClass('animated '+ myAnim );
                                    $(this).eq(index).find(myElAnim).addClass('animated '+ myAnim ).css({
                                        'animation-delay' : myDelay+'s',
                                    });
                                }
                            });
                            var current = index +1;
                            myCounter.find('.current').html(current);
                        }
                    });
                    myPrev.on('click', function () {
                        myVegas.vegas('previous');
                    });

                    myNext.on('click', function () {
                        myVegas.vegas('next');
                    });
                }
            });
            </script>
            <?php
        }
    }
}
