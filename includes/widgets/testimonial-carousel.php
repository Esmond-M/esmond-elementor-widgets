<?php
declare(strict_types=1);
namespace Esmond\ElementorWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if (!class_exists('Testimonial_Carousel_Widget;')) {
    class Testimonial_Carousel_Widget extends Widget_Base
    {

     public function __construct( $data = [], $args = null ) {
        parent::__construct( $data , $args );

    }
        
    public function get_name() {
        return 'esmond_testimonial_carousel';
    }

    public function get_title() {
        return __( 'EM Testimonial Carousel', 'esmond-elementor-widgets' );
    }

    public function get_icon() {
        return 'eicon-carousel';
    }

    public function get_categories() {
        return ['esmond'];
    }

    public function get_style_depends() {
        return [ 'slick-carousel-css' ];
    }

    public function get_script_depends() {
        return [ 'slick-carousel-js', 'testimonial-carousel-init' ];
    }    

    protected function _register_controls() {
        $this->start_controls_section('content_section', [
            'label' => __('Testimonials', 'esmond-elementor-widgets'),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);

        $repeater = new Repeater();

        $repeater->add_control('name', [
            'label' => __('Name', 'esmond-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Jane Doe',
        ]);

        $repeater->add_control('role', [
            'label' => __('Role', 'esmond-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'CEO, Company',
        ]);

        $repeater->add_control('photo', [
            'label' => __('Photo', 'esmond-elementor-widgets'),
            'type' => Controls_Manager::MEDIA,
        ]);

        $repeater->add_control('testimonial', [
            'label' => __('Testimonial', 'esmond-elementor-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'This is an amazing service!',
        ]);

        $this->add_control('testimonials', [
            'label' => __('Testimonials List', 'esmond-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [],
            'title_field' => '{{{ name }}}',
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( ! empty($settings['testimonials']) ) {
            echo '<div class="testimonial-carousel">';
            foreach ($settings['testimonials'] as $item) {
                echo '<div class="testimonial-item" style="text-align: center; padding: 20px;">';
                if ($item['photo']['url']) {
                    echo '<img src="' . esc_url($item['photo']['url']) . '" alt="' . esc_attr($item['name']) . '" style="width: 80px; height: 80px; border-radius: 50%; margin-bottom: 10px;">';
                }
                echo '<h3>' . esc_html($item['name']) . '</h3>';
                echo '<p><em>' . esc_html($item['role']) . '</em></p>';
                echo '<p style="font-style: italic;">"' . esc_html($item['testimonial']) . '"</p>';
                echo '</div>';
            }
            echo '</div>';
        }
    }

    } // Closing bracket for class

}
