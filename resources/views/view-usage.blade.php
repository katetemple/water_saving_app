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
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // fetch data
            const usageLabels = @json($usageData->pluck('usage_date')->map(fn($date) => \Carbon\Carbon::parse($date)->format('d M Y')));
            const usageValues = @json($usageData->pluck('litres_used'));

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