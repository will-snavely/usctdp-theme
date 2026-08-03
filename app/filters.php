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
 * After AJAX cart removal empties the legacy cart, reload the page so the
 * cart-empty template renders. wc_fragments_refreshed is a mini-cart event and
 * doesn't reliably fire for legacy cart removals, so we use a MutationObserver
 * to watch the cart table tbody directly and reload as soon as the last
 * tr.cart_item is removed from the DOM. The removed_from_cart WooCommerce event
 * is also bound as a secondary trigger.
 */
add_action('wp_footer', function () {
    if (!is_cart()) {
        return;
    }
    $cart_url = esc_url(wc_get_cart_url());
    ?>
    <script>
    (function () {
        var tbody = document.querySelector('.woocommerce-cart-form__contents tbody');
        if (!tbody) return; // not in the populated cart view, nothing to do

        function reloadIfEmpty() {
            if (!tbody.querySelector('tr.cart_item')) {
                window.location.href = <?php echo json_encode($cart_url); ?>;
            }
        }

        new MutationObserver(reloadIfEmpty).observe(tbody, { childList: true, subtree: true });

        if (typeof jQuery !== 'undefined') {
            jQuery(document.body).on('removed_from_cart', reloadIfEmpty);
        }
    }());
    </script>
    <?php
});

/**
 * Ensure the login page is always accessible during Coming Soon mode.
 * wp-login.php itself is never gated (Coming Soon only hooks
 * template_include, which core's login screen doesn't go through) - but
 * WooCommerce redirects wp-login.php to /my-account/ for its own themed
 * login form, and that page IS subject to the same template_include gate
 * as everything else. woocommerce_coming_soon_exclude is the filter
 * ComingSoonRequestHandler::should_show_coming_soon() actually checks; an
 * earlier version of this hooked woocommerce_is_coming_soon instead, which
 * doesn't exist anywhere in WooCommerce and silently did nothing.
 */
add_filter('woocommerce_coming_soon_exclude', function ($excluded) {
    if (is_account_page()) {
        return true;
    }
    return $excluded;
});

/**
 * Force our own coming-soon.php (resources/views/coming-soon.blade.php) to
 * be used instead of WooCommerce's own registered "coming-soon" block
 * template. WooCommerce calls add_theme_support('block-templates') right
 * before resolving this template (ComingSoonRequestHandler::handle_template_include()),
 * specifically so its own block template works on classic themes like this
 * one - but that also makes locate_block_template() prefer its block
 * template over our classic PHP file, even though the classic file exists
 * and would otherwise win. This is the last filter get_query_template()
 * applies before returning, so it has the final say.
 */
add_filter('coming-soon_template', function ($template) {
    return locate_template('coming-soon.php') ?: $template;
});

/**
 * Require an account to purchase. This gates both the add-to-cart button
 * rendered by WooCommerce templates and WC_Cart::add_to_cart() itself, so
 * it also blocks direct ?add-to-cart= requests and AJAX/API calls from
 * logged-out users, not just the UI.
 */
add_filter('woocommerce_is_purchasable', function ($is_purchasable) {
    if (!is_user_logged_in()) {
        return false;
    }
    return $is_purchasable;
});

/**
 * Contact Form 7 normally runs its form markup through wpautop, wrapping every
 * field in <p>/<br> tags. Our contact form template already provides its own
 * layout wrappers, so autop is only disabled for form rendering (not for the
 * mail body, which still needs it if HTML mail is ever turned on).
 */
add_filter('wpcf7_autop_or_not', function ($autop, $options = '') {
    if (($options['for'] ?? '') === 'form') {
        return false;
    }
    return $autop;
}, 10, 2);

/**
 * Always generate the WooCommerce account username from the customer's email
 * instead of collecting one at registration, regardless of the "Automatically
 * generate username from customer email" admin toggle (WooCommerce > Settings
 * > Accounts & Privacy). Keeps this enforced in code so it can't drift back
 * via the admin UI.
 */
add_filter('pre_option_woocommerce_registration_generate_username', function () {
    return 'yes';
});

/**
 * Always generate the account password too and email the customer a link to
 * set it, rather than collecting one at registration. Same rationale and
 * same drift-proofing as the username filter above.
 */
add_filter('pre_option_woocommerce_registration_generate_password', function () {
    return 'yes';
});

/**
 * Prompt logged-out visitors to log in where the add-to-cart button would be.
 */
add_action('woocommerce_single_product_summary', function () {
    if (is_user_logged_in()) {
        return;
    }
    ?>
    <p class="woocommerce-info">
        <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"><?php esc_html_e('Log in', 'sage'); ?></a>
        <?php esc_html_e('to purchase this item.', 'sage'); ?>
    </p>
    <?php
}, 25);
