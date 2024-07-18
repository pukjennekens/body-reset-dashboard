<div>
    <h2 class="text-2xl font-semibold mb-2">
        Afspraken
    </h2>

    @if(!empty($user->appointments->where('start', '>=', now())->sortBy('start')->toArray()))
        <div class="overflow-x-auto">
            <table class="table-auto">
                <thead>
                    <th>Datum</th>
                    <th>Start tijd</th>
                    <th>Eind tijd</th>
                    <th>Dienst</th>
                    <th>Prijs</th>
                    <th>Annuleren</th>
                </thead>

                <tbody>
                    @foreach($user->appointments->where('start', '>=', now())->sortBy('start') as $appointment)
                        <tr>
                            <td class="whitespace-nowrap">{{ $appointment->start->format('d-m-Y') }}</td>
                            <td class="whitespace-nowrap">{{ $appointment->start->format('H:i') }}</td>
                            <td class="whitespace-nowrap">{{ $appointment->end->format('H:i') }}</td>
                            <td class="whitespace-nowrap">{{ $appointment->service->name }}</td>
                            <td class="whitespace-nowrap">{{ $appointment->service->price }} {{ $appointment->service->price == 1 ? 'credit' : 'credits' }}</td>
                            <td class="whitespace-nowrap">
                                @if($appointment->start->diffInHours(now()) >= 24)
                                    <button 
                                        type="button"
                                        class="rounded-lg px-4 py-1.5 border-0 bg-red-500 text-sm text-white uppercase font-semibold hover:bg-red-700 inline-flex items-center justify-center"
                                        wire:click="$dispatch('openModal', {component: 'cancel-appointment', arguments: {appointmentId: {{ $appointment->id }}}})"
                                    >
                                        Annuleren
                                    </button>
                                @else
                                    <p class="underline decoration-dotted cursor-pointer">Niet meer mogelijk</p>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <tr>
            <td colspan="4" class="text-center">
                <span class="text-gray-800">Geen afspraken gevonden.</span>
            </td>
        </tr>
    @endif 
</div>