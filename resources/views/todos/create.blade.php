<x-layouts.app :title="__('Create Todo')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <x-heading
            size="xl"
            level="1"
        >
            {{ __('Create Todo') }}
        </x-heading>


        <x-form
            method="post"
            :action="route('todo.store')"
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
                />

                <div class="col-span-2">
                    <x-textarea
                        :label="__('Description')"
                        name="description"
                        rows="5"
                    ></x-textarea>
                </div>

                <x-input
                    type="datetime-local"
                    :label="__('Due Date')"
                    name="due_at"
                />

                <x-input
                    type="datetime-local"
                    :label="__('Reminder Date')"
                    name="reminder_at"
                />

                <x-checkbox
                    :label="__('Completed')"
                    name="is_completed"
                />
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <x-button class="w-full">{{ __('Create') }}</x-button>
                </div>

                <x-action-message
                    class="me-3"
                    on="todo-saved"
                >
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </x-form>
    </div>
</x-layouts.app>
