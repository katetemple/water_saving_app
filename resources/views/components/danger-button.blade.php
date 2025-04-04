<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-block px-5 py-2 border text-sm text-white rounded-xl font-medium bg-[#bf0808] rounded-md text-gray-700 hover:bg-[#a30707] shadow-md']) }}>
    {{ $slot }}
</button>