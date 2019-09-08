<?php

namespace Sikhlana\Singleton\Test;

use Orchestra\Testbench\TestCase;
use Sikhlana\Singleton\Singleton;
use Sikhlana\Singleton\SingletonServiceProvider;

class SingletonResolveTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            SingletonServiceProvider::class,
        ];
    }

    public function testResolvingShouldIncrementCount()
    {
        IncrementsCount::$count = 0;

        for ($i = 1; $i <= 10; $i++) {
            $this->app->make(IncrementsCount::class);
            $this->assertEquals($i, IncrementsCount::$count);
        }
    }

    public function testResolvingShouldNotIncrementCount()
    {
        IncrementsCountOnlyOnce::$count = 0;

        for ($i = 0; $i < 10; $i++) {
            $this->app->make(IncrementsCountOnlyOnce::class);
            $this->assertEquals(1, IncrementsCountOnlyOnce::$count);
        }
    }

    public function testResolvingShouldNotIncrementCountEvenIfBounded()
    {
        $this->app->bind(IncrementsCountOnlyOnce::class);
        $this->testResolvingShouldNotIncrementCount();
    }
}

class IncrementsCount
{
    public static $count = 0;

    public function __construct()
    {
        static::$count++;
    }
}

class IncrementsCountOnlyOnce extends IncrementsCount implements Singleton
{
    //
}
