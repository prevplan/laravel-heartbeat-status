# Monitor Laravel queue and schedule status

[![Latest Version on Packagist](https://img.shields.io/packagist/v/prevplan/laravel-heartbeat-status.svg?style=flat-square)](https://packagist.org/packages/prevplan/laravel-heartbeat-status)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/prevplan/laravel-heartbeat-status/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/prevplan/laravel-heartbeat-status/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/prevplan/laravel-heartbeat-status/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/prevplan/laravel-heartbeat-status/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/prevplan/laravel-heartbeat-status.svg?style=flat-square)](https://packagist.org/packages/prevplan/laravel-heartbeat-status)

A simple package to monitor the queue heartbeat and the schedule of a Laravel Site.  
It provides a route with a status and a 200 or 503 HTTP state that can be monitored by uptime services such as [upptime](https://github.com/upptime/upptime).

Tested with Laravel 9 + 10.

## Installation

You can install the package via composer:

```bash
composer require prevplan/laravel-heartbeat-status
```

The standard URL is `yoursite.com/heartbeat`. If you want to change this, add

```bash
Route::heartbeat_status('new-folder');
```

to your `routes/web.php`.

You can optionally publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-heartbeat-status-config"
```

This is the contents of the published config file:

```php
return [
    /*
    |--------------------------------------------------------------------------
    | Heartbeat Interval Time
    |--------------------------------------------------------------------------
    |
    | Time in minutes between queued heartbeatStatusCommand jobs.
    |
    */
    'heart-rate' => env('HEARTBEAT_HEART_RATE', 2),

    /*
    |--------------------------------------------------------------------------
    | Heartbeat Emergency Time
    |--------------------------------------------------------------------------
    |
    | Time in minutes to report failure/change to status 503, if the
    | last heartbeatStatusCommand is older than this value
    |
    */
    'emergency_time' => env('HEARTBEAT_EMERGENCY', 5),

    /*
    |--------------------------------------------------------------------------
    | Schedule Leeway
    |--------------------------------------------------------------------------
    |
    | Time for schedule running tolerance in seconds
    |
    */
    'schedule_leeway' => env('HEARTBEAT_SCHEDULE_LEEWAY', 10),

    /*
    |--------------------------------------------------------------------------
    | Queue Leeway
    |--------------------------------------------------------------------------
    |
    | Time for queue running tolerance in seconds
    |
    */
    'queue_leeway' => env('HEARTBEAT_QUEUE_LEEWAY', 20),
];

```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="laravel-heartbeat-status-views"
```

## Usage

The status page is automatically published under yoursite.com/heartbeat or another URL if you’ve changed it.  
It checks the last run of the schedule and the queue.

If everything works fine, it responds to a 200 HTTP state. If there is a problem a 503 HTTP state will be shown.  
You can monitor this heartbeat page with upptime or another uptime service of your choice.

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
