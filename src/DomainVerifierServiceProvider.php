<?php

namespace SunAsterisk\DomainVerifier;

use Illuminate\Support\ServiceProvider;

class DomainVerifierServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'migrations');

            $this->publishes([
                __DIR__.'/../config/domain_verifier.php' => config_path('domain_verifier.php'),
            ], 'config');
        }
    }
}
