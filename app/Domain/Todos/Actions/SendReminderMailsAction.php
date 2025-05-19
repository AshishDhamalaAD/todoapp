<?php

namespace App\Domain\Todos\Actions;

use App\Domain\Todos\Mails\SendReminderMail;
use App\Models\Todo;
use Illuminate\Support\Facades\Mail;

class SendReminderMailsAction
{
    public function __invoke()
    {
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
            ->take(1)
            ->get()
            // ->dd()
            ->each(function (Todo $todo) {
                Mail::to($todo->user->email)->send(new SendReminderMail($todo));

                $todo->is_reminder_sent = true;
                $todo->save();
            })
            ;

        // dd($todos->count());
        // return $todos;
        return $todos->count();
    }
}
