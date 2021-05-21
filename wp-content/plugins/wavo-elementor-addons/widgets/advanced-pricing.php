<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.
class Wavo_Advanced_Pricing extends Widget_Base {
    use Wavo_Helper;
    public function get_name() {
        return 'wavo-advanced-pricing';
    }
    public function get_title() {
        return 'Advanced Pricing (N)';
    }
    public function get_icon() {
        return 'eicon-image-rollover';
    }
    public function get_categories() {
        return [ 'wavo' ];
    }
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);

        wp_register_style( 'wavo-advanced-pricing', WAVO_PLUGIN_URL. 'assets/front/js/advanced-pricing/style.css');
        wp_register_script( 'wavo-modernizr', WAVO_PLUGIN_URL. 'assets/front/js/advanced-pricing/modernizr.min.js', [ 'jquery' ], '1.0.0', false);
        wp_register_script( 'wavo-advanced-pricing', WAVO_PLUGIN_URL. 'assets/front/js/advanced-pricing/script.js', [ 'elementor-frontend' ], '1.0.0', true);

    }
    public function get_style_depends() {
        return [ 'wavo-advanced-pricing' ];
    }
    public function get_script_depends() {
        return [ 'wavo-modernizr', 'wavo-advanced-pricing' ];
    }
    // Registering Cowavorols
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('advanced_pricing_pack_section',
            [
                'label'=> esc_html__( 'Pack Settings', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control( 'filter1',
            [
                'label' => esc_html__( 'Filter 1 Title', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Mowavohly',
            ]
        );
        $this->add_control( 'filter2',
            [
                'label' => esc_html__( 'Filter 2 Title', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Yearly',
            ]
        );
        $this->add_control( 'gaps',
            [
                'label' => esc_html__( 'Gap', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'wavo-full-width',
                'separator' => 'before',
                'options' => [
                    'wavo-full-width' => esc_html__( 'No Gap', 'wavo' ),
                    'wavo-has-margins' => esc_html__( 'Default', 'wavo' ),
                ]
            ]
        );
        $this->add_control( 'bg_type',
            [
                'label' => esc_html__( 'Color Type', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'bg-default',
                'separator' => 'before',
                'options' => [
                    'bg-default' => esc_html__( 'Default', 'wavo' ),
                    'wavo-secondary-theme' => esc_html__( 'Gradiewavo', 'wavo' ),
                ]
            ]
        );
        $this->add_control( 'colwidth',
            [
                'label' => esc_html__( 'Column Width', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'col3',
                'separator' => 'before',
                'options' => [
                    'col2' => esc_html__( '2 Column', 'wavo' ),
                    'col3' => esc_html__( '3 Column', 'wavo' ),
                    'col4' => esc_html__( '4 Column', 'wavo' ),
                ]
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control( 'popular',
            [
                'name' => 'popular',
                'label' => esc_html__('Popular?', 'wavo'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );
        $repeater->add_control( 'front_heading',
            [
                'label' => esc_html__( 'FRONT', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $repeater->add_control( 'f_title',
            [
                'label' => esc_html__( 'Title', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Basic',
            ]
        );
        $repeater->add_control( 'f_currency',
            [
                'label' => esc_html__( 'Currency', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'default' => '$'
            ]
        );
        $repeater->add_control( 'f_price',
            [
                'label' => esc_html__( 'Price', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'default' => '60',
            ]
        );
        $repeater->add_control( 'f_period',
            [
                'label' => esc_html__( 'Period', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'mo',
            ]
        );
        $repeater->add_control( 'f_features',
            [
                'label' => esc_html__('Features', 'wavo'),
                'description' => esc_html__('Separate each option with comma', 'wavo'),
                'pleaceholder' => esc_html__('Separate each option with comma', 'wavo'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '<em>512MB</em> Memory,
                <em>3</em> Users,
                <em>5</em> Websites,
                <em>7</em> Domains,
                <em>Unlimited</em> Bandwidth,
                <em>24/7</em> Support',
                'label_block' => true
            ]
        );
        $repeater->add_control( 'f_btn_title',
            [
                'label' => esc_html__( 'Button Title', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Select',
            ]
        );
        $repeater->add_control( 'f_link',
            [
                'label' => esc_html__( 'Link', 'wavo' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => 'true',
                ],
                'placeholder' => esc_html__( 'Place URL here', 'wavo' )
            ]
        );
        $repeater->add_control( 'back_heading',
            [
                'label' => esc_html__( 'FRONT', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $repeater->add_control( 'b_title',
            [
                'label' => esc_html__( 'Title', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Basic',
            ]
        );
        $repeater->add_control( 'b_currency',
            [
                'label' => esc_html__( 'Currency', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'default' => '$'
            ]
        );
        $repeater->add_control( 'b_price',
            [
                'label' => esc_html__( 'Price', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'default' => '60',
            ]
        );
        $repeater->add_control( 'b_period',
            [
                'label' => esc_html__( 'Period', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'mo',
            ]
        );
        $repeater->add_control( 'b_features',
            [
                'label' => esc_html__('Features', 'wavo'),
                'description' => esc_html__('Separate each option with comma', 'wavo'),
                'pleaceholder' => esc_html__('Separate each option with comma', 'wavo'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '<em>512MB</em> Memory,
                <em>3</em> Users,
                <em>5</em> Websites,
                <em>7</em> Domains,
                <em>Unlimited</em> Bandwidth,
                <em>24/7</em> Support',
                'label_block' => true
            ]
        );
        $repeater->add_control( 'b_btn_title',
            [
                'label' => esc_html__( 'Button Title', 'wavo' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Select',
            ]
        );
        $repeater->add_control( 'b_link',
            [
                'label' => esc_html__( 'Link', 'wavo' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => 'true',
                ],
                'placeholder' => esc_html__( 'Place URL here', 'wavo' )
            ]
        );
        $this->add_control( 'packs',
            [
                'label' => esc_html__( 'Pack', 'wavo' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => 'FRONT:{{f_title}} / BACK:{{b_title}}',
                'default' => [
                    [
                        'popular' => 'no',
                        'f_title' => 'Basic',
                        'f_price' => '30',
                        'b_title' => 'Basic',
                        'b_price' => '320'
                    ],
                    [
                        'popular' => 'yes',
                        'f_title' => 'Popular',
                        'f_price' => '60',
                        'b_title' => 'Basic',
                        'b_price' => '630'
                    ],
                    [
                        'popular' => 'no',
                        'f_title' => 'Premier',
                        'f_price' => '90',
                        'b_title' => 'Basic',
                        'b_price' => '950'
                    ]
                ]
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('advanced_pricing_filter_style_section',
            [
                'label'=> esc_html__( 'Filter Box Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wavo_style_border( 'advanced_pricing_filter_border','{{WRAPPER}} .wavo-pricing-switcher .fieldset');
        $this->wavo_style_background( 'advanced_pricing_filter_background','{{WRAPPER}} .wavo-pricing-switcher .fieldset',array('classic','gradient') );
        $this->wavo_style_padding( 'advanced_pricing_filter_padding','{{WRAPPER}} .wavo-pricing-switcher .fieldset');
        $this->wavo_style_margin( 'advanced_pricing_filter_margin','{{WRAPPER}} .wavo-pricing-switcher .fieldset');

        $this->add_control( 'pack_popular_filter_switcher_heading',
            [
                'label' => esc_html__( 'Filter Switcher Style', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->wavo_style_color( 'advanced_pricing_switcher_color','{{WRAPPER}} .wavo-pricing-switcher label');
        $this->wavo_style_border( 'advanced_pricing_switcher_border','{{WRAPPER}} .wavo-pricing-switcher label');
        $this->wavo_style_background( 'advanced_pricing_switcher_background','{{WRAPPER}} .wavo-pricing-switcher label',array('classic','gradient') );
        $this->wavo_style_padding( 'advanced_pricing_switcher_padding','{{WRAPPER}} .wavo-pricing-switcher label');

        $this->add_control( 'pack_popular_filter_heading',
            [
                'label' => esc_html__( 'Filter Switcher Active Style', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->wavo_style_border( 'advanced_pricing_switcher_active_border','{{WRAPPER}} .wavo-pricing-switcher .wavo-switch');
        $this->wavo_style_background( 'advanced_pricing_switcher_active_background','{{WRAPPER}} .wavo-pricing-switcher .wavo-switch',array('classic','gradient') );
        $this->wavo_style_padding( 'advanced_pricing_switcher_active_padding','{{WRAPPER}} .wavo-pricing-switcher .wavo-switch');

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('advanced_pricing_style_section',
            [
                'label'=> esc_html__( 'Pack Box Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wavo_style_border( 'advanced_pricing_box_border','{{WRAPPER}} .wavo-pricing-wrapper > li');
        $this->wavo_style_background( 'advanced_pricing_box_background','{{WRAPPER}} .wavo-pricing-wrapper > li',array('classic','gradient') );
        $this->wavo_style_padding( 'advanced_pricing_box_padding','{{WRAPPER}} .wavo-pricing-wrapper > li');
        $this->wavo_style_margin( 'advanced_pricing_box_margin','{{WRAPPER}} .wavo-pricing-wrapper > li');

        $this->add_control( 'pack_popular_box_heading',
            [
                'label' => esc_html__( 'Popular Pack Style', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->wavo_style_border( 'advanced_pricing_popular_box_border','{{WRAPPER}} .wavo-popular .wavo-pricing-wrapper > li');
        $this->wavo_style_background( 'advanced_pricing_popular_box_background','{{WRAPPER}} .wavo-popular .wavo-pricing-wrapper > li',array('classic','gradient') );
        $this->wavo_style_padding( 'advanced_pricing_popular_box_padding','{{WRAPPER}} .wavo-popular .wavo-pricing-wrapper > li');

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('advanced_pricing_pack_text_style_section',
            [
                'label'=> esc_html__( 'Pack Heading Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wavo_style_background( 'advanced_pricing_pack_text_background','{{WRAPPER}} .wavo-pricing-header',array('classic','gradient') );
        $this->add_control( 'pack_title_heading',
            [
                'label' => esc_html__( 'Pack Title', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->wavo_style_typo( 'advanced_pricing_title_typo','{{WRAPPER}} .wavo-pricing-header .wavo-pack-title' );
        $this->wavo_style_color( 'advanced_pricing_title_color','{{WRAPPER}} .wavo-pricing-header .wavo-pack-title' );
        $this->add_control( 'advanced_pricing_popular_title_color',
            [
                'label' => esc_html__( 'Popular Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .wavo-popular .wavo-pack-title' => 'color:{{VALUE}};']
            ]
        );
        $this->add_control( 'pack_currency_heading',
            [
                'label' => esc_html__( 'Pack Currency', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->wavo_style_typo( 'advanced_pricing_currency_typo','{{WRAPPER}} .wavo-currency' );
        $this->wavo_style_color( 'advanced_pricing_currency_color','{{WRAPPER}} .wavo-currency' );
        $this->add_control( 'advanced_pricing_popular_currency_color',
            [
                'label' => esc_html__( 'Popular Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .wavo-popular .wavo-currency' => 'color:{{VALUE}};']
            ]
        );

        $this->add_control( 'pack_price_heading',
            [
                'label' => esc_html__( 'Pack Price', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->wavo_style_typo( 'advanced_pricing_price_typo','{{WRAPPER}} .wavo-value' );
        $this->wavo_style_color( 'advanced_pricing_price_color','{{WRAPPER}} .wavo-value' );
        $this->add_control( 'advanced_pricing_popular_price_color',
            [
                'label' => esc_html__( 'Popular Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .wavo-popular .wavo-value' => 'color:{{VALUE}};']
            ]
        );

        $this->add_control( 'pack_period_heading',
            [
                'label' => esc_html__( 'Pack Period', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->wavo_style_typo( 'advanced_pricing_period_typo','{{WRAPPER}} .wavo-duration' );
        $this->wavo_style_color( 'advanced_pricing_period_color','{{WRAPPER}} .wavo-duration' );
        $this->add_control( 'advanced_pricing_popular_period_color',
            [
                'label' => esc_html__( 'Popular Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => ['{{WRAPPER}} .wavo-popular .wavo-duration' => 'color:{{VALUE}};']
            ]
        );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('advanced_pricing_pack_fetaures_style_section',
            [
                'label'=> esc_html__( 'Features Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wavo_style_typo( 'advanced_pricing_pack_fetaures_typo','{{WRAPPER}} .wavo-pricing-features li' );
        $this->wavo_style_color( 'advanced_pricing_pack_fetaures_color','{{WRAPPER}} .wavo-pricing-features li' );
        $this->wavo_style_background( 'advanced_pricing_pack_fetaures_background','{{WRAPPER}} .wavo-pricing-features li',array('classic','gradient') );
        $this->wavo_style_padding( 'advanced_pricing_pack_fetaures_padding','{{WRAPPER}} .wavo-pricing-features li' );
        $this->wavo_style_margin( 'advanced_pricing_pack_fetaures_margin','{{WRAPPER}} .wavo-pricing-features li' );
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('advanced_pricing_pack_fetaures_btn_style_section',
            [
                'label' => esc_html__( 'Button Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->wavo_style_typo( 'advanced_pricing_pack_btn_typo','{{WRAPPER}} .wavo-pack-button' );
        $this->wavo_style_padding( 'advanced_pricing_pack_btn_padding','{{WRAPPER}} .wavo-pack-button' );
        $this->wavo_style_margin( 'advanced_pricing_pack_btn_margin','{{WRAPPER}} .wavo-pack-button' );

        $this->start_controls_tabs( 'advanced_pricing_pack_btn_tabs');
        $this->start_controls_tab( 'advanced_pricing_pack_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'wavo' ) ]
        );
        // Style function
        $this->wavo_style_color( 'advanced_pricing_pack_btn_color','{{WRAPPER}} .wavo-pack-button, {{WRAPPER}} .wavo-pack-button span' );
        $this->wavo_style_background( 'advanced_pricing_pack_btn_background','{{WRAPPER}} .wavo-pack-button',array('classic','gradient') );
        $this->wavo_style_border( 'advanced_pricing_pack_btn_border','{{WRAPPER}} .wavo-pack-button' );
        $this->end_controls_tab();

        $this->start_controls_tab( 'advanced_pricing_pack_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wavo' ) ]
        );
        // Style function
        $this->wavo_style_color( 'advanced_pricing_pack_btn_hvr_color','{{WRAPPER}} .wavo-pack-button:hover, {{WRAPPER}} .wavo-pack-button:hover span' );
        $this->wavo_style_background( 'advanced_pricing_pack_btn_hvr_background','{{WRAPPER}} .wavo-pack-button:hover',array('classic','gradient') );
        $this->wavo_style_border( 'advanced_pricing_pack_btn_hvr_border','{{WRAPPER}} .wavo-pack-button:hover' );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control( 'advanced_pricing_popular_pack_btn_heading',
            [
                'label' => esc_html__( 'POPULAR PACK', 'wavo' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->start_controls_tabs( 'advanced_pricing_popular_pack_btn_tabs');
        $this->start_controls_tab( 'advanced_pricing_popular_pack_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'wavo' ) ]
        );
        // Style function
        $this->wavo_style_color( 'advanced_pricing_popular_pack_btn_color','{{WRAPPER}} .wavo-popular .wavo-pack-button, {{WRAPPER}} .wavo-popular .wavo-pack-button span' );
        $this->wavo_style_background( 'advanced_pricing_popular_pack_btn_background','{{WRAPPER}} .wavo-popular .wavo-pack-button',array('classic','gradient') );
        $this->wavo_style_border( 'advanced_pricing_popular_pack_btn_border','{{WRAPPER}} .wavo-popular .wavo-pack-button' );
        $this->end_controls_tab();

        $this->start_controls_tab( 'advanced_pricing_popular_pack_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wavo' ) ]
        );
        // Style function
        $this->wavo_style_color( 'advanced_pricing_popular_pack_btn_hvr_color','{{WRAPPER}} .wavo-popular .wavo-pack-button:hover, {{WRAPPER}} .wavo-popular .wavo-pack-button:hover span' );
        $this->wavo_style_background( 'advanced_pricing_popular_pack_btn_hvr_background','{{WRAPPER}} .wavo-popular .wavo-pack-button:hover',array('classic','gradient') );
        $this->wavo_style_border( 'advanced_pricing_pack_popular_btn_hvr_border','{{WRAPPER}} .wavo-popular .wavo-pack-button:hover' );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id = $this->get_id();
        $gaps = $settings['gaps'] ? ' '.$settings['gaps'] : '';
        $bg_type = $settings['bg_type'] ? ' '.$settings['bg_type'] : '';

        echo '<div class="wavo-pricing-container'.$gaps.$bg_type.'">';
            echo '<div class="wavo-pricing-switcher">';

                echo '<p class="fieldset">';
                    echo '<input type="radio" name="duration-'.$id.'" value="monthly-'.$id.'" id="monthly-'.$id.'" checked>';
                    echo '<label for="monthly-'.$id.'">'.$settings['filter1'].'</label>';
                    echo '<input type="radio" name="duration-'.$id.'" value="yearly-'.$id.'" id="yearly-'.$id.'">';
                    echo '<label for="yearly-'.$id.'">'.$settings['filter2'].'</label>';
                    echo '<span class="wavo-switch"></span>';
                echo '</p>';
            echo '</div>';

            echo '<ul class="wavo-pricing-list wavo-bounce-invert '.$settings['colwidth'].'">';

                foreach ($settings['packs'] as $pack) {
                    $popular = 'yes' === $pack['popular'] ? 'popular' : 'default';
                    $popular_btn = 'yes' === $pack['popular'] ? 'btn-curve btn-blc' : 'btn-curve';
                    echo '<li class="wavo-'.$popular.'">';
                        echo '<ul class="wavo-pricing-wrapper">';

                            echo '<li data-type="monthly-'.$id.'" class="is-visible">';

                                echo '<header class="wavo-pricing-header">';
                                    echo $pack['f_title'] ? '<h2 class="wavo-pack-title">'.$pack['f_title'].'</h2>' : '';
                                    echo '<div class="wavo-price">';
                                        echo $pack['f_currency'] ? '<span class="wavo-currency">'.$pack['f_currency'].'</span>' : '';
                                        echo $pack['f_price'] ? '<span class="wavo-value">'.$pack['f_price'].'</span>' : '';
                                        echo $pack['f_period'] ? '<span class="wavo-duration">'.$pack['f_period'].'</span>' : '';
                                    echo '</div>';
                                echo '</header>';

                                echo '<div class="wavo-pricing-body">';
                                    echo '<ul class="wavo-pricing-features">';

                                    $f_features = explode( ',', $pack['f_features'] );
                                    foreach ( $f_features as $feature ) {
                                        echo '<li>'.$feature.'</li>';
                                    }

                                    echo '</ul>';
                                echo '</div>';

                                echo '<footer class="wavo-pricing-footer">';
                                    $f_target = $pack['f_link']['is_external'] ? ' target="_blank"' : '';
                                    echo '<a class="wavo-select wavo-pack-button button '.$popular_btn.'" href="'.$pack['f_link']['url'].'"'.$f_target.'><span class="button_text">'.$pack['f_btn_title'].' </span></a>';
                                echo '</footer>';

                            echo '</li>';

                            echo '<li data-type="yearly-'.$id.'" class="is-hidden">';

                                echo '<header class="wavo-pricing-header">';
                                    echo $pack['b_title'] ? '<h2 class="wavo-pack-title">'.$pack['b_title'].'</h2>' : '';
                                    echo '<div class="wavo-price">';
                                        echo $pack['b_currency'] ? '<span class="wavo-currency">'.$pack['b_currency'].'</span>' : '';
                                        echo $pack['b_price'] ? '<span class="wavo-value">'.$pack['b_price'].'</span>' : '';
                                        echo $pack['b_period'] ? '<span class="wavo-duration">'.$pack['b_period'].'</span>' : '';
                                    echo '</div>';
                                echo '</header>';

                                echo '<div class="wavo-pricing-body">';
                                    echo '<ul class="wavo-pricing-features">';

                                        $b_features = explode( ',', $pack['b_features'] );
                                        foreach ( $b_features as $feature ) {
                                            echo '<li>'.$feature.'</li>';
                                        }

                                    echo '</ul>';
                                echo '</div>';

                                echo '<footer class="wavo-pricing-footer">';
                                    $b_target = $pack['b_link']['is_external'] ? ' target="_blank"' : '';
                                    echo '<a class="wavo-select wavo-pack-button button '.$popular_btn.'" href="'.$pack['b_link']['url'].'"'.$b_target.'><span class="button_text">'.$pack['b_btn_title'].' </span></a>';
                                echo '</footer>';

                            echo '</li>';

                        echo '</ul>';
                    echo '</li>';
                }
            echo '</ul>';
        echo '</div>';
    }
}
