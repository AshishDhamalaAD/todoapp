<?php

namespace App\Domain\Todos\Actions;

use App\Domain\Todos\Mails\SendReminderMail;
use App\Jobs\SendReminderMailJob;
use App\Models\Todo;
use Illuminate\Support\Facades\Mail;

class SendReminderMailsAction
{
    public function __invoke()
    {
        $now = now();

        $todos = Todo::query()
            ->select(['id', 'user_id', 'title', 'description', 'due_at', 'reminder_at'])
            ->with(['user:id,email'])
            ->where('is_completed', false)
            ->where('is_reminder_sent', false)
            ->whereNotNull('reminder_at')
            ->whereBetween('reminder_at', [
                today()->startOfDay(),
                today()->endOfDay(),
            ])
            ->orderBy('reminder_at')
            ->get()
            // ->dd()
            ->each(function (Todo $todo) use ($now) {
                SendReminderMailJob::dispatch($todo)->delay($now);

                $now->addSeconds(5);
            })
            ;

        // dd($todos->count());
        // return $todos;
        return $todos->count();
    }
}
