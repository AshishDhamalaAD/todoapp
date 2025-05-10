<x-modal
    id="success-message"
    class="!bg-green-100 min-w-sm"
    :open="session()->has('success_message')"
>
    <div class="space-y-6">
        <div>
            <x-heading size="lg">{{ __('Success') }}</x-heading>
        </div>

        <div>
            {{ session('success_message') }}
        </div>
    </div>
</x-modal>
