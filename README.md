# A Laravel package for seamless integration with the Placekey API.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/realtydev/laravel-placekey.svg?style=flat-square)](https://packagist.org/packages/realtydev/laravel-placekey)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/realtydev/laravel-placekey/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/realtydev/laravel-placekey/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/realtydev/laravel-placekey/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/realtydev/laravel-placekey/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/realtydev/laravel-placekey.svg?style=flat-square)](https://packagist.org/packages/realtydev/laravel-placekey)





## Installation

You can install the package via composer:

```bash
composer require realtydev/laravel-placekey
```


You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-placekey-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-placekey-views"
```

## Usage

```php
$laravelPlacekey = new Realtydev\LaravelPlacekey();
echo $laravelPlacekey->getPlacekeyForAddress(
  $street,
  $city,
  $region,
  $postal_code, 
  $countryCode
);
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.


## Credits

- [Alex Gibson](https://github.com/realtydev)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
