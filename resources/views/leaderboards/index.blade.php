<x-app-layout>
    <!-- Display success message after creating, editing, deleting -->
    <x-alert-success>
        {{ session('success') }}
    </x-alert-success>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Leaderboards') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-4 mb-5">
            <div class="flex justify-end">
                <a href="{{ route('leaderboards.create') }}"><x-primary-button>{{ __('+ Create New Leaderboard') }}</x-primary-button></a>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-4">
            <div class="overflow-hidden">
                @foreach($leaderboards as $leaderboard)
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">
                        {{ $leaderboard->leaderboard_name }}
                    </h3>

                    <x-leaderboard-table :leaderboard="$leaderboard" />


                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
