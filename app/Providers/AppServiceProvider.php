<?php

namespace App\Providers;

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request as HttpRequest;

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
        // Rupiah
        Blade::directive('currency', function ($expression) {
            return "Rp. <?php echo number_format($expression,0,',','.'); ?>";
        });
        // Percent
        Blade::directive('percent', function ($expression) {
            return "<?php echo number_format($expression, 2, ',', '.') . '%'; ?>";
        });

        // gram
        Blade::directive('formatGram', function ($expression) {
            return "<?php echo number_format($expression, 2, ',', '.') . ' g'; ?>";
        });

        if (config('app.env') === 'local') {
            URL::forceScheme('https');
        }
    }
}
