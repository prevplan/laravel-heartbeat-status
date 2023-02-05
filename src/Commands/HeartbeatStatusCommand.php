<?php

namespace Prevplan\HeartbeatStatus\Commands;

use Illuminate\Console\Command;

class HeartbeatStatusCommand extends Command
{
    public $signature = 'laravel-heartbeat-status';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
