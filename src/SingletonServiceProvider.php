<?php

namespace Sikhlana\Singleton;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class SingletonServiceProvider extends BaseServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->resolving(function ($object, Container $app) {
            if ($object instanceof Singleton) {
                $class = get_class($object);

                if (! $app->resolved($class)) {
                    $app->singleton($class, function () use ($object) {
                        return $object;
                    });
                }
            }
        });
    }
}
