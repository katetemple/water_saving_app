@props(['leaderboard'])

<form action="{{ route('leaderboards.invite', $leaderboard) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-4">
        <label for="email">User Email:</label>
        <input type="email" id="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
    </div>

    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Send Invite</button>

</form>