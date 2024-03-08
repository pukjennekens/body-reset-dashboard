<div>
    @if(count($appointments) > 0)
        <table class="table-fixed">
            <thead>
                <th>Date</th>
                <th>Start tijd</th>
                <th>Eind tijd</th>
                <th>Werknemer</th>
                <th>Cardio</th>
                <th>Module</th>
                <th>Submodules</th>
                <th>Opmerkingen</th>
                <th></th>
            </thead>

            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td class="text-sm">{{ $appointment->start->format('d-m-Y') }}</td>
                        <td class="text-sm">{{ $appointment->start->format('H:i') }}</td>
                        <td class="text-sm">{{ $appointment->end->format('H:i') }}</td>
                        <td class="text-sm">{{ $appointment->trainer ? $appointment->trainer->name : '' }}</td>
                        <td class="text-sm">{{ $appointment->cardio }}</td>
                        <td class="text-sm">{{ $appointment->module }}</td>
                        <td class="text-sm">{{ implode(', ', $appointment->submodules) }}</td>
                        <td class="text-sm">{{ $appointment->notes }}</td>
                        <td class="text-sm">
                            <div class="inline-flex items-center gap-2">
                                <button 
                                    type="button"
                                    class="rounded-lg px-4 py-1.5 border-0 bg-blue-400 text-white uppercase font-semibold hover:bg-blue-600"
                                    wire:click="$dispatch('openModal', {component: 'forms.appointment', arguments: {id: {{ $appointment->id }}}})"
                                >
                                    <i class="fa-solid fa-eye"></i>
                                </button>

                                <a href="{{ route('dashboard.admin.users.show', $appointment->user) }}" class="rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600">
                                    <i class="fa-solid fa-user"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Er zijn geen afspraken gevonden.</p>
    @endif
</div>
