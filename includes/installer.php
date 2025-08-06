<?php
declare(strict_types=1);

namespace Esmond\ElementorWidgets\Installer;

class Installer {
    public static function create_table() {
        global $wpdb;

        $table_name = $wpdb->prefix . 'esmond_newsletter';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            email varchar(255) NOT NULL,
            date_subscribed datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id),
            UNIQUE KEY email (email)
        ) $charset_collate;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    }
}