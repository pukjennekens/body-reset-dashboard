<x-dashboard-layout>
    <h2 class="text-2xl font-semibold mb-2">
        Overzicht
    </h2>

    <p class="mt-2">
        Op deze pagina vind u een overzicht met al uw afspraken en pete- en metekinderen
    </p>

    <div class="mt-8">
        <h2 class="text-xl font-semibold mb-2">
            Peter- en metekinderen
        </h2>

        @livewire('sub-users-overview', ['userId' => auth()->user()->id])
    </div>
</x-dashboard-layout>