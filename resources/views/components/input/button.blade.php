{{-- Button component --}}
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'rounded-lg px-4 py-1.5 border bg-primary text-white uppercase font-semibold hover:bg-green-600']) }}>
    {{ $slot }}
</button>