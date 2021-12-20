<?php

namespace EspressoByte\EventMessaging;

use EspressoByte\EventMessaging\Console\StartBrokerCommand;
use Illuminate\Redis\RedisManager;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;
use React\EventLoop\Loop;
use React\EventLoop\LoopInterface;

class EventMessagingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->mergeConfigFrom(
                __DIR__.'/../config/config.php', 'event-stream-laravel',
            );

            $this->commands([
                StartBrokerCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration

        $this->app->bind(LoopInterface::class, static function () {
            return Loop::get();
        });

        $this->app->bind(EventMessaging::class, function ($app) {
            return new EventMessaging(
                app(RedisManager::class),
                app(LoggerInterface::class)
            );
        });
    }

    public function provides()
    {
        return [
            LoopInterface::class,
        ];
    }

    public function isDeferred()
    {
        return true;
    }
}
