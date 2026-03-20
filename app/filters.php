<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

/**
 * Update Cart Count via AJAX
 */
add_filter('woocommerce_add_to_cart_fragments', function ($fragments) {
    ob_start();
    ?>
    <span
        class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-[10px] font-black leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full border-2 border-[#5c88da]">
        <?php echo WC()->cart->get_cart_contents_count(); ?>
    </span>
    <?php
    // This matches the selector in your HTML
    $fragments['span.bg-red-600'] = ob_get_clean();
    return $fragments;
});


/**
 * Ensure the login page is always accessible.
 */
add_filter('woocommerce_is_coming_soon', function($is_coming_soon) {
    if (is_account_page()) {
        return false; // Bypass coming soon for the account/login page
    }
    return $is_coming_soon;
});
