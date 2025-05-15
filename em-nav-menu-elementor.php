<?php

/**
* Main plugin file.
* PHP version 7.4.33

* @category Wordpress_Plugin
* @package  Esmond-M
* @author   Esmond Mccain <esmondmccain@gmail.com>
* @license  https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License
* @link     esmondmccain.com
* @return
*/
declare(strict_types=1);
namespace emNavMenuElementor;
/**
 * Plugin Name:       EM NavMenuElementor
 * Description:       This plugin adds a new navigation menu widget to the general category section of the Elementor page builder.
 * Requires at least: 6.1
 * Requires PHP:      7.4.33
 * Requires Plugins: woocommerce
 * Version:           0.1.0
 * Author:            Esmond Mccain
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       em-Woo-Team-Manage
 *
 * @package emNavMenuElementor
 */

defined('ABSPATH') or die();
/**
 * Define global constants

 * @param $constant_name
 * @param $value
 *
 * @return array
 */
function emNavMenuElementorConstants($constant_name, $value)
{
    $constant_name_prefix = 'EM_Woo_Team_Manage_Constants_';
    $constant_name = $constant_name_prefix . $constant_name;
    if (!defined($constant_name))
        define($constant_name, $value);
}

emNavMenuElementorConstants('DIR', dirname(plugin_basename(__FILE__)));
emNavMenuElementorConstants('BASE', plugin_basename(__FILE__));
emNavMenuElementorConstants('URL', plugin_dir_url(__FILE__));
emNavMenuElementorConstants('PATH', plugin_dir_path(__FILE__));
emNavMenuElementorConstants('SLUG', dirname(plugin_basename(__FILE__)));
require  EM_Woo_Team_Manage_Constants_PATH
    . 'includes/classes/emNavMenuElementor.php';
use emNavMenuElementor\emNavMenuElementor;

new emNavMenuElementor;