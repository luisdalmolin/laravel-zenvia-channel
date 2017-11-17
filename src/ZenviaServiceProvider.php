<?php

namespace NotificationChannels\Zenvia;

use Illuminate\Support\ServiceProvider;

class ZenviaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->when(ZenviaChannel::class)
            ->needs(Zenvia::class)
            ->give(function () {
                $config = config('services.zenvia');

                return new Zenvia(
                    $config['conta'],
                    $config['senha'],
                    isset($config['from'])    ? $config['from']    : null,
                    $config['aggregateId'],
                    isset($config['pretend']) ? $config['pretend'] : false
                );
            });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
