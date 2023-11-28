<div>
    @if($girthMeasurements->count())
        <table class="table-fixed">
            <thead>
                <th>Datum</th>
                <th>Borst</th>
                <th>Heup</th>
                <th>Dij</th>
                <th>Onder borst</th>
                <th>Biceps</th>
                <th>Taille</th>
                <th></th>
            </thead>

            <tbody>
                @foreach($girthMeasurements as $measurement)
                    <tr>
                        <td>{{ $measurement->date->format('d-m-Y') }}</td>
                        <td>{{ $measurement->chest }}</td>
                        <td>{{ $measurement->hips }}</td>
                        <td>{{ $measurement->thigh }}</td>
                        <td>{{ $measurement->under_breast }}</td>
                        <td>{{ $measurement->upper_arm }}</td>
                        <td>{{ $measurement->waist }}</td>
                        <td class="text-center"><button wire:click="$dispatch('openModal', {component: 'delete-girth-measurement', arguments: {id: {{ $measurement->id }}}})" class="text-xs bg-red-500 text-white p-2 rounded-md hover:bg-red-700"><i class="fas fa-trash"></i></button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Er zijn nog geen metingen gedaan.</p>
    @endif
</div>
