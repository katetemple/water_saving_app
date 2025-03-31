<div class="overflow-x-auto bg-white shadow rounded-xl border border-gray-100">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Rank</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Household</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">Total Litres Used</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
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
</div>