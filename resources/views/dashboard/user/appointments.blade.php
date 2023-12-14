<x-dashboard-layout>
    <div class="max-w-6xl mx-auto">
        <h2 class="text-2xl font-semibold mb-2">
            Afspraken
        </h2>

        @livewire('appointment-calendar', ['branchId' => auth()->user()->branch->id, 'userId' => auth()->user()->id])
    </div>
</x-dashboard-layout>