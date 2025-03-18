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
                <div class="p-6 text-gray-900">
                    <table>
                        <thead>
                            <tr>
                                <th>Usage Date</th>
                                <th>Litres Used</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usageData as $usage)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($usage->usage_date)->format('d M Y') }}</td>
                                <td>{{ $usage->litres_used }} L</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>