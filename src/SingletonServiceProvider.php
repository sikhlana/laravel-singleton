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
                $app->instance(get_class($object), $object);
            }
        });
    }
}
