<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-block px-5 py-2 bg-[#112D4E] hover:bg-[#2E527D] border text-white rounded-2xl shadow-lg text-sm font-medium leading-normal']) }}>
    {{ $slot }}
</button>
