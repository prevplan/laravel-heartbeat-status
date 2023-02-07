<?php

declare(strict_types=1);

namespace Prevplan\HeartbeatStatus\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Prevplan\HeartbeatStatus\Jobs\QueueHeartbeatStatus;

class HeartbeatStatusCommand extends Command
{
    public $signature = 'heartbeat-status:beat';

    public $description = 'Run the heartbeat (via schedule job)';

    public function handle(): int
    {
        Cache::forever('schedule_heartbeat', Carbon::now());

        $job_count = DB::table('jobs')
            ->where('payload', 'like', '%QueueHeartbeatStatus%')
            ->count('id');

        // Restart job if not queued anymore
        if ($job_count === 0) {
            Log::info('heartbeat-status: Queued QueueHeartbeatStatus');

            QueueHeartbeatStatus::dispatch()->delay(now()->addSeconds(5));
        }

        return self::SUCCESS;
    }
}
