<x-filament::page>
    <div class="space-y-6">
        {{-- Kartu Statistik --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach ($this->getCards() as $card)
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $card['title'] }}</div>
                    <div class="text-2xl font-bold text-gray-900 dark:text-white">{{ $card['value'] }}</div>
                </div>
            @endforeach
        </div>

        {{-- Grafik Mingguan --}}
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Jumlah Pemeriksaan Harian (7 Hari Terakhir)</h2>
            <canvas id="checkChart" height="100"></canvas>
        </div>

        {{-- Daftar Kambing Terbaru --}}
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">5 Kambing Terbaru</h2>
            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($this->recentGoats as $goat)
                    <li class="py-3">
                        <strong>{{ $goat->tag_number }}</strong> – {{ $goat->description ?? 'Tanpa keterangan' }}
                    </li>
                @empty
                    <li class="py-3 text-gray-500 dark:text-gray-400">Belum ada data kambing.</li>
                @endforelse
            </ul>
        </div>
    </div>

    {{-- Script Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('checkChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($this->weeklyCheckData)) !!},
                datasets: [{
                    label: 'Jumlah Pemeriksaan',
                    data: {!! json_encode(array_values($this->weeklyCheckData)) !!},
                    backgroundColor: '#f59e0b',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>
</x-filament::page>
