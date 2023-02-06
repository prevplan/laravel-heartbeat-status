# Monitor Laravel queue and schedule status

[![Latest Version on Packagist](https://img.shields.io/packagist/v/prevplan/laravel-heartbeat-status.svg?style=flat-square)](https://packagist.org/packages/prevplan/laravel-heartbeat-status)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/prevplan/laravel-heartbeat-status/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/prevplan/laravel-heartbeat-status/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/prevplan/laravel-heartbeat-status/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/prevplan/laravel-heartbeat-status/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/prevplan/laravel-heartbeat-status.svg?style=flat-square)](https://packagist.org/packages/prevplan/laravel-heartbeat-status)

A simple package to monitor the queue heartbeat and the schedule.  
It provides a route with a status and a 200 or 503 HTTP state that can be monitored by uptime services such as [upptime](https://github.com/upptime/upptime).


## Installation

You can install the package via composer:

```bash
composer require prevplan/laravel-heartbeat-status
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-heartbeat-status-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-heartbeat-status-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-heartbeat-status-views"
```

## Usage

```php
$heartbeatStatus = new Prevplan\HeartbeatStatus();
echo $heartbeatStatus->echoPhrase('Hello, Prevplan!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Holger Schmermbeck](https://github.com/ruaq)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
