<x-dashboard-layout>
    <div class="max-w-6xl mx-auto">
        <h2 class="text-2xl font-semibold mb-4">
            Profiel
        </h2>

        <div class="space-y-8">
            @livewire('forms.profile')

            @livewire('forms.change-password')
        </div>
    </div>
</x-dashboard-layout>