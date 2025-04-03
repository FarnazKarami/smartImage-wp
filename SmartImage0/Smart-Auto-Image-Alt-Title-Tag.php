<!DOCTYPE html>
<?php
/**
 * Plugin Name: Smart Auto Image Alt & Title Tag
 * Description: Automatically generates ALT and TITLE tags for images using AI or predefined keyword rules.
 * Version: 1.0
 * Author: Your Name
 * Text Domain: smart-auto-alt
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define plugin path
define('SAIAT_PLUGIN_PATH', plugin_dir_path(__FILE__));

// Include required files
require_once SAIAT_PLUGIN_PATH . 'admin/settings-page.php';
require_once SAIAT_PLUGIN_PATH . 'includes/alt-tag-generator.php';
require_once SAIAT_PLUGIN_PATH . 'includes/bulk-optimizer.php';

// Hook to add alt and title tags when images are uploaded
add_filter('wp_generate_attachment_metadata', 'saiat_generate_alt_tags', 10, 2);

// Activation hook
function saiat_activate() {
    add_option('saiat_settings', []);
}
register_activation_hook(__FILE__, 'saiat_activate');

// Deactivation hook
function saiat_deactivate() {
    delete_option('saiat_settings');
}
register_deactivation_hook(__FILE__, 'saiat_deactivate');