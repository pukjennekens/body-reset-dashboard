<div class="flex items-center gap-6">
    @if($user->credits > 0)
        <x-dropdown align="center" width="48">
            <x-slot name="trigger">
                <p class="underline decoration-dotted cursor-pointer">U heeft <strong>{{ $user->credits }}</strong> {{ $user->credits == 1 ? 'credit' : 'credits' }}</p>
            </x-slot>

            <x-slot name="content">
                <p class="px-4 py-2 text-center">Uw credits verlopen op {{ $user->credits_expiration_date->format('d-m-Y') }}</p>
            </x-slot>
        </x-dropdown>
    @else
        <p>U heeft geen credits</p>
    @endif

    <button 
        class="rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600 text-center" 
        x-data=""
        x-on:click.prevent="$dispatch('openModal', {component: 'buy-credits'})"
    >
        Credits kopen
    </button>
</div>