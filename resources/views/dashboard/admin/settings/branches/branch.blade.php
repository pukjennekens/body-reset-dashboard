<x-dashboard-layout>
    <h2 class="text-2xl font-semibold mb-4">
        Filiaal {{ $branch->name }}:
    </h2>

    @livewire('forms.branch', ['id' => $branch->id])

    <h2 class="text-2xl font-semibold mt-8 mb-2">Diensten:</h2>

    @livewire('forms.branch-services', ['branchId' => $branch->id])

    <h2 class="text-2xl font-semibold mt-8 mb-4">Openingstijden:</h2>
</x-dashboard-layout>