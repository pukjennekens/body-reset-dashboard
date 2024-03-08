<x-dashboard-layout>
    <div class="max-w-6xl mx-auto">
        <h2 class="text-2xl font-semibold mb-2">
            Hi {{ strtok(auth()->user()->name, ' ') }},
        </h2>

        <p class="mt-2">
            Welkom op je persoonlijke dashboard, {{ strtok(auth()->user()->name, ' ') }}. Hier vind je in een oogopslag alle belangrijke gegevens terug zoals je metingen, je volgende afspraak, het aantal credits en de bijhorende vervaldatum. Via de navigatie hierboven kun je jouw afspraken beheren, voedingsschema's bekijken, documenten downloaden en nieuwe bundels of producten aankopen.
        </p>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <i class="fa-solid fa-weight-scale text-8xl text-primary"></i>

                <h3 class="text-2xl font-semibold mt-4">Gewicht:</h3>

                <p class="mt-2">{{ auth()->user()->getWeight() ? auth()->user()->getWeight() . ' kg' : 'Nog geen meting' }}</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <i class="fa-solid fa-calendar-days text-8xl text-primary"></i>

                <h3 class="text-2xl font-semibold mt-4">Volgende afspraak:</h3>

                @if(auth()->user()->nextAppointment())
                    <p class="mt-2">
                        {{ auth()->user()->nextAppointment()->start->format('d-m-Y') }} om {{ auth()->user()->nextAppointment()->start->format('H:i') }}
                    </p>

                    <p class="mt-1 text-sm font-bold text-gray-600 italic">
                        {{ auth()->user()->nextAppointment()->service->name }}
                    </p>
                @else
                    <p>
                        <span class="text-gray-400">Nog geen afspraak gevonden.</span>
                    </p>
                @endif
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <i class="fa-solid fa-coins text-8xl text-primary"></i>

                <h3 class="text-2xl font-semibold mt-4">Credits:</h3>

                <p class="mt-2">{{ auth()->user()->credits }} credits</p>
                @if(auth()->user()->credits_expiration_date)
                    @if(auth()->user()->credits_expiration_date->isPast())
                        <p class="mt-1 text-sm font-bold text-red-600 italic">Vervallen</p>
                    @else
                        <p class="mt-1 text-sm font-bold text-gray-600 italic">Geldig tot: {{ auth()->user()->credits_expiration_date ?? auth()->user()->credits_expiration_date->format('d-m-Y') }}</p>
                    @endif
                @endif
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <h3 class="text-2xl font-semibold mb-4">Gewichtsverdeling:</h3>

                @livewire('weight-distribution-graph', ['userId' => auth()->user()->id])
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <i class="fa-solid fa-heart-pulse text-8xl text-primary"></i>

                <h3 class="text-2xl font-semibold mt-4">Visceraal vet:</h3>

                <p class="mt-2">{{ auth()->user()->getVisceralFat() ? auth()->user()->getVisceralFat() : 'Nog geen meting' }}</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <i class="fa-solid fa-person-walking text-8xl text-primary"></i>

                <h3 class="text-2xl font-semibold mt-4">Metabolische leeftijd:</h3>

                <p class="mt-2">{{ auth()->user()->getMetabolicAge() ? auth()->user()->getMetabolicAge() . ' jaar' : 'Nog geen meting' }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 mt-4 gap-4">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-2xl font-semibold mb-4">Lichaamssamenstelling:</h3>

                @livewire('body-composition-history-graph', ['userId' => auth()->user()->id])
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-2xl font-semibold mb-4">Omtrekmetingen:</h3>

                @livewire('girth-measurements-history-graph', ['userId' => auth()->user()->id])
            </div>
        </div>
    </div>
</x-dashboard-layout>