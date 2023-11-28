<div>
    @if($bodyCompositionMeasurements->count())
        <table class="table-fixed">
            <thead>
                <th>Datum</th>
                <th>Hoogte</th>
                <th>Gewicht</th>
                <th>Botmassa</th>
                <th>Spiermassa</th>
                <th>Vet percentage</th>
                <th>Water percentage</th>
                <th>Metabolische leeftijd</th>
                <th>Visceraal vet</th>
                <th></th>
            </thead>

            <tbody>
                @foreach($bodyCompositionMeasurements as $measurement)
                    <tr>
                        <td>{{ $measurement->date->format('d-m-Y') }}</td>
                        <td>{{ $measurement->height }}</td>
                        <td>{{ $measurement->weight }}</td>
                        <td>{{ $measurement->bone_mass }}</td>
                        <td>{{ $measurement->muscle_mass }}</td>
                        <td>{{ $measurement->fat_percentage }}</td>
                        <td>{{ $measurement->water_percentage }}</td>
                        <td>{{ $measurement->metabolic_age }}</td>
                        <td>{{ $measurement->visceral_fat }}</td>
                        <td class="text-center"><button wire:click="$dispatch('openModal', {component: 'delete-body-composition-measurement', arguments: {id: {{ $measurement->id }}}})" class="text-xs bg-red-500 text-white p-2 rounded-md hover:bg-red-700"><i class="fas fa-trash"></i></button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Er zijn nog geen metingen gedaan.</p>
    @endif
</div>