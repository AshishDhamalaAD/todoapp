<x-layouts.app :title="__('Dashboard')">
    <div>
        <x-heading
            size="xl"
            level="1"
        >
            {{ __('Dashboard') }}
        </x-heading>

        <div class="mt-6 space-y-6">
            <x-heading level="2">
                {{ today()->format('F Y') }}
            </x-heading>

            <div>
                <x-subheading>
                    Daily Todos
                </x-subheading>

                <canvas id="this-month-daily-todos"></canvas>
            </div>

            <div>
                <x-subheading>
                    Weekly Todos
                </x-subheading>

                <canvas id="this-month-weekly-todos"></canvas>
            </div>
        </div>
    </div>

    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            function renderChart(id, labels, datasets) {
                const ctx = document.getElementById(id);

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: datasets,
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

            renderChart('this-month-daily-todos', @json($dailyChart['labels']), @json($dailyChart['datasets']));
            renderChart('this-month-weekly-todos', @json($weeklyChart['labels']), @json($weeklyChart['datasets']));
        </script>
    @endpush
</x-layouts.app>
