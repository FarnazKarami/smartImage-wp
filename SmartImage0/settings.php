<?php
if (!defined('ABSPATH')) {
    exit;
}

// Add admin menu
function saiat_add_admin_menu() {
    add_menu_page(
        'Smart Alt Tags',
        'Smart Alt Tags',
        'manage_options',
        'saiat-settings',
        'saiat_settings_page',
        'dashicons-image-filter',
        80
    );
}
add_action('admin_menu', 'saiat_add_admin_menu');

// Settings page content
function saiat_settings_page() {
    ?>
    <div class="wrap">
        <h1>Smart Auto Image Alt & Title Tag</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('saiat_settings_group');
            do_settings_sections('saiat-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register settings
function saiat_register_settings() {
    register_setting('saiat_settings_group', 'saiat_settings');

    add_settings_section(
        'saiat_main_section',
        'Settings',
        null,
        'saiat-settings'
    );

    add_settings_field(
        'saiat_use_ai',
        'Use AI for Alt Tags',
        'saiat_use_ai_callback',
        'saiat-settings',
        'saiat_main_section'
    );
}
add_action('admin_init', 'saiat_register_settings');

// Checkbox for AI usage
function saiat_use_ai_callback() {
    $options = get_option('saiat_settings');
    $checked = isset($options['use_ai']) ? 'checked' : '';
    echo '<input type="checkbox" name="saiat_settings[use_ai]" value="1" ' . $checked . ' />';
}

function saiat_enqueue_admin_styles() {
    wp_enqueue_style('saiat-admin-css', plugin_dir_url(__FILE__) . '../assets/css/styles.css');
}
add_action('admin_enqueue_scripts', 'saiat_enqueue_admin_styles');