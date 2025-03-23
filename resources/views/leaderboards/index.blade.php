<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Leaderboards') }}
        </h2>
    </x-slot>

    <!-- Display success message after creating, editing, deleting -->
    <!-- <x-alert-success>
        {{ session('success') }}
    </x-alert-success> -->

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-4 mb-5">
            <div class="max-w-sm">
                <a href="{{ route('leaderboards.create') }}"><x-primary-button class="ms-3">{{ __('+ Create New Leaderboard') }}</x-primary-button></a>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl">
                @foreach($leaderboards as $leaderboard)
                    <x-leaderboard-table :leaderboard="$leaderboard" />
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
