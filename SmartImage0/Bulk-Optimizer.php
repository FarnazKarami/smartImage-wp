<?php
if (!defined('ABSPATH')) {
    exit;
}

function saiat_bulk_optimize_images() {
    $images = get_posts([
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'numberposts' => -1
    ]);

    foreach ($images as $image) {
        $alt_text = get_post_meta($image->ID, '_wp_attachment_image_alt', true);
        if (empty($alt_text)) {
            saiat_generate_alt_tags([],$image->ID);
        }
    }

    return "Bulk optimization completed!";
}

// Add a button in the admin settings page for bulk optimization
function saiat_bulk_optimizer_button() {
    ?>
    <form method="post">
        <input type="submit" name="saiat_bulk_optimize" value="Optimize All Images" class="button button-primary">
    </form>
    <?php

    if (isset($_POST['saiat_bulk_optimize'])) {
        echo '<div class="updated"><p>' . saiat_bulk_optimize_images() . '</p></div>';
    }
}
add_action('admin_notices', 'saiat_bulk_optimizer_button');