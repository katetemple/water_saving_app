@vite(['resources/js/app.js'])
<x-app-layout>
    <!-- <x-alert-success>
        {{ session('success')}}
    </x-alert-success> -->

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Usage') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p>Household ID: {{ $household->id }}</p>
                    <p>Household Name: {{ $household->household_name }}</p>
                    <p>Address: {{ $household->address }}</p>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <canvas id="waterUsageChart" style="width: 100%; height: 400px"></canvas>
            </div>
            <div class="bg-white rounded-lg shadow p-6 mt-6 max-w-sm">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Water Saved This Month</h3>

                @if ($previousUsage > 0)
                    @if ($litresSaved > 0)
                        <p class="text-green-600 text-2xl font-bold flex items-center">{{ $litresSaved }} L saved</p>
                        <p class="text-sm text-gray-500 mt-1">Compared to last month ({{ $previousUsage }} L)</p>
                    @elseif ($litresSaved < 0)
                        <p class="text-red-600 text-2xl font-bold flex items-center">{{ abs($litresSaved) }} L more used</p>
                        <p class="text-sm text-gray-500 mt-1">Try to use less than {{ $previousUsage }} L next month</p>
                    @else
                        <p class="text-gray-600 text-xl font-semibold">Same as last month</p>
                    @endif
                @endif  
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // fetch data
            const usageLabels = @json($usageData->pluck('month')->map(fn($m) => \Carbon\Carbon::parse($m)->format('M Y')));
            const usageValues = @json($usageData->pluck('total_litres'));

            console.log("Labels:", usageLabels);
            console.log("Labels:", usageValues);

            //get chart context
            const ctx = document.getElementById("waterUsageChart").getContext("2d");

            //create line chart
            new Chart (ctx, {
                type: "line",
                data: {
                    labels: usageLabels, // X-axis labels (dates)
                    datasets: [{
                        label: "Water Usage (Litres)",
                        data: usageValues, // Y axis data (litres used)
                        borderColor: "blue",
                        backgroundColor: "rgba(0, 0, 255, 0.2)",
                        fill: true
                }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: "Litres Used"
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: "Date"
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>