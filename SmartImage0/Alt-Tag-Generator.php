<?php
if (!defined('ABSPATH')) {
    exit;
}

function saiat_generate_alt_tags($metadata, $attachment_id) {
    $options = get_option('saiat_settings');
    $use_ai = isset($options['use_ai']) ? $options['use_ai'] : false;

    $image_title = get_the_title($attachment_id);
    $alt_text = $image_title; // Default to image title

    if ($use_ai) {
        // AI integration (Example: OpenAI API call)
        $alt_text = saiat_generate_ai_alt_text($image_title);
    }

    update_post_meta($attachment_id, '_wp_attachment_image_alt', $alt_text);
    return $metadata;
}

function saiat_generate_ai_alt_text($image_title) {
    // Placeholder AI function (Replace with API call)
    return "AI-generated description of: " . $image_title;
}