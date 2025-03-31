<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>

    <!-- Display success message after creating, editing, deleting -->
    <!-- <x-alert-success>
        {{ session('success') }}
    </x-alert-success> -->

    @foreach(auth()->user()->unreadNotifications as $notification)
        <div class="notification">
            <p>{{ $notification->data['message'] }}</p>
            <form action="{{ route('leaderboard-invitations.respond', $notification->id) }}" method="POST">
                @csrf
                <input type="hidden" name="leaderboard_id" value="{{ $notification->data['leaderboard_id'] }}">
                <button name="response" value="accepted">Accept</button>
                <button name="response" value="denied">Deny</button>
            </form>
        </div>
    @endforeach
</x-app-layout>