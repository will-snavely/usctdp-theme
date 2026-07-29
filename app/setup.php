<?php

/**
 * Theme setup.
 */

namespace App;

use Illuminate\Support\Facades\Vite;

/**
 * Inject styles into the block editor.
 *
 * @return array
 */
add_filter('block_editor_settings_all', function ($settings) {
    $style = Vite::asset('resources/css/editor.css');

    $settings['styles'][] = [
        'css' => "@import url('{$style}')",
    ];

    return $settings;
});

/**
 * Inject scripts into the block editor.
 *
 * @return void
 */
add_filter('admin_head', function () {
    if (!get_current_screen()?->is_block_editor()) {
        return;
    }

    $dependencies = json_decode(Vite::content('editor.deps.json'));

    foreach ($dependencies as $dependency) {
        if (!wp_script_is($dependency)) {
            wp_enqueue_script($dependency);
        }
    }

    echo Vite::withEntryPoints([
        'resources/js/editor.js',
    ])->toHtml();
});

/**
 * Use the generated theme.json file.
 *
 * @return string
 */
add_filter('theme_file_path', function ($path, $file) {
    return $file === 'theme.json'
        ? public_path('build/assets/theme.json')
        : $path;
}, 10, 2);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
    ]);

    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     *
     * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Enable WooCommerce Support
     */
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ];

    register_sidebar([
        'name' => __('Primary', 'sage'),
        'id' => 'sidebar-primary',
    ] + $config);

    register_sidebar([
        'name' => __('Footer', 'sage'),
        'id' => 'sidebar-footer',
    ] + $config);
});


add_action('init', function () {
    register_taxonomy('age_group', 'product', [
        'labels' => ['name' => 'Age Groups', 'singular_name' => 'Age Group'],
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_admin_column' => false,
    ]);

    register_taxonomy('skill_level', 'product', [
        'labels' => ['name' => 'Skill Levels', 'singular_name' => 'Skill Level'],
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_admin_column' => false,
    ]);

    register_taxonomy('event_type', 'product', [
        'labels' => ['name' => 'Event Types', 'singular_name' => 'Event Type'],
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_admin_column' => false,
    ]);
}, 10);


add_action('init', function () {
    $taxonomy_terms = [
        'skill_level' => ['Beginner', 'Intermediate', 'Advanced'],
        'age_group' => ['Juniors', 'Adults'],
        'event_type' => ['Clinic', 'Cardio Tennis', 'Tournament'],
    ];

    foreach ($taxonomy_terms as $taxonomy => $terms) {
        foreach ($terms as $term) {
            if (!term_exists($term, $taxonomy)) {
                wp_insert_term($term, $taxonomy);
            }
        }
    }
}, 20);

add_action('init', function () {
    // Match /staff/123/ and expose staff_id as a query var
    add_rewrite_rule(
        '^staff/([0-9]+)/?$',
        'index.php?pagename=staff&staff_id=$matches[1]',
        'top'
    );
});


// Tell WordPress to recognize staff_id as a legit query var
add_filter('query_vars', function ($vars) {
    $vars[] = 'staff_id';
    return $vars;
});

add_action('pre_get_posts', function ($query) {
    if (!is_admin() && $query->is_main_query() && (is_shop() || is_product_taxonomy())) {
        $tax_query = [];
        $my_taxonomies = ['event_type', 'age_group', 'skill_level'];

        foreach ($my_taxonomies as $tax) {
            if (!empty($_GET[$tax])) {
                $tax_query[] = [
                    'taxonomy' => $tax,
                    'field' => 'slug',
                    'terms' => sanitize_text_field($_GET[$tax]),
                ];
            }
        }

        if (!empty($tax_query)) {
            $query->set('tax_query', $tax_query);
        }
    }
});

add_action('init', function () {
    // 1. Remove Related Products (Priority 20)
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
    // 2. Remove SKU/Categories (Priority 40)
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
}, 20);

add_filter('woocommerce_get_breadcrumb', function ($crumbs, $breadcrumb) {
    if (is_product()) {
        $crumbs[1] = [
            'Register',
            get_permalink(wc_get_page_id('shop'))
        ];
    }
    return $crumbs;
}, 10, 2);

add_action('init', function () {
    global $pagenow;
    if ('wp-login.php' == $pagenow && !isset($_GET['action']) && !isset($_POST['wp-submit'])) {
        wp_redirect(get_permalink(get_option('woocommerce_myaccount_page_id')));
        exit;
    }
});

/**
 * Style the fallback page WordPress shows via wp_die() on wp-login.php
 * requests - most visibly the "Do you really want to log out?" screen when a
 * logout link's nonce has gone stale (e.g. the page sat open a while). This
 * is a wp_die() screen, not the normal login template, so login_enqueue_scripts
 * never reaches it; overriding the die handler is the only way in. Scoped to
 * $pagenow === 'wp-login.php' so every other wp_die() call across the site
 * and admin is untouched.
 */
add_filter('wp_die_handler', function ($handler) {
    global $pagenow;
    if ($pagenow === 'wp-login.php') {
        return __NAMESPACE__ . '\\styled_login_die_handler';
    }
    return $handler;
});

function styled_login_die_handler($message, $title = '', $args = [])
{
    list($message, $title, $parsed_args) = _wp_die_process_input($message, $title, $args);

    if (!headers_sent()) {
        header('Content-Type: text/html; charset=' . $parsed_args['charset']);
        status_header($parsed_args['response']);
        nocache_headers();
    }

    $logo = Vite::asset('resources/images/logo_banner.svg');
    ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php echo esc_attr($parsed_args['charset']); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo wp_strip_all_tags($title); ?></title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(160deg, #5c88da 0%, #1c2b4a 100%);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            padding: 24px;
        }

        .card {
            background: #fff;
            border-radius: 1.5rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, .2);
            max-width: 26rem;
            width: 100%;
            padding: 2.5rem;
            text-align: center;
        }

        .card img {
            height: 48px;
            margin-bottom: 1.5rem;
        }

        .card p {
            color: #334155;
            line-height: 1.6;
            margin: 0 0 .75rem;
        }

        .card a {
            color: #5c88da;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="card">
        <a href="<?php echo esc_url(home_url('/')); ?>">
            <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
        </a>
        <p><?php echo $message; ?></p>
    </div>
</body>

</html>
<?php
    if ($parsed_args['exit']) {
        exit;
    }
}

if (is_page('juniors')) {
    wp_enqueue_script(
        'theme/juniors',
        asset('js/pages/juniors.js')->uri(),
        [],
        asset('js/pages/juniors.js')->version(),
        true  // load in footer
    );
}

add_filter('pre_get_document_title', function ($title) {
    $routeName = \Illuminate\Support\Facades\Route::currentRouteName();

    if ($routeName === 'staff.single') {
        $slug = request()->route('slug');
        $member = \App\Repositories\StaffRepository::findBySlug($slug);
        return "Our Team" . ($member ? " | {$member->first_name} {$member->last_name}" : '');
    }

    return \App\Support\RouteTitles::for($routeName, sanitize_key($_GET['age_group'] ?? ''), sanitize_key($_GET['type'] ?? '')) ?? $title;
});