<?php

namespace Sikhlana\Singleton;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

class SingletonServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->resolving(function ($obj, Container $app) {
            if ($obj instanceof Singleton) {
                $cls = get_class($obj);

                if (! $app->resolved($cls)) {
                    $app->singleton($cls, fn () => $obj);
                }
            }
        });
    }
}
