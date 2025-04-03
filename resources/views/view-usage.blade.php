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

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

    <!-- chart section -->
        <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Your Water Usage Over Time</h3>
                </div>

                <div class="inline-flex rounded-xl shadow-sm overflow-hidden border border-gray-200" role="group">
                <button id="dailybtn" type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-100 hover:bg-gray-100 focus:outline-none focus:bg-blue-600 focus:text-white">
                        Daily
                    </button>
                    <button id="weeklybtn" type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-100 hover:bg-gray-100 focus:outline-none focus:bg-blue-600 focus:text-white">
                        Weekly
                    </button>
                    <button id="monthlybtn" type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-100 hover:bg-gray-100 focus:outline-none focus:bg-blue-600 focus:text-white">
                        Monthly
                    </button>
                </div>
            </div>

            <div class="h-[400px] w-full">
                <canvas id="waterUsageChart" style="width: 100%; height: 100%;"></canvas>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- water saved -->
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 mt-6">
                <div class="flex items-center justify-between mb-3">
                    <h4 class="text-lg font-semibold text-gray-700 mb-2">Water Saved This Month</h4>
                    <div class="flex items-center">
                        <span class="text-xs font-medium text-gray-800">vs Last Month</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                </div>

                @if ($previousUsage > 0)
                    @if ($litresSaved > 0)
                        <div class="flex items-end">
                            <!-- up arrow with savings -->
                            <div class="mr-3 text-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-green-600 text-3xl font-bold">{{ $litresSaved }} Litres</p>
                                <p class="text-sm text-gray-600 mt-1">
                                    <span class="font-medium">Saved!</span> {{ number_format(($litresSaved/$previousUsage)*100, 0) }}% better than last month
                                </p>
                            </div>
                        </div>
                    @elseif ($litresSaved < 0)
                        <div class="flex items-end">
                            <!-- down arrow with decrease -->
                            <div class="mr-3 text-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-red-600 text-3xl font-bold">{{ abs($litresSaved) }} Litres</p>
                                <p class="text-sm text-gray-600 mt-1">
                                    <span class="font-medium">More used</span> than last month's {{ $previousUsage }} litres
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center">
                            <div class="mr-3 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-gray-600 text-xl font-semibold">No change from last month</p>
                                <p class="text-sm text-gray-500 mt-1">You used {{ $previousUsage }} litres both months</p>
                            </div>
                        </div>
                    @endif
                @endif  
            </div>

            <!-- avg per day -->
            <div class="bg-white rounded-2xl p-6 mt-6 shadow-md border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Daily Average</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>    
                </div>
                <div class="flex items-end space-x-3">
                    <p class="text-blue-600 text-3xl font-bold">{{ $averagePerDay }} Litres</p>
                    <span class="text-sm text-gray-500 mb-1">per day</span>
                </div>
            </div>

            <!-- total usage this month so far -->
            <div class="bg-white rounded-2xl p-6 mt-6 shadow-md border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Monthly Usage</h3>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>    
                </div>
                <div class="flex items-end space-x-3 mb-4">
                    <p class="text-blue-600 text-3xl font-bold">{{ $currentUsage }} Litres</p>
                    <span class="text-sm text-gray-500 mb-1">so far this month</span>
                </div>

                
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
                        borderColor: "#3b82f6",
                        backgroundColor: "rgba(59, 130, 246, 0.2)",
                        borderWidth: 2,
                        fill: true,
                        tension: 0.3,
                        pointRadius: 3,
                        pointHoverRadius: 6,
                }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: "top",
                            labels: {
                                boxWidth: 12,
                                padding: 20,
                                font: {
                                    size: 13
                                },
                                usePointStyle: true
                            }
                        },
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: "rgba(226, 232, 240, 1)"
                            },
                            title: {
                                display: true,
                                text: "Litres Used",
                                font: {
                                    weight: "bold",
                                    size: 15,
                                },
                                padding: {top: 10, bottom: 10}
                            },
                        },
                        x: {
                            
                            title: {
                                display: true,
                                text: "Date",
                                font: {
                                    weight: "bold",
                                    size: 15,
                                },
                                padding: {top: 10, bottom: 10}
                            }
                        }
                    },
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