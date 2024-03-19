<x-dashboard-layout>
    <div class="max-w-6xl mx-auto">
        <h2 class="text-2xl font-semibold mb-4">
            Profiel
        </h2>

        <div class="space-y-8">
            @livewire('forms.profile')

            @livewire('forms.change-password')
        </div>

        <button type="button" class="text-xs bg-red-500 text-white p-2 rounded-md hover:bg-red-700 block mt-4" x-data x-on:click.prevent="$dispatch('openModal', {component: 'delete-user', arguments: {id: {{ auth()->id() }} }})">
            <i class="fa-solid fa-trash"></i>
            Je account verwijderen
        </button>
    </div>
</x-dashboard-layout>