<x-dashboard-layout>
    <h2 class="text-2xl font-semibold mb-2">
        Welkom op uw persoonlijke dashboard
    </h2>

    <p class="mb-8 max-w-md">
        Hier vind u in éen oogopslag alle belangrijke gegevens terug zoals uw metingen, uw volgende afspraak, het aantal credits die u nog ter beschikking heeft en de bijhorende vervaldatum. Via de navigatie hierboven kunt u uw afspraken beheren, voedingsschema's bekijken, documenten downloaden en nieuwe bundels credits aankopen.
    </p>

    <h2 class="text-2xl font-semibold mb-4">
        Informatie:
    </h2>

    <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-16">
        <div class="bg-white rounded shadow-md px-6 py-4">
            <h3 class="text-2xl text-primary font-bold inline-flex items-center gap-4 mb-2"><i class="fa-regular fa-calendar"></i> Volgende afspraak</h3>
            <p class="text-gray-600">U heeft nog geen afspraak gepland staan</p>
        </div>

        <div class="bg-white rounded shadow-md px-6 py-4">
            <h3 class="text-2xl text-primary font-bold inline-flex items-center gap-4 mb-2"><i class="fa-solid fa-coins"></i> Credits</h3>
            <p class="text-gray-600">U heeft nog <strong>10</strong> credits ter beschikking</p>
        </div>
    </div>

    <h2 class="text-2xl font-semibold mb-4">
        Huidige metingen:
    </h2>

    <div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-16">
        <div class="bg-white rounded shadow-md px-6 py-4">
            <h3 class="text-2xl text-primary font-bold inline-flex items-center gap-4 mb-2"><i class="fa-solid fa-weight-scale"></i> Gewicht</h3>
            <p class="text-gray-600">Uw huidige gewicht is <strong>80kg</strong></p>
        </div>

        <div class="bg-white rounded shadow-md px-6 py-4">
            <h3 class="text-2xl text-primary font-bold inline-flex items-center gap-4 mb-2"><i class="fa-solid fa-heart-pulse"></i> Visceraal vet</h3>
            <p class="text-gray-600">Uw huidige visceraal vet is <strong>4</strong></p>
        </div>

        <div class="bg-white rounded shadow-md px-6 py-4">
            <h3 class="text-2xl text-primary font-bold inline-flex items-center gap-4 mb-2"><i class="fa-solid fa-person-walking"></i> Metabolische leeftijd</h3>
            <p class="text-gray-600">Uw huidige metabolische leeftijd is <strong>22</strong> jaar</p>
        </div>
    </div>
</x-dashboard-layout>