<?php

declare(strict_types=1);

namespace Prevplan\HeartbeatStatus\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class HeartbeatStatusController
{
    public function html(): Response
    {
        $heartbeat = $this->get_heartbeat();

        return response()->view('heartbeat-status::status-html', $heartbeat, $heartbeat->get('status_code'));
    }

    private function get_heartbeat(): Collection
    {
        $now = Carbon::now();

        $schedule_pass = false;
        $schedule_overdue = false;

        $queue_pass = false;
        $queue_overdue = false;

        $next_queue = DB::table('jobs')
            ->where('payload', 'like', '%QueueHeartbeatStatus%')
            ->orderBy('available_at', 'ASC')
            ->first();

        $last_schedule = Cache::get('schedule_heartbeat');
        if ($last_schedule) {
            $schedule_leeway = config('heartbeat-status.schedule_leeway'); // Tolerance in seconds
            $emergency_time = config('heartbeat-status.emergency_time') * 60 + $schedule_leeway;

            $time_since_last_schedule = $now->diffInSeconds($last_schedule);

            if ($time_since_last_schedule < $emergency_time) {
                $schedule_pass = true;
            }

            if ($time_since_last_schedule > 60 + $schedule_leeway) {
                $schedule_overdue = true;
            }
        }

        $last_queue = Cache::get('queue_heartbeat');

        if ($last_queue) {
            $queue_leeway = config('heartbeat-status.queue_leeway'); // Tolerance in seconds
            $emergency_time = config('heartbeat-status.emergency_time') * 60 + $queue_leeway;

            $time_since_last_queue = $now->diffInSeconds($last_queue);

            if ($time_since_last_queue < $emergency_time) {
                $queue_pass = true;
            }

            if (
                ! $next_queue ||
                $now->subSeconds($queue_leeway) > Carbon::createFromTimestamp($next_queue->available_at)
            ) {
                $queue_overdue = true;
            }
        }

        $status_code = $schedule_pass && $queue_pass ? 200 : 503;

        return new Collection([
            'schedule_pass' => $schedule_pass,
            'schedule_overdue' => $schedule_overdue,
            'last_schedule' => $last_schedule,
            'queue_pass' => $queue_pass,
            'queue_overdue' => $queue_overdue,
            'last_queue' => $last_queue,
            'next_queue' => $next_queue,
            'status_code' => $status_code,
        ]);
    }
}
