<x-app-layout>
    <x-alert-success>
        {{ session('success')}}
    </x-alert-success>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (auth()->user()->household_id)
                    <div class="p-6 text-gray-900">
                        {{ __("CONTENT") }}
                    </div>
                @else
                    <div class="p-6 text-gray-900">
                        {{ __("Create a Household to View Usage") }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
