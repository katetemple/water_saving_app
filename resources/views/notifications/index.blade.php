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

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg-px-8">
        @if(auth()->user()->unreadNotifications->isEmpty())
            <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">No new notifications</h3>
                <p class="mt-1 text-sm text-gray-500">When you receive notifications, they'll appear here.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach(auth()->user()->unreadNotifications as $notification)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border-l-4 border-blue-500">
                        <div class="p-6 flex justify-items-between items-start">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 bg-blue-100 p-2 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">{{ $notification->data['message'] }}</p>
                                    <p class="text-xs text-gray-500 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>

                                <form action="{{ route('leaderboard-invitations.respond', $notification->id) }}" method="POST" class="flex space-x-2">
                                    @csrf
                                    <input type="hidden" name="leaderboard_id" value="{{ $notification->data['leaderboard_id'] }}">
                                    <x-accept-button name="response" value="accepted" class="inline">Accept</x-accept-button>
                                    <x-danger-button name="response" value="denied">Deny</x-danger-button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @endif
    </div>

</x-app-layout>