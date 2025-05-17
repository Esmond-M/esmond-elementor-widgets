<?php
declare(strict_types=1);
namespace Esmond\ElementorWidgets\Widgets;

use Elementor\Widget_Base;

if (!class_exists('Card_Widget')) {
    class Card_Widget extends Widget_Base
    {
  	/**
	 * Get widget name.
	 *
	 * Retrieve Card widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
        public function get_name() {
            return 'card';
        }
	
        public function get_title() {
            return esc_html__( 'EM Card Widget', 'esmond-card-widget' );
        }

        public function get_icon() {
            return 'eicon-header';
        }

        public function get_custom_help_url() {
            return 'https://github.com/Esmond-M/em-client';
        }

        public function get_categories() {
            return [ 'esmond' ];
        }

        public function get_keywords() {
            return [ 'card', 'service', 'highlight'];
        }

        protected function register_controls() { 
            $this->start_controls_section(
                'content_section',
                [
                'label' => esc_html__( 'Content', 'esmond-card-widget' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );
            $this->add_control(
                'card_title',
                [
                'label' => esc_html__( 'Card title', 'esmond-card-widget' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__( 'Your card title here', 'esmond-card-widget' ),
                ]
            );
            $this->add_control(
                'card_description',
                [
                'label' => esc_html__( 'Card Description', 'esmond-card-widget' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label_block'   => true,
                'placeholder' => esc_html__( 'Your card description here', 'esmond-card-widget' ),
                ]
            );
            $this->end_controls_section();
        }

        protected function render() {

            // get our input from the widget settings.
            $settings = $this->get_settings_for_display();
        
        // get the individual values of the input
        $card_title = $settings['card_title'];
        $card_description = $settings['card_description'];
    
        ?>
    
            <!-- Start rendering the output -->
            <div class="card">
                <h3 class="card_title"><?php echo $card_title;  ?></h3>
                <p class= "card__description"><?php echo $card_description;  ?></p>
            </div>
            <!-- End rendering the output -->
    
            <?php
    
       }

	} // Closing bracket for class
}
