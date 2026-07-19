<?php

namespace App\View\Composers;

use App\Support\RouteTitles;
use Illuminate\Support\Facades\Route;
use Roots\Acorn\View\Composer;

/**
 * Resolves the page-header title and animation state for routes that have
 * no backing WP post (WooCommerce shop pages, and the closure-based routes
 * in routes/web.php).
 */
class PageHeader extends Composer
{
    protected static $views = [
        'layouts.app',
    ];

    /**
     * Route name prefixes that should never animate the title (e.g. the
     * racket/ball intro), regardless of query string.
     */
    protected const NO_ANIMATE_ROUTE_PREFIXES = [
        'programs.',
    ];

    public function with(): array
    {
        return [
            'pageTitle' => $this->resolveTitle(),
            'animateTitle' => $this->resolveAnimateTitle(),
        ];
    }

    private function resolveTitle(): string
    {
        if (is_shop() || is_product_category() || is_product_tag()) {
            return 'Register';
        }

        return RouteTitles::for(Route::currentRouteName(), request()->route('type')) ?? get_the_title();
    }

    private function resolveAnimateTitle(): bool
    {
        $routeName = Route::currentRouteName();

        if ($routeName) {
            foreach (self::NO_ANIMATE_ROUTE_PREFIXES as $prefix) {
                if (str_starts_with($routeName, $prefix)) {
                    return false;
                }
            }
        }

        return empty($_GET);
    }
}
