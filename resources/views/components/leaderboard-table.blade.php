<div class="bg-white shadow-md rounded-2xl border border-gray-100 overflow-hidden mb-12">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Rank</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Household</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Total Litres Used</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @php
                $rankings = $leaderboard->households->map(function($household) use ($leaderboard) {
                    $litresUsed = $household->waterUsages()
                        ->whereBetween('usage_date', [$leaderboard->start_date, $leaderboard->end_date])
                        ->sum('litres_used');

                    return [
                        'household_name' => $household->household_name,
                        'litres_used' => $litresUsed,
                    ];
                })->sortBy('litres_used')->values();
            @endphp

            @foreach($rankings as $index => $entry)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $entry['household_name']}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $entry['litres_used']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if (auth()->id() === $leaderboard->user_id)
        <div class="flex space-x-2 px-4 py-4">
            <a href="{{ route('leaderboards.invite', $leaderboard) }}"><x-primary-button class="mr-3">Invite Users</x-primary-button></a>
            <a href="{{ route('leaderboards.edit', $leaderboard) }}"><x-primary-button class="mr-3">Edit Leaderboard</x-primary-button></a>
            <form action="{{ route('leaderboards.destroy', $leaderboard) }}" method="POST">
                @csrf
                @method('DELETE')
                <x-danger-button class="mr-3" onclick="return confirm('Are you sure you want to delete this Leaderboard?')">Delete Leaderboard</x-danger-button>      
            </form>
        </div>
    @endif
</div>