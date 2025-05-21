<?php

namespace App\Jobs;

use App\Domain\Todos\Mails\SendReminderMail;
use App\Models\Todo;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendReminderMailJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Todo $todo)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->todo->user->email)->send(new SendReminderMail($this->todo));

        $this->todo->is_reminder_sent = true;
        $this->todo->save();
    }
}
