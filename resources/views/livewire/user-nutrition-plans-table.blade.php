<div>
    @if($nutritionPlans->count())
        <table class="table-fixed">
            <thead>
                <th>Datum</th>
                <th></th>
            </thead>

            <tbody>
                @foreach($nutritionPlans as $nutritionPlan)
                    <tr>
                        <td>{{ $nutritionPlan->date->format('d-m-Y') }}</td>
                        <td>
                            <button wire:click="$dispatch('openModal', {component: 'forms.nutrition-plan', arguments: {id: {{ $nutritionPlan->id }}}})"
                            class="text-xs bg-primary text-white p-2 rounded-md hover:bg-green-600"><i class="fas fa-edit"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Er zijn nog geen voedingsschema's aangemaakt.</p>
    @endif
</div>
