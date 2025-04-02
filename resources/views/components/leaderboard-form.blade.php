@props(['method', 'leaderboard'])
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
    <div class="mb-4">
        <label for="leaderboard_name">Leaderboard Name:</label>
        <input 
            type="text" 
            id="leaderboard_name" 
            name="leaderboard_name" 
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" 
            required
            value="{{ old('leaderboard_name', $leaderboard?->leaderboard_name) }}"
        >
    </div>

    <div class="mb-4">
        <label for="start_date">Start Date:</label>
        <input 
            type="date" 
            id="start_date" 
            name="start_date" 
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" 
            required
            value="{{ old('start_date', $leaderboard?->start_date) }}"
        >
    </div>

    <div class="mb-4">
        <label for="end_date">End Date:</label>
        <input 
            type="date" 
            id="end_date" 
            name="end_date" 
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" 
            required
            value="{{ old('end_date', $leaderboard?->end_date) }}"
        >
    </div>

    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        {{ $method === 'POST' ? 'Create Leaderboard' : 'Update Leaderboard' }}
    </button>
</form>