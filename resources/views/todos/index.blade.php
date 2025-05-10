<x-layouts.app :title="__('Todos')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <div class="flex justify-end">
            <x-button
                size="sm"
                href="{{ route('todo.create') }}"
            >
                Add New
            </x-button>
        </div>

        <div class="relative overflow-x-auto border border-gray-200 sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th
                            scope="col"
                            class="px-6 py-3"
                        >
                            Title
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3"
                        >
                            Due Date
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3"
                        >
                            Reminder Date
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3"
                        >
                            Completed
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3"
                        >
                            Reminder Sent
                        </th>
                        <th
                            scope="col"
                            class="px-6 py-3"
                        >
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($todos as $todo)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                            <td class="px-6 py-4">
                                {{ $todo->title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $todo->due_at?->toDayDateTimeString() }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $todo->reminder_at?->toDayDateTimeString() }}
                            </td>
                            <td class="px-6 py-4">
                                <span @class([
                                    'text-green-500' => $todo->is_completed,
                                    'text-red-500' => !$todo->is_completed,
                                ])>
                                    {{ $todo->is_completed ? 'Yes' : 'No' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span @class([
                                    'text-green-500' => $todo->is_reminder_sent,
                                    'text-red-500' => !$todo->is_reminder_sent,
                                ])>
                                    {{ $todo->is_reminder_sent ? 'Yes' : 'No' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 flex gap-2">
                                <x-button
                                    variant="secondary"
                                    size="xs"
                                    href="{{ route('todo.edit', $todo) }}"
                                >
                                    Edit
                                </x-button>

                                <x-form
                                    method="delete"
                                    action="{{ route('todo.destroy', $todo) }}"
                                    class="w-full flex"
                                    x-data="{}"
                                    x-on:submit.prevent="confirm('Are you sure you want to delete this todo?') ? $event.target.submit() : ''"
                                >
                                    <x-button
                                        variant="danger"
                                        size="xs"
                                    >
                                        Delete
                                    </x-button>
                                </x-form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            {{ $todos->links() }}
        </div>

    </div>
</x-layouts.app>
