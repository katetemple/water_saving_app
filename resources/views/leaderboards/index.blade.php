<x-app-layout>
    <!-- Display success message after creating, editing, deleting -->
    <x-alert-success>
        {{ session('success') }}
    </x-alert-success>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Leaderboards') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-4 mb-5">
            <div class="max-w-sm">
                <a href="{{ route('leaderboards.create') }}"><x-primary-button>{{ __('+ Create New Leaderboard') }}</x-primary-button></a>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-4">
            <div class="overflow-hidden">
                @foreach($leaderboards as $leaderboard)
                    <x-leaderboard-table :leaderboard="$leaderboard" />

                    @if(auth()->id() === $leaderboard->user_id)
                    <div class="flex">
                    <div class="max-w-sm mr-5">
                        <a href="{{ route('invites.create', $leaderboard) }}"><x-primary-button class="mt-3">{{ __('Invite Users') }}</x-primary-button></a>
                    </div>
                    <!-- <div class="max-w-sm mr-5">
                        <a href="{{ route('leaderboards.edit', $leaderboard) }}"><x-primary-button class="mt-3">{{ __('Edit Leaderboard') }}</x-primary-button></a>
                    </div> -->
                    <div class="max-w-sm mr-5">
                        <form action="{{ route('leaderboards.destroy', $leaderboard) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-danger-button class="mt-4" onclick="return confirm('Are you sure you want to delete this Leaderboard?')">{{ __('Delete Leaderboard') }}</x-danger-button>
                        </form>
                    </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
