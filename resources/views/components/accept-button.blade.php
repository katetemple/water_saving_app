<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-block px-5 py-2 border text-sm text-white rounded-xl font-medium bg-[#0aa30a] rounded-md text-gray-700 hover:bg-[#087808] shadow-md']) }}>
    {{ $slot }}
</button>