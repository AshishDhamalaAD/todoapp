<x-field>
    @if ($label)
        <x-label
            :for="$id"
            :value="$label"
        />
    @endif

    <textarea
        {{ $formControlAttributes }}
        {{ $attributes->merge(['class' => 'shadow-xs block w-full focus:ring-teal-500 focus:border-teal-500 sm:text-sm border border-gray-200 rounded-md p-3']) }}
    >{{ $value ?: $slot }}</textarea>

    <x-error :for="$id" />
</x-field>
