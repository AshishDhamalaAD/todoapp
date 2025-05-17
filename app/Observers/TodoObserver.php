<?php

namespace App\Observers;

use App\Models\Todo;
use Illuminate\Support\Facades\Cache;

class TodoObserver
{
    /**
     * Handle the Todo "created" event.
     */
    public function created(Todo $todo): void
    {
        Cache::forget('this-month-daily-chart');
        Cache::forget('this-month-weekly-chart');
    }

    /**
     * Handle the Todo "updated" event.
     */
    public function updated(Todo $todo): void
    {
        Cache::forget('this-month-daily-chart');
        Cache::forget('this-month-weekly-chart');
    }

    /**
     * Handle the Todo "deleted" event.
     */
    public function deleted(Todo $todo): void
    {
        Cache::forget('this-month-daily-chart');
        Cache::forget('this-month-weekly-chart');
    }
}
