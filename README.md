# Automatic singleton binding for Laravel Service Container

This package makes it easy to define singletons for the service container with just an implementation of a single interface.

## Contents

- [Installation](#installation)
- [Usage](#usage)
- [Testing](#testing)
- [Changelog](#changelog)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)

## Installation

You can install the package via composer:

```bash
composer require sikhlana/laravel-singleton
```

If you need to install the service provider manually:

```php
// config/app.php
'providers' => [
    ...
    Sikhlana\Singleton\SingletonServiceProvider::class,
],
```

## Usage

All you have to do is make the class you want to use as a singleton implement the `Sikhlana\Singleton\Singleton` interface:

```php
use Sikhlana\Singleton\Singleton;

class MySingletonClass implements Singleton
{
    ...
}
```

And voila! You're done.

## Testing

You can do unit tests by running:

```bash
vendor/bin/phpunit
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Security

If you discover any security related issues, please email xoxo@saifmahmud.name instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Saif Mahmud](https://github.com/sikhlana)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
