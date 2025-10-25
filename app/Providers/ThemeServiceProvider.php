<?php

namespace App\Providers;

use Roots\Acorn\Sage\SageServiceProvider;
use Illuminate\Support\Facades\View; 
use Illuminate\Support\Facades\Event; 

class ThemeServiceProvider extends SageServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        // Add custom logo theme support
        add_theme_support('custom-logo', [
            'height'      => 256,
            'width'       => 256,
            'flex-height' => true,
            'flex-width'  => true,
        ]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
