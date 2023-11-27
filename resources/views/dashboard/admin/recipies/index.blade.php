<x-dashboard-layout>
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-semibold mb-2">
            Recepten
        </h2>

        <button class="rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600" x-data="" x-on:click.prevent="$dispatch('openModal', {component: 'forms.recipe'})">
            <i class="fas fa-plus"></i>
        </button>
    </div>

    <livewire:recipe-table />
</x-dashboard-layout>