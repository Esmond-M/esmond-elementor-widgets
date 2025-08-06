<?php
declare(strict_types=1);
namespace Esmond\ElementorWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!class_exists('Newsletter_Signup_Widget')) {
   class Newsletter_Signup_Widget extends Widget_Base {

    public function __construct( $data = [], $args = null ) {
        parent::__construct( $data , $args );
  
    }

    public function get_name() {
        return 'esmond_newsletter_signup';
    }

    public function get_title() {
        return __( 'EM Newsletter Signup', 'esmond-elementor-widgets' );             
    }

    public function get_icon() {
        return 'eicon-mail';
    }

    public function get_categories() {
        return ['esmond'];
    }

    public function get_style_depends() {
        return [ 'newsletter-signup-style' ];
    }

    public function get_script_depends() {
        return [ 'newsletter-signup-init' ];
    }
    
    protected function _register_controls() {
        $this->start_controls_section('content_section', [
            'label' => __('Settings', 'esmond-elementor-widgets'),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('placeholder', [
            'label' => __('Placeholder', 'esmond-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Enter your email...',
        ]);

        $this->add_control('button_text', [
            'label' => __('Button Text', 'esmond-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Subscribe',
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        echo '<form class="newsletter-form" method="POST">';
        echo '<input type="email" name="email" placeholder="' . esc_attr($settings['placeholder']) . '" required>'; 
        echo '<button type="submit">' . esc_html($settings['button_text']) . '</button>'; 
        echo '<div class="newsletter-response" style="margin-top:10px;"></div>'; 
        echo '</form>';
    }
  } // Closing bracket for class

}
