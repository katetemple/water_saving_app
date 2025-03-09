@props(['action'])

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">

    <div class="mb-4">
        <label for="household_name">Household Name:</label>
        <input type="text" id="household_name" name="household_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
    </div>

    <div class="mb-4">
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
    </div>

    <div class="mb-4">
        <label for="smart_meter_id">Smart Meter ID:</label>
        <input type="text" id="smart_meter_id" name="smart_meter_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
    </div>

    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Household</button>

</form>