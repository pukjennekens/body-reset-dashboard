<div>
    <h2 class="text-2xl font-semibold mb-2">
        Afspraken
    </h2>

    @if(!empty($user->appointments->where('start', '>=', now())->sortBy('start')->toArray()))
        <table class="table-fixed">
            <thead>
                <th>Datum</th>
                <th>Tijd</th>
                <th>Dienst</th>
                <th>Prijs</th>
                <th>Annuleren</th>
            </thead>

            <tbody>
                @foreach($user->appointments->where('start', '>=', now())->sortBy('start') as $appointment)
                    <tr>
                        <td>{{ $appointment->start->format('d-m-Y') }}</td>
                        <td>{{ $appointment->start->format('H:i') }}</td>
                        <td>{{ $appointment->service->name }}</td>
                        <td>{{ $appointment->service->price }} {{ $appointment->service->price == 1 ? 'credit' : 'credits' }}</td>
                        <td>
                            @if($appointment->start->diffInHours(now()) > 24)
                                <button 
                                    type="button"
                                    class="rounded-lg px-4 py-1.5 border-0 bg-red-500 text-sm text-white uppercase font-semibold hover:bg-red-700 inline-flex items-center justify-center"
                                    wire:click="$dispatch('openModal', {component: 'cancel-appointment', arguments: {appointmentId: {{ $appointment->id }}}})"
                                >
                                    Annuleren
                                </button>
                            @else
                                <x-dropdown align="center" width="64">
                                    <x-slot name="trigger">
                                        <p class="underline decoration-dotted cursor-pointer">Niet meer mogelijk</p>
                                    </x-slot>

                                    <x-slot name="content">
                                        <p class="px-4 py-2 text-left">Omdat deze afspraak binnen 24 uur valt, is het niet meer mogelijk om deze afspraak te annuleren. Wilt u toch de afspraak annuleren? Neem dan contact op met onze klantenservice.</p>
                                    </x-slot>
                                </x-dropdown>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>   
    @else
        <tr>
            <td colspan="4" class="text-center">
                <span class="text-gray-800">Geen afspraken gevonden.</span>
            </td>
        </tr>
    @endif 
</div>