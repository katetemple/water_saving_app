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
    
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 p-9">

    <!-- leaderboard name -->
        <div>
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

    <!-- Empty col for space -->
        <div></div>

    <!-- Start date -->
        <div>
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

        <div>
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

        <div class="flex justify-end pt-6 border-t border-gray-200">
            <
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            {{ $method === 'POST' ? 'Create Leaderboard' : 'Update Leaderboard' }}
        </button>
    </div>
</form>