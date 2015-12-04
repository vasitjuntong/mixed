<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DebugbarServiceProvider extends ServiceProvider
{
     /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if(env('APP_ENV') == 'local'){
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}
