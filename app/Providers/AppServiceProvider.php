<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\ServiceProvider;

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
        // supaya pada saat production tidak ada lazy loading dan digunakan pada saat kerja sama tim
        // Model::preventLazyLoading(! $this->app->isProduction());

        Model::preventLazyLoading();
    }
}
