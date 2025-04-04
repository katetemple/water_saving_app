<x-app-layout>
    <x-alert-success>
        {{ session('success')}}
    </x-alert-success>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            @if(auth()->user()->household_id)
                <div class="bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <div class="p-4 sm:p-8">
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Household Information') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Update your household profile information.") }}
                            </p>
                        </div>
                        <x-household-form :method="'PUT'" :household="Auth::user()->household" />
                        <form action="{{ route('households.destroy', Auth::user()->household) }}" method="POST" class="px-8 pb-8 pt-0">
                            @csrf
                            @method('DELETE')
                            <x-danger-button onclick="return confirm('Are you sure you want to disconnect your household?');">
                                Disconnect Household
                            </x-danger-button>
                        </form>
                    </div>
                </div>
            @endif

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
