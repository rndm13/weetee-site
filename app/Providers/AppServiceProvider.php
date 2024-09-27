<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::macro('image', fn (string $asset) => Vite::asset("resources/imgs/{$asset}"));
        Blade::directive('datetime', function (string $expression) {
            return "<?php echo ($expression)->format('m/d/Y H:M:S'); ?>";
        });
        Blade::directive('date', function (string $expression) {
            return "<?php echo ($expression)->format('m/d/Y'); ?>";
        });
        Blade::directive('time', function (string $expression) {
            return "<?php echo ($expression)->format('H:M:S'); ?>";
        });
    }
}
