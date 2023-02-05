<?php

namespace Prevplan\HeartbeatStatus\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Prevplan\HeartbeatStatus\HeartbeatStatus
 */
class HeartbeatStatus extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Prevplan\HeartbeatStatus\HeartbeatStatus::class;
    }
}
