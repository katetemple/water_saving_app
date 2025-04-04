@props(['method' => 'POST', 'leaderboard' => null])
<form action="{{ $method === 'POST' 
            ? route('leaderboards.store')
            : route('leaderboards.update', $leaderboard) }}"
        method="POST" 
        enctype="multipart/form-data"
>
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif
    
    <div class="p-9">

    <!-- leaderboard name -->
        <div class="mb-6 max-w-2xl">
            <label for="leaderboard_name" class="block text-sm font-medium text-gray-700">Leaderboard Name</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input 
                    type="text" 
                    id="leaderboard_name" 
                    name="leaderboard_name" 
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 border" 
                    required
                    value="{{ old('leaderboard_name', $leaderboard?->leaderboard_name) }}"
                    placeholder="E.g. Summer Water Saving Challenge"
                >
            </div>
        </div>

    <!-- Start date -->
        <div class="mb-6 max-w-xs">
            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input 
                    type="date" 
                    id="start_date" 
                    name="start_date" 
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 border" 
                    required
                    value="{{ old('start_date', $leaderboard?->start_date) }}"
                >
            </div>
        </div>

    <!-- End date -->
        <div class="mb-6 max-w-xs">
            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input 
                    type="date" 
                    id="end_date" 
                    name="end_date" 
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 border" 
                    required
                    value="{{ old('end_date', $leaderboard?->end_date) }}"
                >
            </div>
        </div>
        <x-primary-button>
            {{ $method === 'POST' ? 'Create Leaderboard' : 'Update Leaderboard' }}
        </x-primary-button>
    </div>
</form>