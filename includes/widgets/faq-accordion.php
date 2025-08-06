<?php
declare(strict_types=1);
namespace Esmond\ElementorWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if (!class_exists('FAQ_Accordion_Widget')) {
   class FAQ_Accordion_Widget extends Widget_Base {

    public function __construct( $data = [], $args = null ) {
        parent::__construct( $data , $args );

    }

    public function get_name() {
        return 'esmond_faq_accordion';
    }

    public function get_title() {
        return __( 'EM FAQ Accordion', 'esmond-elementor-widgets' );        
    }

    public function get_icon() {
        return 'eicon-editor-list';
    }

    public function get_categories() {
        return ['esmond'];
    }

    public function get_script_depends() {
        return [ 'faq-accordion-init' ];
    }    

    protected function _register_controls() {
        $this->start_controls_section('content_section', [
            'label' => __('FAQs', 'esmond-elementor-widgets'),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);

        $repeater = new Repeater();

        $repeater->add_control('question', [
            'label' => __('Question', 'esmond-elementor-widgets'),
            'type' => Controls_Manager::TEXT,
            'default' => 'What is your return policy?',
        ]);

        $repeater->add_control('answer', [
            'label' => __('Answer', 'esmond-elementor-widgets'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'We accept returns within 30 days.',
        ]);

        $this->add_control('faq_list', [
            'label' => __('FAQ Items', 'esmond-elementor-widgets'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [],
            'title_field' => '{{{ question }}}',
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if (!empty($settings['faq_list'])) {
            echo '<div class="faq-accordion">';
            foreach ($settings['faq_list'] as $index => $item) {
                $question_id = 'faq-' . $this->get_id() . '-' . $index;
                echo '<div class="faq-item">';
                echo '<button class="faq-question" aria-expanded="false" aria-controls="' . esc_attr($question_id) . '">' . esc_html($item['question']) . '</button>';
                echo '<div id="' . esc_attr($question_id) . '" class="faq-answer" hidden>' . wp_kses_post($item['answer']) . '</div>';
                echo '</div>';
            }
            echo '</div>';
        }
    }
} // Closing bracket for class
}
