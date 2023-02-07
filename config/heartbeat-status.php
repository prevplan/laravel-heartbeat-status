<?php

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
