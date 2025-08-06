<?php

declare(strict_types=1);
namespace Esmond\ElementorWidgets\Admin;

if (!defined('ABSPATH')) exit;

class Newsletter_Subscribers {

    public static function init() {
        add_action('admin_menu', [__CLASS__, 'add_admin_menu']);
    }

    public static function add_admin_menu() {
        add_submenu_page(
            'tools.php',
            'Newsletter Subscribers',
            'Newsletter Subscribers',
            'manage_options',
            'esmond-newsletter-subscribers',
            [__CLASS__, 'render_admin_page']
        );
    }

    public static function render_admin_page() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'esmond_newsletter';

        $subscribers = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC");

        echo '<div class="wrap"><h1>Newsletter Subscribers</h1>';

        if ($subscribers) {
            echo '<table class="widefat striped">';
            echo '<thead><tr><th>ID</th><th>Email</th><th>Date Subscribed</th></tr></thead><tbody>';
            foreach ($subscribers as $row) {
                echo '<tr>';
                echo '<td>' . esc_html($row->id) . '</td>';
                echo '<td>' . esc_html($row->email) . '</td>';
                echo '<td>' . (isset($row->date_subscribed) ? esc_html($row->date_subscribed) : '-') . '</td>';
                echo '</tr>';
            }
            echo '</tbody></table>';
        } else {
            echo '<p>No subscribers found.</p>';
        }

        echo '</div>';
    }
}
