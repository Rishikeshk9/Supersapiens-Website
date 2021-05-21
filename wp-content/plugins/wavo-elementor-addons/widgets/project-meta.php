<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Wavo_Project_Meta extends Widget_Base {
    use Wavo_Helper;
    public function get_name() {
        return 'wavo-project-meta';
    }
    public function get_title() {
        return 'Project Meta (N)';
    }
    public function get_icon() {
        return 'eicon-image';
    }
    public function get_categories() {
        return [ 'wavo-cpt' ];
    }
    // Registering Controls
    protected function register_controls() {
        /*****   START CONTROLS SECTION   ******/
        $this->start_controls_section( 'wavo_project_next_settings',
            [
                'label' => esc_html__('Projects Post Meta Data', 'wavo'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control( 'meta',
            [
                'label' => esc_html__( 'Select Meta', 'wavo' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'author' => esc_html__( 'Post Author', 'wavo' ),
                    'date' => esc_html__( 'Post Date', 'wavo' ),
                    'cat' => esc_html__( 'Post Category', 'wavo' ),
                    'tag' => esc_html__( 'Post Tags', 'wavo' ),
                ],
                'default' => 'author'
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section( 'wavo_project_meta_style',
            [
                'label' => esc_html__( 'Post Meta ', 'wavo' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->wavo_style_typo( 'project_text_typo','{{WRAPPER}} p.author, {{WRAPPER}} p a' );
        $this->add_control( 'project_text_color',
            [
                'label' => esc_html__( 'Color', 'wavo' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [ '{{WRAPPER}} .call-action.next .content h6' => 'color:{{VALUE}};' ]
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {
        $settings   = $this->get_settings_for_display();
        $i = 1;

        if( 'author' == $settings['meta'] ) {
            echo '<p class="author">'.get_the_author(). '</p>';
        }

        if( 'date' == $settings['meta'] ) {
            echo '<p class="date">';
                $archive_year  = get_the_time( 'Y' );
                $archive_month = get_the_time( 'm' );
                $archive_day   = get_the_time( 'd' );
                printf( '<a href="%1$s" title="%1$s">%2$s</a>',
                    esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ),
                    get_the_date()
                );
            echo '</p>';
        }

        if( 'cat' == $settings['meta'] ) {
            $terms = get_the_terms( get_the_ID() , 'projects_cat' );
            if( !is_wp_error( $terms ) && $terms ) {
                echo '<p class="cats">';
                foreach ( $terms as $term ) {
                    $term_link = get_term_link( $term, 'projects_cat' );
                    if( !is_wp_error( $term_link ) ) {
                        echo '<a href="' . $term_link . '" title="' . $term_link . '">' . $term->name . '</a>';
                        echo ( $i < count( $terms ) ) ? " , " : "";
                    }
                    $i++;
                }
                echo '</p>';
            } else {
                echo '<p class="cats">'. esc_html__( 'This post has no category yet!', 'wavo' ) .'</p>';
            }
        }

        if( 'tag' == $settings['meta'] ) {
            $terms = get_the_term_list( get_the_ID(), 'projects_tag', '', ', ' );
            if( $terms ) {
                echo '<p class="tags">'.$terms.'</p>';
            } else {
                echo '<p class="tags">'. esc_html__( 'This post has no tags yet!', 'wavo' ) .'</p>';
            }
        }

    }
}
