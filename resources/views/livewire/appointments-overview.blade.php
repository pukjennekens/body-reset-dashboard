<div>
    <h2 class="text-2xl font-semibold mb-2">
        Afspraken
    </h2>

    <table class="table-fixed">
        <thead>
            <th>Datum</th>
            <th>Tijd</th>
            <th>Dienst</th>
            <th>Prijs</th>
        </thead>

        <tbody>
            @if(!empty($user->appointments))
                @foreach($user->appointments->sortBy('start') as $appointment)
                    <tr>
                        <td>{{ $appointment->start->format('d-m-Y') }}</td>
                        <td>{{ $appointment->start->format('H:i') }}</td>
                        <td>{{ $appointment->service->name }}</td>
                        <td>{{ $appointment->service->price }} {{ $appointment->service->price == 1 ? 'credit' : 'credits' }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center">
                        <span class="text-gray-400">Geen afspraken gevonden.</span>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>    
</div>