<?php

namespace Seleznev\Beep;

use Illuminate\Contracts\Container\Container;
use Laravel\Lumen\Application as LumenApplication;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('beep', function (Container $app) {
            return new Beep($app['config']);
        });
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $source = realpath(__DIR__.'/../config/beep.php');

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('beep.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('beep');
        }

        $this->mergeConfigFrom($source, 'beep');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['beep'];
    }
}
