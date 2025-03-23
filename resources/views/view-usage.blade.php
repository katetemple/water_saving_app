@vite(['resources/js/app.js'])
<x-app-layout>
    <!-- <x-alert-success>
        {{ session('success')}}
    </x-alert-success> -->

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-black leading-tight">
            {{ __('View Usage') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl">
                <div class="flex flex-wrap items-center justify-between p-6 mb-4">
                    <p class="text-md font-semibold">Your Water Usage Over Time</p>
                    <div class="inline-flex rounded-md shadow-sm" role="group">
                        <button id="dailybtn" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-l-xl hover:bg-gray-100 focus:border-[#0D6094] focus:bg-[#0D6094] focus:text-white">
                            Daily
                        </button>
                        <button id="weeklybtn" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 hover:bg-gray-100 focus:border-[#0D6094] focus:bg-[#0D6094] focus:text-white">
                            Weekly
                        </button>
                        <button id="monthlybtn" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-r-xl hover:bg-gray-100 focus:border-[#0D6094] focus:bg-[#0D6094] focus:text-white">
                            Monthly
                        </button>
                        <!-- <label for="view" class="block text-sm font-medium">View</label> -->
                        
                        <!-- <select id="view" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly" selected>Monthly</option>
                        </select> -->
                    </div>
                </div>
                <div style="height: 400px">
                    <canvas id="waterUsageChart" style="width: 100%; height: 100%;"></canvas>
                </div>
            </div>
            <div class="bg-white rounded-3xl p-6 mt-6 max-w-sm">
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
            <div class="bg-white rounded-3xl p-6 mt-6 max-w-sm">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Average Per Day</h3>
                <p class="text-blue-600 text-2xl font-bold flex items-center">{{ $averagePerDay }} L</p>
            </div>
            <div class="bg-white rounded-3xl p-6 mt-6 max-w-sm">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Usage this month</h3>
                <p class="text-blue-600 text-2xl font-bold flex items-center">{{ $currentUsage }} L</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const chartData = {
                daily: @json($dailyData->map(fn($row) => [
                    'label' => \Carbon\Carbon::parse($row->date)->format('d M'),
                    'value' => $row->total_litres
                ])),
                weekly: @json($weeklyData->map(fn($row) => [
                    'label' => 'Week ' . substr($row->year_week, 4),
                    'value' => $row->total_litres
                ])),
                monthly: @json($monthlyData->map(fn($row) => [
                    'label' => \Carbon\Carbon::parse($row->month)->format('M Y'),
                    'value' => $row->total_litres
                ])),
            }

            let selectedView = "monthly";

            //get chart context
            const ctx = document.getElementById("waterUsageChart").getContext("2d");
            // const viewSelect = document.getElementById("view");

            // //initial data load (default:daily)
            // let selectedView = viewSelect.value;

            //create line chart
            const chart = new Chart (ctx, {
                type: "line",
                data: {
                    labels: chartData[selectedView].map(d => d.label), // X-axis labels (dates)
                    datasets: [{
                        label: "Water Usage (Litres)",
                        data: chartData[selectedView].map(d => d.value), // Y axis data (litres used)
                        borderColor: "blue",
                        backgroundColor: "rgba(0, 0, 255, 0.2)",
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointHoverRadius: 6
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

            function updateChart(view) {
                selectedView = view;
                //update chart data
                chart.data.labels = chartData[selectedView].map(d => d.label);
                chart.data.datasets[0].data = chartData[selectedView].map(d => d.value);
                chart.update();
            }

            updateChart(selectedView)

            document.getElementById("dailybtn").addEventListener("click", () => updateChart("daily"));
            document.getElementById("weeklybtn").addEventListener("click", () => updateChart("weekly"));
            document.getElementById("monthlybtn").addEventListener("click", () => updateChart("monthly"));

            //update chart when dropdown changes
            // viewSelect.addEventListener("change", function () {
            //     selectedView = viewSelect.value;

            //     //update chart data
            //     chart.data.labels = chartData[selectedView].map(d => d.label);
            //     chart.data.datasets[0].data = chartData[selectedView].map(d => d.value);
            //     chart.update();
            // })
        });
    </script>
</x-app-layout>