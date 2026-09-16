<?php

namespace App\Providers;

use App\Models\valoraciones;
use App\Observers\ValoracionObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        valoraciones::observe(ValoracionObserver::class);

        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}