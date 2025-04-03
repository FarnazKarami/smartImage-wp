<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Delete plugin settings
delete_option('saiat_settings');

// Remove alt tags added by the plugin
$images = get_posts([
    'post_type' => 'attachment',
    'post_mime_type' => 'image',
    'numberposts' => -1
]);

foreach ($images as $image) {
    delete_post_meta($image->ID, '_wp_attachment_image_alt');
}