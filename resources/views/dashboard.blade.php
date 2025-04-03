<x-app-layout>
    <x-alert-success>
        {{ session('success')}}
    </x-alert-success>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard Overview') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if (auth()->user()->household_id)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Water Usage Graph -->
                    <div class="bg-white p-6 rounded-2xl shadow-md col-span-1 md:col-span-2">
                        <h3 class="text-lg font-semibold mb-4">Water Usage (Last 7 days)</h3>
                        <canvas id="usageChart" height="120"></canvas>
                        <a href="{{ route('view.usage') }}">
                            <span class="text-sm flex justify-end items-center mt-5 text-blue-700">View full usage 
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-2" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </span>
                        </a>
                    </div>

                <!-- Tip of the day -->
                <div class="bg-blue-100 p-5 rounded-2xl border border-blue-200 shadow-md text-blue-900 flex items-center justify-center">
                    <div class="flex items-center max-w-md">
                        <div class="mr-4 mt-1 text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-blue-800 flex items-center">Today's Water-Saving Tip</h3>
                            <p class="mt-2 text-blue-700 leading-relaxed">
                                Turn off the tap while brushing your teeth to save 
                                <span class="font-bold text-blue-900">up to 6 litres per minute</span>!
                                That's about <span class="font-bold text-blue-900">24 litres</span>
                                saved for a family of four each day.
                            </p>
                            <div class="mt-3 text-xs text-blue-500 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Try this today
                            </div>  
                        </div>
                    </div>
                </div>

                <!-- Leaderboard Snapshot -->
                @if($leaderboardStanding)
                    <a href="{{ route('leaderboards.index') }}">
                        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-md col-span-1 mt-2">
                            <div class="flex items-start">
                                <div class="mr-4 text-blue-500 mt-0.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>    
                                </div>
                                <div>
                                    <h3 class="text-lg text-gray-800 font-semibold mb-2">Current Challenge</h3>
                                    <p class="text-gray-700">{{ $leaderboardStanding->leaderboard_name }}</p>
                                    <div class="flex items-center mt-3 text-sm text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>    
                                        {{ \Carbon\Carbon::parse($leaderboardStanding->start_date)->format('M d') }} - 
                                        {{ \Carbon\Carbon::parse($leaderboardStanding->end_date)->format('M d') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif

                <!-- Daily usage tile -->
                <div class="bg-white p-6 mt-2 rounded-2xl border border-gray-100 shadow-md">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Today's Usage</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <div class="flex items-end space-x-3">
                        <p class="text-gray-800 text-3xl font-bold">{{ $todayUsage }} Litres</p>
                        <span class="text-sm text-gray-500 mb-1">used so far today</span>
                    </div>
                        
                        
                    </div>
                </div>  
            </div>
        @else
            <div class="bg-yellow-100 text-yellow-800 p-6 rounded-lg shadow text-center">
                {{ __("Create a Household to View Usage") }}
            </div>
        @endif
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @if(isset($usageData))
        <script>
            const ctx = document.getElementById('usageChart');
            new Chart(ctx, {
                type: "line",
                data: {
                    labels: {!! json_encode($usageData->pluck('usage_date')) !!},
                    datasets: [{
                        label: "Litres Used",
                        data: {!! json_encode($usageData->pluck('litres_used')) !!},
                        borderColor: "#4f46e5",
                        backgroundColor: "rgba(79, 70, 229, 0.08)",
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true,
                        pointHoverRadius: 6,
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            position: "top",
                            labels: {
                                color: "#6b7280",
                                font: {
                                    size: 12,
                                },
                                padding: 20,
                                usePointStyle: true,
                            }
                        }, 
                    },
                    scales: {
                    y: {
                        beginAtZero: false,
                        grid: {
                            color: "rgba(226, 232, 240, 1)"
                        },
                        title: {
                            display: true,
                            text: "Litres Used",
                            font: {
                                weight: "bold",
                                size: 12,
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
                                size: 12,
                            },
                            padding: {top: 10, bottom: 0}
                        }
                    }
                }
                },
            });
        </script>
    @endif
</x-app-layout>
