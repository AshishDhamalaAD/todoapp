<x-mail::message>
# Todo Reminder

You have a todo that needs to be completed by {{ $todo->due_at->format('M d, Y') }}.

<x-mail::button :url="route('todo.edit', $todo)">
Go to Todo
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
