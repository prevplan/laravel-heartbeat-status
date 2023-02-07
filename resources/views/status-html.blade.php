@php use Carbon\Carbon; @endphp
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Heartbeat Status</title>
</head>
<body>
<div class="main">

    <section class="section">
        <h1 class="title is-1">Status - {{ $schedule_pass && $queue_pass ? 'OK' : 'not ok!' }}</h1>
        @if ($schedule_pass)
            <h2 class="title is-3">
                <span class="has-text-success">✓</span> Schedule is ok!
            </h2>
        @else
            <h2 class="title is-3">
                <span class="has-text-danger">✘</span> Schedule is not ok!
            </h2>
        @endif

        <p>
            @if ($last_schedule)
                @if ($schedule_pass && !$schedule_overdue)
                    <span class="has-text-success">✓</span>
                @else
                    <span class="has-text-danger">✘</span>
                @endif
                {{ $schedule_overdue ? 'Overdue! - ' : '' }}Last schedule heartbeat was {{ $last_schedule->toDateTimeString() }}
                - {{ $last_schedule->diffForHumans() }}
            @else
                <span class="has-text-danger">✘</span> No record of last schedule heartbeat.
            @endif
        </p>
    </section>

    <section class="section">
        @if ($queue_pass)
            <h2 class="title is-3">
                <span class="has-text-success">✓</span> Queue is ok!
            </h2>
        @else
            <h2 class="title is-3">
                <span class="has-text-danger">✘</span> Queue is not ok!
            </h2>
        @endif

        <p>
            @if ($last_queue)
                @if($queue_pass)
                    <span class="has-text-success">✓</span>
                @else
                    <span class="has-text-danger">✘</span>
                @endif
                Last queue heartbeat was {{ $last_queue->toDateTimeString() }} - {{ $last_queue->diffForHumans() }}
            @else
                <span class="has-text-danger">✘</span> No record of last queue heartbeat.
            @endif
        </p>

        @if ($next_queue)
            @if ($queue_overdue)
                <p>
                    <span class="has-text-success">✘</span> Next job is overdue, scheduled
                    for {{ Carbon::createFromTimestamp($next_queue->available_at)->toDateTimeString() }}
                    - {{ Carbon::createFromTimestamp($next_queue->available_at)->diffForHumans() }}
                </p>
            @else
                <p>
                    <span class="has-text-success">✓</span> Next job is scheduled
                    for {{ Carbon::createFromTimestamp($next_queue->available_at)->toDateTimeString() }}
                    - {{ Carbon::createFromTimestamp($next_queue->available_at)->diffForHumans() }}
                </p>
            @endif
        @else
            <p>
                <span class="has-text-danger">✘</span> There is no heartbeat job in the queue. Run schedule job!
            </p>
        @endif
    </section>
</div>

</body>
</html>
