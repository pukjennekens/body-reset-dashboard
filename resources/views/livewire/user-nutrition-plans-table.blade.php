<div>
    @if($nutritionPlans->count())
        <table class="table-fixed">
            <thead>
                <th>Datum</th>
                <th>Ma</th>
                <th>Di</th>
                <th>Wo</th>
                <th>Do</th>
                <th>Vr</th>
                <th>Za</th>
                <th>Zo</th>
                <th></th>
            </thead>

            <tbody>
                @foreach($nutritionPlans as $nutritionPlan)
                    <tr>
                        <td>{{ $nutritionPlan->date->format('d-m-Y') }}</td>
                        <td>@if(empty($nutritionPlan->recipies_monday ))<span class="text-red-500"><i class="fa-solid fa-xmark"></i></span>@else<span class="text-primary"><i class="fa-solid fa-check"></i></span>@endif</td>
                        <td>@if(empty($nutritionPlan->recipies_tuesday ))<span class="text-red-500"><i class="fa-solid fa-xmark"></i></span>@else<span class="text-primary"><i class="fa-solid fa-check"></i></span>@endif</td>
                        <td>@if(empty($nutritionPlan->recipies_wednesday ))<span class="text-red-500"><i class="fa-solid fa-xmark"></i></span>@else<span class="text-primary"><i class="fa-solid fa-check"></i></span>@endif</td>
                        <td>@if(empty($nutritionPlan->recipies_thursday ))<span class="text-red-500"><i class="fa-solid fa-xmark"></i></span>@else<span class="text-primary"><i class="fa-solid fa-check"></i></span>@endif</td>
                        <td>@if(empty($nutritionPlan->recipies_friday ))<span class="text-red-500"><i class="fa-solid fa-xmark"></i></span>@else<span class="text-primary"><i class="fa-solid fa-check"></i></span>@endif</td>
                        <td>@if(empty($nutritionPlan->recipies_saturday ))<span class="text-red-500"><i class="fa-solid fa-xmark"></i></span>@else<span class="text-primary"><i class="fa-solid fa-check"></i></span>@endif</td>
                        <td>@if(empty($nutritionPlan->recipies_sunday ))<span class="text-red-500"><i class="fa-solid fa-xmark"></i></span>@else<span class="text-primary"><i class="fa-solid fa-check"></i></span>@endif</td>
                        <td>
                            <button wire:click="$dispatch('openModal', {component: 'forms.nutrition-plan', arguments: {id: {{ $nutritionPlan->id }}, userId: {{ $user->id }}}})"class="text-xs bg-primary text-white p-2 rounded-md hover:bg-green-600"><i class="fas fa-edit"></i></button>
                            <button wire:click="$dispatch('openModal', {component: 'delete-nutrition-plan', arguments: {id: {{ $nutritionPlan->id }}}})" class="text-xs bg-red-500 text-white p-2 rounded-md hover:bg-red-700"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Er zijn nog geen voedingsschema's aangemaakt.</p>
    @endif
</div>
