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

        $this->fixMakeLoaderMacro();
    }

    /**
     * Replaces Acorn's own View::makeLoader() macro (registered by
     * Roots\Acorn\View\ViewServiceProvider, which boots before this theme
     * provider - registering the same macro name here overrides it) with a
     * version that actually verifies its write succeeded.
     *
     * Acorn's original never checks file_put_contents()'s return value and
     * hands back the loader path unconditionally. When that write silently
     * failed/lost a race with a concurrent request for the same view (most
     * likely trigger: a cold view-cache directory - wiped on every prod
     * container recreate - hit by a burst of concurrent first-time
     * requests to a popular page right after a deploy), WooCommerce's
     * wc_get_template() would later include() a file that was never
     * written, and Acorn's warning-to-ErrorException handler turned that
     * into an uncaught fatal - this is what took down /my-account/ on
     * 2026-08-14 (see git history for the incident).
     *
     * Fixed by writing to a per-request-unique temp file and atomically
     * rename()-ing it into place, so a concurrent writer can never observe
     * a half-written file, and by throwing a clear, immediate exception on
     * genuine failure instead of returning a path we know is broken.
     *
     * @return void
     */
    protected function fixMakeLoaderMacro()
    {
        $app = $this->app;

        View::macro('makeLoader', function () use ($app) {
            $view = $this->getName();
            $path = $this->getPath();
            $id = md5($this->getCompiled());
            $compiledPath = $app['config']['view.compiled'];
            $compiledExtension = $app['config']->get('view.compiled_extension', 'php');
            $loader = "{$compiledPath}/{$id}-loader.{$compiledExtension}";

            if (! file_exists($loader)) {
                $content =
                    "<?= \\Roots\\view('{$view}', \$data ?? get_defined_vars())->render(); ?>"
                    . "\n<?php /**PATH {$path} ENDPATH**/ ?>";

                $tmp = "{$loader}." . getmypid() . '.' . uniqid('', true) . '.tmp';

                if (file_put_contents($tmp, $content) === false) {
                    throw new \RuntimeException("Could not write Blade loader file: {$tmp}");
                }

                if (! rename($tmp, $loader)) {
                    @unlink($tmp);

                    // rename() can fail because another request already
                    // won the race and wrote $loader itself first - that's
                    // a benign, expected outcome under concurrency, not a
                    // real failure, so only throw if it's genuinely still
                    // missing.
                    if (! file_exists($loader)) {
                        throw new \RuntimeException("Could not move Blade loader file into place: {$loader}");
                    }
                }
            }

            return $loader;
        });
    }
}
