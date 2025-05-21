<?php

use App\Domain\Todos\Actions\SendReminderMailsAction;
use App\Jobs\SendReminderMailsJob;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('send-reminder-mail', function () {
    SendReminderMailsJob::dispatch();
});

Schedule::command('send-reminder-mail')->daily();
