@props(['method' => 'POST', 'household' => null])
<form action="{{ $method === 'POST'
            ? route('households.store')
            : route('households.update', $household) }}"
        method="POST" 
        enctype="multipart/form-data"
>
    @csrf
    @if($method !== 'POST')
        @method('PUT')
    @endif

    <div class="p-9">

        <!-- Household name -->
        <div class="mb-6 max-w-md">
            <label for="household_name" class="block text-sm font-medium text-gray-700">Household Name</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input  
                    type="text" 
                    id="household_name" 
                    name="household_name" 
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 py-2 px-3 border" 
                    required
                    value="{{ old('household_name', $household?->household_name) }}"
                    placeholder="E.g Smith Family"
                >
            </div>
        </div>

        <!-- Address -->
        <div class="mb-6 max-w-3xl">
            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input 
                    type="text" 
                    id="address" 
                    name="address" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" 
                    required
                    value="{{ old('address', $household?->address) }}"
                    placeholder="Enter full address (e.g., 123 Main St, Dublin, A98HA24)"
                >
            </div>
        </div>

        <!-- Smart meter id -->
        <div class="mb-6 max-w-md">
            <label for="smart_meter_id" class="block text-sm font-medium text-gray-700">Smart Meter ID</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input 
                    type="text" 
                    id="smart_meter_id" 
                    name="smart_meter_id" 
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" 
                    required
                    value="{{ old('smart_meter_id', $household?->smart_meter_id) }}"
                    placeholder="Enter 12-digit meter serial (e.g. SM1234567890)"
                >
            </div>
        </div>

        <x-primary-button>
            {{ $method === 'POST' ? 'Create Household' : 'Update Household' }}
        </x-primary-button>
    </div>

</form>