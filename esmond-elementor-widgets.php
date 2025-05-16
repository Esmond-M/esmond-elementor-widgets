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

use Esmond\ElementorWidgets\Widgets\Nav_Menu;

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
        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
        add_action( 'elementor/elements/categories_registered', [ $this, 'create_new_category' ] );
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
    }

    public function i18n() {
        load_plugin_textdomain( 'esmond-elementor-widgets' );
    }

    public function init_plugin() {
        // Check php version
        // check if elementor is installed
        // bring in the widget classes
        // bring in the controls
    }

    public function init_controls() {
        
    }

    public function init_widgets() {

        // Require the widget class.
        require_once __DIR__ . '/widgets/nav-menu.php';

        // Register widget with elementor.
        \Elementor\Plugin::instance()->widgets_manager->register( new Nav_Menu() );

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

EsmondElementorWidgets::get_instance();