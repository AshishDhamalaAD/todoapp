<?php

use App\Domain\Todos\Actions\SendReminderMailsAction;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('send-reminder-mail', function () {
    (new SendReminderMailsAction)();
});

Schedule::command('send-reminder-mail')->daily();
