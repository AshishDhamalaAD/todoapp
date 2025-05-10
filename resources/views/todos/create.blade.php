<x-layouts.app :title="__('Create Todo')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <x-heading
            size="xl"
            level="1"
        >
            {{ __('Create Todo') }}
        </x-heading>


        <x-form
            :method="$todo->exists ? 'put' : 'post'"
            :action="$todo->exists ? route('todo.update', $todo->id) : route('todo.store')"
            class="space-y-6"
        >
            <div class="grid grid-cols-2 gap-6">
                <x-input
                    type="text"
                    :label="__('Title')"
                    name="title"
                    required
                    autofocus
                    autocomplete="title"
                    :value="$todo->title"
                />

                <div class="col-span-2">
                    <x-textarea
                        :label="__('Description')"
                        name="description"
                        rows="5"
                    >{{ $todo->description }}</x-textarea>
                </div>

                <x-input
                    type="datetime-local"
                    :label="__('Due Date')"
                    name="due_at"
                    :value="$todo->due_at"
                />

                <x-input
                    type="datetime-local"
                    :label="__('Reminder Date')"
                    name="reminder_at"
                    :value="$todo->reminder_at"
                />

                <x-checkbox
                    :label="__('Completed')"
                    name="is_completed"
                    :checked="$todo->is_completed"
                />
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <x-button class="w-full">
                        {{ $todo->exists ? __('Update') : __('Create') }}
                    </x-button>
                </div>
            </div>
        </x-form>
    </div>
</x-layouts.app>
