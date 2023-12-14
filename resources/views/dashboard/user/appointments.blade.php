<x-dashboard-layout>
    <div class="max-w-6xl mx-auto space-y-4">
        @livewire('appointments-overview', ['userId' => auth()->user()->id])

        @livewire('appointment-calendar', ['branchId' => auth()->user()->branch->id, 'userId' => auth()->user()->id])
    </div>
</x-dashboard-layout>