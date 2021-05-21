<?php

namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Core\Base\Document;
use Elementor\Core\Base\Module as BaseModule;
use Elementor\Plugin;
use Elementor\Utils;
use Elementor\Core\DocumentTypes\PageBase as PageBase;
use Elementor\Modules\Library\Documents\Page as LibraryPageDocument;

if( !defined( 'ABSPATH' ) ) exit;

class Wavo_Customizing_Page_Settings {

    private static $instance = null;

    public static function get_instance() {
        if ( null == self::$instance ) {
            self::$instance = new Wavo_Customizing_Page_Settings();
        }
        return self::$instance;
    }

    public function __construct(){
        // custom option for elementor heading widget font size
        add_action( 'elementor/element/wp-page/document_settings/before_section_end',[ $this,'wavo_add_theme_skin_to_page_settings'], 10);
        add_action( 'elementor/element/wp-post/document_settings/before_section_end',[ $this,'wavo_add_theme_skin_to_page_settings'], 10);
        //add_action( 'elementor/element/post/section_page_style/after_section_end',[ $this,'wavo_add_custom_settings_to_page_style_settings'], 10);

    }

    public function wavo_add_theme_skin_to_page_settings( $page )
    {

        if ( isset( $page ) && $page->get_id() > "" ){

            $template = basename( get_page_template() );
            $wavo_post_type = false;
            $wavo_post_type = get_post_type( $page->get_id() );

            if ( $wavo_post_type == 'page' || $wavo_post_type == 'revision' ) {

                $page->add_control( 'wavo_elementor_hide_page_header',
                    [
                        'label' => esc_html__( 'Hide Page Header', 'wavo' ),
                        'type' => Controls_Manager::SWITCHER,
                        'default' => 'no',
                        'conditions' => [
            				'relation' => 'or',
            				'terms' => [
            					[ 'name' => 'template','operator' => '==','value' => 'wavo-elementor-page.php' ],
            					[ 'name' => 'template','operator' => '==','value' => 'locomotive-page.php' ]
            				]
            			]
                    ]
                );

                $page->add_control( 'wavo_elementor_page_skin',
                    [
                        'label' => esc_html__( 'Page Skin Type', 'wavo' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            '' => esc_html__( 'Slect a type', 'wavo' ),
                            'dark' => esc_html__( 'Dark', 'wavo' ),
                            'light' => esc_html__( 'Light', 'wavo' ),
                            'custom-skin-color' => esc_html__( 'Custom', 'wavo' ),
                        ],
                        'separator' => 'before',
                        'condition' => [ 'template' => 'wavo-elementor-page.php' ]
                    ]
                );
                $page->add_control( 'wavo_page_custom_skin',
                    [
                        'label' => esc_html__( 'Color', 'wavo' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '.custom-skin-color, .custom-skin-color .elementor-top-section' => 'background-color:{{VALUE}};',
                            '.skin-overlay-color .elementor-background-overlay' => 'background-color:{{VALUE}};opacity:0.96;'
                        ],
                        'conditions' => [
            				'relation' => 'and',
            				'terms' => [
            					[ 'name' => 'template','operator' => '==','value' => 'wavo-elementor-page.php' ],
            					[ 'name' => 'wavo_elementor_page_skin','operator' => '==','value' => 'custom-skin-color' ]
            				]
            			]
                    ]
                );
                $page->add_control( 'wavo_page_heading_color',
                    [
                        'label' => esc_html__( 'Section Heading Color', 'wavo' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '.elementor-widget-heading' => 'color:{{VALUE}};',
                            '.wavo-headig-line .elementor-heading-title::after' => 'background-color:{{VALUE}};',
                            '.clients .brands' => 'border-right-color:{{VALUE}};',
                        ],
                        'conditions' => [
            				'relation' => 'and',
            				'terms' => [
            					[ 'name' => 'template','operator' => '==','value' => 'wavo-elementor-page.php' ],
            					[ 'name' => 'wavo_elementor_page_skin','operator' => '==','value' => 'custom-skin-color' ]
            				]
            			]
                    ]
                );
                $page->add_control( 'wavo_elementor_page_nav_skin',
                    [
                        'label' => esc_html__( 'Page Navigation Type', 'wavo' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => '',
                        'options' => [
                            '' => esc_html__( 'Slect a type', 'wavo' ),
                            'dark' => esc_html__( 'Dark', 'wavo' ),
                            'light' => esc_html__( 'Light', 'wavo' ),
                        ],
                        'separator' => 'before',
                        'condition' => [ 'template' => 'wavo-elementor-page.php' ]
                    ]
                );
            }
            if ( $wavo_post_type == 'page' || $wavo_post_type == 'post' || $wavo_post_type == 'revision' ) {
                $page->add_control( 'wavo_elementor_hide_page_footer',
                    [
                        'label' => esc_html__( 'Hide Footer', 'wavo' ),
                        'type' => Controls_Manager::SWITCHER,
                        'return_value' => 'yes',
                        'default' => 'no',
                        'separator' => 'before',
                        'condition' => [ 'template' => 'wavo-elementor-page.php' ]
                    ]
                );
            }
        }
    }

    public function wavo_add_custom_css_to_page_settings( $page )
    {

        if( isset($page) && $page->get_id() > "" ){

            $nt_post_type   = false;
            $nt_post_type   = get_post_type($page->get_id());

            if ( $nt_post_type == 'page' || $nt_post_type == 'revision' ) {

                $page->start_controls_section( 'header_custom_css_controls_section',
                    [
                        'label' => esc_html__( 'WAVO Page Custom CSS', 'wavo' ),
                        'tab' => Controls_Manager::TAB_SETTINGS,
                    ]
                );
        		$page->add_control( 'wavo_page_custom_css',
        			[
        				'label' => esc_html__( 'Custom CSS', 'wavo' ),
        				'type' => Controls_Manager::CODE,
        				'language' => 'css',
        				'rows' => 20,
        			]
        		);
                $page->end_controls_section();
            }
        }
    }

    public function wavo_page_registered_nav_menus()
    {
        $menus = wp_get_nav_menus();
        $options = array();
        if ( ! empty( $menus ) && ! is_wp_error( $menus ) ) {
            foreach ( $menus as $menu ) {
                $options[ $menu->slug ] = $menu->name;
            }
        }
        return $options;
    }
}
Wavo_Customizing_Page_Settings::get_instance();
