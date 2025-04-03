<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-block px-5 py-2 border text-sm text-white rounded-xl font-medium bg-[#0aa30a] rounded-md text-gray-700 bg-white hover:bg-[#087808]']) }}>
    {{ $slot }}
</button>