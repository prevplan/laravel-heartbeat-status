<?php

declare(strict_types=1);

namespace Prevplan\HeartbeatStatus;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Route;
use Prevplan\HeartbeatStatus\Commands\HeartbeatStatusCommand;
use Prevplan\HeartbeatStatus\Http\Controllers\HeartbeatStatusController;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class HeartbeatStatusServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-heartbeat-status')
            ->hasConfigFile()
            ->hasViews()
            ->hasCommand(HeartbeatStatusCommand::class);
    }

    public function packageRegistered()
    {
        Route::macro('heartbeat_status', function (string $baseUrl = 'heartbeat') {
            Route::prefix($baseUrl)->group(function () {
                Route::get('/', [HeartbeatStatusController::class, 'html']);
            });
        });

        Route::heartbeat_status();

        $this->app->afterResolving(Schedule::class, function (Schedule $schedule) {
            $schedule->command(Commands\HeartbeatStatusCommand::class)->everyMinute();
        });
    }
}
