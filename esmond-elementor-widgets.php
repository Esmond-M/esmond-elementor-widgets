<?php
/**
 * Plugin Name: Esmond Elementor Widgets
 * Plugin URI: https://github.com/Esmond-M
 * Author: Esmond Mccain
 * Author URI: https://esmondmccain.com/
 * Description: Collection of elementor widgets. 
 * Version: 0.1.0
 * License: 0.1.0
 * License URL: http://www.gnu.org/licenses/gpl-2.0.txt
 * text-domain: esmond-elementor-widgets
*/
namespace Esmond\ElementorWidgets;


use Esmond\ElementorWidgets\Widgets\FAQ_Accordion_Widget;
use Esmond\ElementorWidgets\Widgets\Newsletter_Signup_Widget;
use Esmond\ElementorWidgets\Widgets\Testimonial_Carousel_Widget;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

final class EsmondElementorWidgets {

    const VERSION = '0.1.0';
    const ELEMENTOR_MINIMUM_VERSION = '3.0.0';
    const PHP_MINIMUM_VERSION = '7.0';

    private static $_instance = null;

    public function __construct() {
        add_action( 'init', [ $this, 'i18n' ] );
        add_action( 'elementor/elements/categories_registered', [ $this, 'create_new_category' ] );
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );

        // Handle AJAX for Newsletter Signup
        add_action('wp_ajax_newsletter_signup',  [ $this, 'esmond_handle_newsletter_signup' ]);
        add_action('wp_ajax_nopriv_newsletter_signup', [ $this, 'esmond_handle_newsletter_signup'] );
    }

    public function esmond_handle_newsletter_signup() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'esmond_newsletter';

        $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';

        if (!is_email($email)) {
            wp_send_json_error(['message' => 'Invalid email']);
        }

        // Check if email already exists
        $exists = $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM $table_name WHERE email = %s",
            $email
        ));

        if ($exists > 0) {
            wp_send_json_success(['message' => 'You’re already subscribed!']);
        }

        // Insert new email
        $inserted = $wpdb->insert(
            $table_name,
            [
                'email' => $email,
                'date_subscribed' => current_time('mysql')
            ],
            ['%s', '%s']
        );

        if ($inserted === false) {
            wp_send_json_error(['message' => 'Failed to save. Try again later.']);
        }

        wp_send_json_success(['message' => 'Thank you for subscribing!']);
    }
    
    public function i18n() {
        load_plugin_textdomain( 'esmond-elementor-widgets' );
    }


    public function init_widgets() {

        // Require the widget class.
        require_once __DIR__ . '/includes/widgets/faq-accordion.php';
        require_once __DIR__ . '/includes/widgets/newsletter-signup.php';        
        require_once __DIR__ . '/includes/widgets/testimonial-carousel.php';

        // Register widget with elementor.
        \Elementor\Plugin::instance()->widgets_manager->register( new FAQ_Accordion_Widget() );
        \Elementor\Plugin::instance()->widgets_manager->register( new Newsletter_Signup_Widget() );        
        \Elementor\Plugin::instance()->widgets_manager->register( new Testimonial_Carousel_Widget() );

    }

    public static function get_instance() {

        if ( null == self::$_instance ) {
            self::$_instance = new Self();
        }

        return self::$_instance;

    }

    public function create_new_category( $elements_manager ) {

        $elements_manager->add_category(
            'esmond',
            [
                'title' => __( 'Esmond', 'Esmond-elementor-widgets' ),
                'icon'  => 'fa fa-plug'
            ]
        );

    }

}
// includes scripts and styles
require_once __DIR__ . '/includes/assets.php';

require_once __DIR__ . '/includes/installer.php';

// Activation
register_activation_hook(__FILE__, ['Esmond\\ElementorWidgets\\Installer\\Installer', 'create_table']);

// includes admin files

require_once __DIR__ . '/includes/admin/newsletter-subscribers.php';
\Esmond\ElementorWidgets\Admin\Newsletter_Subscribers::init();

EsmondElementorWidgets::get_instance();