<x-layouts.app :title="__('Dashboard')">
    <div>
        <x-heading
            size="xl"
            level="1"
        >
            {{ __('Dashboard') }}
        </x-heading>

        <x-subheading>
            {{ today()->format('F Y') }}
        </x-subheading>

        <canvas id="this-month-todos"></canvas>
    </div>

    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const ctx = document.getElementById('this-month-todos');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($labels),
                    datasets: @json($datasets),
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endpush
</x-layouts.app>
