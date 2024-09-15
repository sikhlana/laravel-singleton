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

    protected function setUp(): void
    {
        parent::setUp();

        IncrementsCount::reset();
    }

    public function testResolvingShouldIncrementCount()
    {
        for ($i = 1; $i <= 10; $i++) {
            $this->app->make(IncrementsCount::class);
            $this->assertEquals($i, IncrementsCount::$count);
        }
    }

    public function testResolvingShouldNotIncrementCount()
    {
        for ($i = 0; $i < 10; $i++) {
            $this->app->make(ParentSingleton::class);
            $this->assertEquals(1, ParentSingleton::$count);
        }
    }

    public function testResolvingShouldNotIncrementCountEvenIfBounded()
    {
        $this->app->bind(ParentSingleton::class);
        $this->assertEquals(0, ParentSingleton::$count);
        $this->testResolvingShouldNotIncrementCount();
    }

    public function testChildClassesShouldNotInterfereWithParent()
    {
        for ($i = 0; $i < 10; $i++) {
            $this->app->make(ChildSingleton::class);
            $this->assertEquals(1, ParentSingleton::$count);
        }

        for ($i = 0; $i < 10; $i++) {
            $this->app->make(ParentSingleton::class);
            $this->assertEquals(2, ParentSingleton::$count);
        }

        for ($i = 0; $i < 10; $i++) {
            $this->app->make(AnotherChildSingleton::class);
            $this->assertEquals(3, ParentSingleton::$count);
        }
    }
}

class IncrementsCount
{
    public static int $count = 0;

    public function __construct()
    {
        static::$count++;
    }

    public static function reset(): void
    {
        static::$count = 0;
    }
}

class ParentSingleton extends IncrementsCount implements Singleton
{
    //
}

class ChildSingleton extends ParentSingleton
{
    //
}

class AnotherChildSingleton extends ParentSingleton
{
    //
}
