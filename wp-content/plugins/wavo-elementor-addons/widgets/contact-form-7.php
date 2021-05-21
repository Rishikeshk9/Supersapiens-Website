<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.
class Wavo_Contact_Form_7 extends Widget_Base {
    use Wavo_Helper;
    public function get_name() {
        return 'wavo-contact-form-7';
    }
    public function get_title() {
        return 'Contact Form 7 (N)';
    }
    public function get_icon() {
        return 'eicon-form-horizontal';
    }
    public function get_categories() {
        return [ 'wavo' ];
    }
    // Registering Controls
    protected function register_controls() {
        $this->start_controls_section( 'wavo_cf7_global_controls',
            [
                'label'=> esc_html__( 'Form Data', 'wavo' ),
                'tab'=> Controls_Manager::TAB_CONTENT
            ]
        );
        $this->add_control('wavo_cf7_form_id_control',
            [
                'label'=> esc_html__( 'Select Form', 'wavo' ),
                'type'=> Controls_Manager::SELECT,
                'multiple'=> false,
                'options'=> $this->wavo_get_cf7(),
                'description'=> 'Select Form to Embed'
            ]
        );
        $this->end_controls_section();
        /*****   START CONTROLS SECTION   ******/

        /*****   END CONTROLS SECTION   ******/
        $this->start_controls_section( 'wavo_cf7_form_element_width_controls',
            [
                'label'=> esc_html__( 'Form Element Column Width', 'wavo' ),
                'tab'=> Controls_Manager::TAB_CONTENT,
                'condition'=> [ 'wavo_cf7_form_id_control!' => '' ]
            ]
        );
        $this->end_controls_section();
        /*****   START CONTROLS SECTION   ******/


        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('cf7_form_style_section',
            [
                'label'=> esc_html__( 'Form Content Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wavo_style_slider_width( 'cf7_form_width',array('{{WRAPPER}} .nt-cf7-form-wrapper form' => 'width: {{SIZE}}px;max-width: {{SIZE}}px;'), $min=0, $max=2000 );
        $this->wavo_style_flex_alignment( 'cf7_form_alignment','{{WRAPPER}} .nt-cf7-form-wrapper' );
        $this->wavo_style_padding( 'cf7_form_padding','{{WRAPPER}} .nt-cf7-form-wrapper form' );
        $this->wavo_style_margin( 'cf7_form_margin','{{WRAPPER}} .nt-cf7-form-wrapper form' );
        $this->wavo_style_border( 'cf7_form_border','{{WRAPPER}} .nt-cf7-form-wrapper form' );
        $this->wavo_style_box_shadow( 'cf7_form_boxshadow','{{WRAPPER}} .nt-cf7-form-wrapper form' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('cf7_form_label_style_section',
            [
                'label'=> esc_html__( 'Label Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wavo_style_typo( 'cf7_label_typo','{{WRAPPER}} .nt-cf7-form-wrapper form label' );
        $this->wavo_style_color( 'cf7_label_color','{{WRAPPER}} .nt-cf7-form-wrapper form label' );
        $this->wavo_style_flex_alignment( 'alignment','{{WRAPPER}} .nt-cf7-form-wrapper form label' );
        $this->wavo_style_padding( 'cf7_label_padding','{{WRAPPER}} .nt-cf7-form-wrapper form label' );
        $this->wavo_style_margin( 'cf7_label_margin','{{WRAPPER}} .nt-cf7-form-wrapper form label' );
        $this->wavo_style_border( 'cf7_flabel_border','{{WRAPPER}} .nt-cf7-form-wrapper form label' );

        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('cf7_form_input_style_section',
            [
                'label'=> esc_html__( 'Input Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wavo_style_typo( 'cf7_input_typo','{{WRAPPER}} input:not(.wpcf7-submit),{{WRAPPER}} textarea,{{WRAPPER}} form select' );
        $this->wavo_style_color( 'cf7_input_color','{{WRAPPER}} input:not(.wpcf7-submit),{{WRAPPER}} textarea,{{WRAPPER}} form select' );
        $this->wavo_style_slider_height( 'cf7_input_height',array('{{WRAPPER}} input:not(.wpcf7-submit), {{WRAPPER}} input[type="file"], {{WRAPPER}} form select' => 'height: {{SIZE}}px;line-height: {{SIZE}}px;','{{WRAPPER}} input[type="file"]' => 'padding-top: calc( ({{SIZE}}px / 2) - 18px )!important;padding-bottom: calc( ({{SIZE}}px / 2) - 18px )!important;height: inherit!important;line-height: inherit!important;' ), 30, 100 );
        $this->wavo_style_slider_width( 'cf7_input_width',array('{{WRAPPER}} input:not(.wpcf7-submit), {{WRAPPER}} .input-wrapper' => 'width: {{SIZE}}%;' ), 0, 100, '%' );
        $this->wavo_style_padding( 'cf7_input_padding','{{WRAPPER}} input:not(.wpcf7-submit), {{WRAPPER}} form select' );
        $this->wavo_style_margin( 'cf7_input_margin','{{WRAPPER}} input:not(.wpcf7-submit), {{WRAPPER}} form select,{{WRAPPER}} .nt-cf7-form-wrapper .wpcf7-form-control.wpcf7-checkbox,{{WRAPPER}} .nt-cf7-form-wrapper .wpcf7-form-control.wpcf7-radio,{{WRAPPER}} .nt-cf7-form-wrapper .wpcf7-form-control.wpcf7-acceptance' );
        $this->wavo_style_box_shadow( 'cf7_input_boxshadow','{{WRAPPER}} input:not(.wpcf7-submit), {{WRAPPER}} form select' );

        $this->start_controls_tabs( 'cf7_form_input_tabs');
        $this->start_controls_tab( 'cf7_form_input_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'wavo' ) ]
        );
        // Style function
        $this->wavo_style_background( 'cf7_input_background','{{WRAPPER}} input:not(.wpcf7-submit)',array('classic','gradient') );
        $this->wavo_style_border( 'cf7_input_border','{{WRAPPER}} input:not(.wpcf7-submit)' );
        $this->wavo_style_opacity( 'cf7_input_opacity','{{WRAPPER}} input:not(.wpcf7-submit)' );

        $this->end_controls_tab();

        $this->start_controls_tab( 'cf7_form_input_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wavo' ) ]
        );
        // Style function
        $this->wavo_style_background( 'cf7_input_hvr_background','{{WRAPPER}} input:not(.wpcf7-submit):hover',array('classic','gradient') );
        $this->wavo_style_border( 'cf7_input_hvr_border','{{WRAPPER}} input:not(.wpcf7-submit):hover' );
        $this->wavo_style_opacity( 'cf7_input_hvr_opacity','{{WRAPPER}} input:not(.wpcf7-submit):hover' );

        $this->end_controls_tab();

        $this->start_controls_tab( 'cf7_form_focus_tab',
            [ 'label'  => esc_html__( 'Focus', 'wavo' ) ]
        );
        // Style function
        $this->wavo_style_background( 'cf7_input_focus_background','{{WRAPPER}} input:not(.wpcf7-submit):focus',array('classic','gradient') );
        $this->wavo_style_border( 'cf7_input_focus_border','{{WRAPPER}} input:not(.wpcf7-submit):focus' );
        $this->wavo_style_opacity( 'cf7_input_focus_opacity','{{WRAPPER}} input:not(.wpcf7-submit):focus' );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('cf7_form_textarea_style_section',
            [
                'label'=> esc_html__( 'Textarea Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wavo_style_typo( 'cf7_textarea_typo','{{WRAPPER}} .nt-cf7-form-wrapper form textarea' );
        $this->wavo_style_slider_width( 'cf7_textarea_width',array('{{WRAPPER}} .nt-cf7-form-wrapper form textarea' => 'width: {{SIZE}}%;max-width: {{SIZE}}%;'), $min=0, $max=2000, $unit='%' );
        $this->wavo_style_slider_height( 'cf7_textarea_height',array('{{WRAPPER}} .nt-cf7-form-wrapper form textarea' => 'height: {{SIZE}}px;' ) );
        $this->wavo_style_padding( 'cf7_textarea_padding','{{WRAPPER}} .nt-cf7-form-wrapper form textarea' );
        $this->wavo_style_margin( 'cf7_textarea_margin','{{WRAPPER}} .nt-cf7-form-wrapper form textarea' );
        $this->wavo_style_box_shadow( 'cf7_textarea_boxshadow','{{WRAPPER}} .nt-cf7-form-wrapper form textarea' );

        $this->start_controls_tabs( 'cf7_form_textarea_tabs');
        $this->start_controls_tab( 'cf7_form_textarea_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'wavo' ) ]
        );
        // Style function
        $this->wavo_style_color( 'cf7_textarea_color','{{WRAPPER}} textarea' );
        $this->wavo_style_background( 'cf7_textarea_background','{{WRAPPER}} .nt-cf7-form-wrapper form textarea',array('classic','gradient') );
        $this->wavo_style_border( 'cf7_textarea_border','{{WRAPPER}} .nt-cf7-form-wrapper form textarea' );
        $this->wavo_style_opacity( 'cf7_textarea_opacity','{{WRAPPER}} .nt-cf7-form-wrapper form textarea' );

        $this->end_controls_tab();

        $this->start_controls_tab( 'cf7_form_textarea_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wavo' ) ]
        );
        // Style function
        $this->wavo_style_color( 'cf7_textarea_hvr_color','{{WRAPPER}} .nt-cf7-form-wrapper form textarea:hover' );
        $this->wavo_style_background( 'cf7_textarea_hvr_background','{{WRAPPER}} .nt-cf7-form-wrapper form textarea:hover',array('classic','gradient') );
        $this->wavo_style_border( 'cf7_textarea_hvr_border','{{WRAPPER}} .nt-cf7-form-wrapper form textarea:hover' );
        $this->wavo_style_opacity( 'cf7_textarea_hvr_opacity','{{WRAPPER}} .nt-cf7-form-wrapper form textarea:hover' );

        $this->end_controls_tab();

        $this->start_controls_tab( 'cf7_form_textarea_focus_tab',
            [ 'label'  => esc_html__( 'Focus', 'wavo' ) ]
        );
        // Style function
        $this->wavo_style_color( 'cf7_textarea_focus_color','{{WRAPPER}} .nt-cf7-form-wrapper form textarea:focus' );
        $this->wavo_style_background( 'cf7_textarea_focus_background','{{WRAPPER}} .nt-cf7-form-wrapper form textarea:focus',array('classic','gradient') );
        $this->wavo_style_border( 'cf7_textarea_focus_border','{{WRAPPER}} .nt-cf7-form-wrapper form textarea:focus' );
        $this->wavo_style_opacity( 'cf7_textarea_focus_opacity','{{WRAPPER}} .nt-cf7-form-wrapper form textarea:focus' );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();
        /*****   END CONTROLS SECTION   ******/

        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section('cf7_formbtn_style_section',
            [
                'label' => esc_html__( 'Submit Button Style', 'wavo' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );
        $this->wavo_style_text_alignment( 'cf7_submit_alignment','{{WRAPPER}} .wpcf7 form' );
        $this->wavo_style_typo( 'cf7_submit_typo','{{WRAPPER}} .wpcf7 form .wpcf7-submit' );
        $this->wavo_style_slider_width( 'cf7_submit_width',array('{{WRAPPER}} .wpcf7 form .wpcf7-submit' => 'text-align:center;width: {{SIZE}}%;min-width: {{SIZE}}%;'), $min=0, $max=2000, $unit='%' );
        $this->wavo_style_slider_height( 'cf7_submit_height',array('{{WRAPPER}} .wpcf7 form .wpcf7-submit' => 'height: {{SIZE}}px;line-height: {{SIZE}}px;', ) );
        $this->wavo_style_padding( 'cf7_submit_padding','{{WRAPPER}} .wpcf7 form .wpcf7-submit' );
        $this->wavo_style_margin( 'cf7_submit_margin','{{WRAPPER}} .wpcf7 form .wpcf7-submit' );

        $this->start_controls_tabs( 'cf7_formbtn_tabs');
        $this->start_controls_tab( 'cf7_formbtn_normal_tab',
            [ 'label'  => esc_html__( 'Normal', 'wavo' ) ]
        );
        // Style function
        $this->wavo_style_color( 'cf7_submit_color','{{WRAPPER}} .wpcf7 form .wpcf7-submit' );
        $this->wavo_style_background( 'cf7_submit_background','{{WRAPPER}} .wpcf7 form .wpcf7-submit',array('classic','gradient') );
        $this->wavo_style_border( 'cf7_submit_border','{{WRAPPER}} .wpcf7 form .wpcf7-submit' );
        $this->wavo_style_box_shadow( 'cf7_submit_boxshadow','{{WRAPPER}} .wpcf7 form .wpcf7-submit' );
        $this->end_controls_tab();

        $this->start_controls_tab( 'cf7_formbtn_hover_tab',
            [ 'label' => esc_html__( 'Hover', 'wavo' ) ]
        );
        // Style function
        $this->wavo_style_color( 'cf7_submit_hvr_color','{{WRAPPER}} .wpcf7 form .wpcf7-submit:hover' );
        $this->wavo_style_background( 'cf7_submit_hvr_background','{{WRAPPER}} .wpcf7 form .wpcf7-submit:hover',array('classic','gradient') );
        $this->wavo_style_border( 'cf7_submit_hvr_border','{{WRAPPER}} .wpcf7 form .wpcf7-submit:hover' );
        $this->wavo_style_box_shadow( 'cf7_submit_hvr_boxshadow','{{WRAPPER}} .wpcf7 form .wpcf7-submit:hover' );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    protected function render() {
        $settings  = $this->get_settings_for_display();
        $elementid = $this->get_id();
        $formid = $settings['wavo_cf7_form_id_control'];

        if (!empty($settings['wavo_cf7_form_id_control'])){
            echo '<div class="nt-cf7-form-wrapper form_'.$elementid.'">';
                echo do_shortcode( '[contact-form-7 id="'.$formid.'"]' );
            echo '</div>';
        } else {
            echo "Please Select a Form";
        }

    }
}
