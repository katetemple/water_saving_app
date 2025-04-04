<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <a href="{{ route('leaderboards.index') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium flex items-center ml-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-5">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-greay-200">
                <div class="p-8 sm:p-10 bg-white">
                    <div class="flex items-center mb-6">
                        <div class="p-3 rounded-full bg-blue-50 text-blue-600 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Create Household</h3>
                        <p class="text-sm text-gray-500">Set up your household profile to access real-time water usage data from your smart meter</p>
                    </div>
                </div>

                <div>
                    <x-household-form
                            :action="route('households.store')"
                            :method="'POST'"
                        />
                </div>
            </div>
        </div>
    </div>

</x-app-layout>