<?php

namespace Prevplan\HeartbeatStatus;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Prevplan\HeartbeatStatus\Commands\HeartbeatStatusCommand;

class HeartbeatStatusServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-heartbeat-status')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-heartbeat-status_table')
            ->hasCommand(HeartbeatStatusCommand::class);
    }
}
