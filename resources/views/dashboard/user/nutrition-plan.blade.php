@php
    if(!function_exists('formatDay')) {
        function formatDay($day) {
            switch($day) {
                case 'monday': $day = 'Maandag'; break;
                case 'tuesday': $day = 'Dinsdag'; break;
                case 'wednesday': $day = 'Woensdag'; break;
                case 'thursday': $day = 'Donderdag'; break;
                case 'friday': $day = 'Vrijdag'; break;
                case 'saturday': $day = 'Zaterdag'; break;
                case 'sunday': $day = 'Zondag'; break;
            }

            return $day;
        }
    }

    if(!function_exists('formatAllergen')) {
        function formatAllergen($allergen) {
            $allergenOptions = [
                'gluten'         => 'Gluten',
                'crustaceans'    => 'Schaaldieren',
                'eggs'           => 'Eieren',
                'fish'           => 'Vis',
                'peanuts'        => 'Pinda\'s',
                'soybeans'       => 'Soja',
                'milk'           => 'Melk',
                'nuts'           => 'Noten',
                'celery'         => 'Selderij',
                'mustard'        => 'Mosterd',
                'sesame'         => 'Sesam',
                'sulfur_dioxide' => 'Sulfieten',
                'lupin'          => 'Lupines',
                'molluscs'       => 'Weekdieren',
            ];

            return isset($allergenOptions[$allergen]) ? $allergenOptions[$allergen] : $allergen;
        }
    }

    $days = []; 
    $weekDays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    foreach($weekDays as $day) {
        if($nutritionPlan->{'recipies_' . $day}) {
            foreach($nutritionPlan->{'recipies_' . $day} as $recipe) {
                if(isset($recipe['recipeId']) && \App\Models\Recipe::where('id', $recipe['recipeId'])->exists()) {
                    in_array($day, $days) ? null : array_push($days, $day);
                } elseif(isset($recipe['recipeId']) && !\App\Models\Recipe::where('id', $recipe['recipeId'])->exists()) {
                    $nutritionPlan->{'recipies_' . $day} = array_filter($nutritionPlan->{'recipies_' . $day}, function($value) use ($recipe) {
                        return $value['recipeId'] != $recipe['recipeId'];
                    });
                    $nutritionPlan->save();
                } else {
                    $nutritionPlan->{'recipies_' . $day} = array_filter($nutritionPlan->{'recipies_' . $day}, function($value) use ($recipe) {
                        return $value['recipeId'] != $recipe['recipeId'];
                    });
                    $nutritionPlan->save();
                }
            }
        }
    }
@endphp

<x-dashboard-layout>
    <div x-data="{ tab: 'overview' }" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <div class="col-span-1 lg:col-span-3 flex flex-col gap-2">
            <button 
                x-on:click.prevent="tab = 'overview'" 
                class="px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100 inline-flex items-center gap-2"
                :class="{ 'border-primary': tab === 'overview' }" 
            >
                Overzicht
            </button>
            @foreach ($days as $day)
                <button 
                    x-on:click.prevent="tab = '{{ $day }}'" 
                    class="px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100 inline-flex items-center gap-2"
                    :class="{ 'border-primary': tab === '{{ $day }}' }" 
                >
                    {{ formatDay($day) }}
                </button>
            @endforeach
        </div>

        <div class="flex flex-col col-span-1 lg:col-span-9">
            <div class="space-y-4" x-show="tab === 'overview'">
                <h2 class="text-2xl font-semibold">Overzicht</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-xl mb-2 font-semibold">Datum:</p>
                        <span>{{ $nutritionPlan->date->format('d-m-Y') }}</span>
                    </div>

                    <div>
                        <p class="text-xl mb-2 font-semibold">Voedingsdeskundige:</p>
                        <span>{{ $nutritionPlan->creator->name }}</span>
                    </div>
                </div>

                @if($nutritionPlan->remark)
                    <div>
                        <p class="text-xl mb-2 font-semibold">Opmerkingen:</p>
                        <span>{{ $nutritionPlan->remark }}</span>
                    </div>
                @endif
            </div>

            @foreach($days as $day)
                <div x-show="tab === '{{ $day }}'">
                    <h2 class="text-2xl font-semibold mb-2">{{ formatDay($day) }}</h2>

                    @if($nutritionPlan->{'remark_' . $day})
                        <p class="bg-blue-100 py-4 px-6 rounded-lg shadow-md mt-4">
                            <span class="font-semibold mb-2">Opmerkingen voor {{ formatDay($day) }}:</span>
                            <br>
                            {{ $nutritionPlan->{'remark_' . $day} }}
                        </p>
                    @endif

                    @if(!empty($nutritionPlan->{'recipies_' . $day}))
                        <div class="mt-8">
                            <h2 class="text-2xl font-semibold mb-4">Alle recepten voor {{ formatDay($day) }}:</h2>

                            <ul class="flex flex-col gap-2">
                                @foreach($nutritionPlan->{'recipies_' . $day} as $recipeKey => $recipe)
                                    @php $recipeUserRemark = $recipe['remark']; $recipe = \App\Models\Recipe::find($recipe['recipeId']); @endphp
                                    <li 
                                        class="bg-white px-6 py-4 shadow-lg rounded-lg" 
                                        x-data="{ open: false }"
                                    >
                                        <div x-on:click="open = !open" class="cursor-pointer flex items-center justify-between gap-4">
                                            <h3 class="font-bold" :class="{ 'mb-2 font-semibold md:text-2xl': open }">
                                                {{ $recipe->name }} ({{ $recipe->meal_type }})
                                            </h3>

                                            <i class="fas fa-chevron-down" :class="{ 'transform rotate-180': open }"></i>
                                        </div>

                                        <div x-show="open" x-transition>
                                            <div class="flex gap-4">
                                                <div class="inline-flex gap-2 items-center">
                                                    <i class="fas fa-utensils"></i>
                                                    {{ $recipe->meal_type }}
                                                </div>

                                                <div class="inline-flex gap-2 items-center">
                                                    <i class="fas fa-user"></i>
                                                    {{ $recipe->number_of_people == 1 ? '1 persoon' : $recipe->number_of_people . ' personen' }}
                                                </div>

                                                <div class="inline-flex gap-2 items-center">
                                                    <i class="fas fa-clock"></i>
                                                    @php
                                                        $hours   = floor($recipe->prepation_time / 60);
                                                        $minutes = $recipe->prepation_time % 60;
                                                        echo sprintf('%02d:%02d', $hours, $minutes);
                                                    @endphp
                                                </div>
                                            </div>

                                            @if(!empty($recipe->allergens))
                                                <h3 class="font-semibold text-xl mt-8 mb-2">Allergenen:</h3>
                                                @foreach($recipe->allergens as $allergen)
                                                    <span class="inline-block bg-red-100 rounded-lg px-4 py-2 mr-2 mb-2">{{ formatAllergen($allergen) }}</span>
                                                @endforeach
                                            @endif
                                            
                                            @if(!empty($recipe->description))
                                                <h3 class="font-semibold text-xl mt-8 mb-2">Omschrijving:</h3>
                                                <p>
                                                    {{ $recipe->description }}
                                                </p>
                                            @endif

                                            @if(!empty($recipe->tips))
                                                <h3 class="font-semibold text-xl mt-8 mb-2">Tips:</h3>
                                                <p>
                                                    {{ $recipe->tips }}
                                                </p>
                                            @endif

                                            @if(!empty($recipeUserRemark))
                                                <h3 class="font-semibold text-xl mt-8 mb-2">Extra opmerking voor jou:</h3>
                                                <p>
                                                    {{ $recipeUserRemark }}
                                                </p>
                                            @endif

                                            <div class="grid grid-cols-1 lg:grid-cols-12 mt-8 gap-8">
                                                <div class="col-span-1 lg:col-span-3">
                                                    <h3 class="font-semibold text-xl mb-4">Ingrediënten</h3>

                                                    <ul class="divide-y-2 divide-dashed flex flex-col">
                                                        @foreach($recipe->ingredients as $ingredient)
                                                            <li class="inline-flex items-center py-2" x-data="{ checked: false }" :class="{ 'line-through': checked }">
                                                                <input type="checkbox" class="mr-2" x-model="checked">

                                                                <div x-on:click="checked = !checked" class="cursor-pointer">
                                                                    <strong>{{ $ingredient['amount'] }}</strong>
                                                                    <span>{{ $ingredient['name'] }}</span>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>

                                                <div class="col-span-1 lg:col-span-9">
                                                    <h3 class="font-semibold text-xl mb-4">Bereiding:</h3>

                                                    <ul class="list-decimal pl-4">
                                                        @foreach($recipe->steps as $step)
                                                            <li class="mb-4">
                                                                {{ $step['description'] }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</x-dashboard-layout>