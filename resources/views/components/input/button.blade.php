{{-- Button component --}}
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600']) }}>
    {{ $slot }}
</button>