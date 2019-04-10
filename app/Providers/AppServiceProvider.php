<?php
/**
 * Autor: Paula Aguirre Copyright (c) 2018.
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Carbon::setLocale (config ('app.locale'));

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment () !== 'production') {
            $this->app->register ( \Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class );
        }

        $this->app->bind('path.public', function ()
        {
           return base_path().'/public_html';
        });
    }
}
