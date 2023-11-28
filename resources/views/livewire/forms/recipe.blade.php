<form wire:submit="createRecipe">
    <div x-data="{ tab: 'general' }">
        <div class="border-b flex flex-col sm:flex-row mb-4"> 
            <button class="px-2 py-1 inline-flex items-center gap-2 hover:bg-gray-200" :class="tab == 'general' && 'sm:border-b sm:border-primary bg-gray-200 sm:bg-white'" x-on:click.prevent="tab = 'general'">
                <i class="fas fa-info"></i>
                Algemeen
            </button>
            <button class="px-2 py-1 inline-flex items-center gap-2 hover:bg-gray-200" :class="tab == 'allergens' && 'sm:border-b sm:border-primary bg-gray-200 sm:bg-white'" x-on:click.prevent="tab = 'allergens'">
                <i class="fa-solid fa-star-of-life"></i>
                Allergenen
            </button>
            <button class="px-2 py-1 inline-flex items-center gap-2 hover:bg-gray-200" :class="tab == 'ingredients' && 'sm:border-b sm:border-primary bg-gray-200 sm:bg-white'" x-on:click.prevent="tab = 'ingredients'">
                <i class="fa-solid fa-basket-shopping"></i>
                Ingrediënten
            </button>
            <button class="px-2 py-1 inline-flex items-center gap-2 hover:bg-gray-200" :class="tab == 'preparation' && 'sm:border-b sm:border-primary bg-gray-200 sm:bg-white'" x-on:click.prevent="tab = 'preparation'">
                <i class="fa-solid fa-kitchen-set"></i>
                Bereiden
            </button>
        </div>

        <div class="space-y-4" x-show="tab === 'general'" x-transition>
            <h3 class="text-xl font-semibold mb-2">Algemeen</h3>

            <x-input.text name="form.name" label="Naam" value="{{ old('form.name', $recipe ? $recipe->name : '') }}" />

            <x-input.select name="form.meal_type" label="Soort maaltijd">
                <option value="breakfast" {{ old('form.meal_type', $recipe ? $recipe->meal_type : '') == 'breakfast' ? 'selected' : '' }}>Ontbijt</option>
                <option value="lunch" {{ old('form.meal_type', $recipe ? $recipe->meal_type : '') == 'lunch' ? 'selected' : '' }}>Lunch</option>
                <option value="dinner" {{ old('form.meal_type', $recipe ? $recipe->meal_type : '') == 'dinner' ? 'selected' : '' }}>Diner</option>
                <option value="snack" {{ old('form.meal_type', $recipe ? $recipe->meal_type : '') == 'snack' ? 'selected' : '' }}>Snack</option>
            </x-input.select>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-input.text name="form.prepation_time" label="Bereidingstijd (in minuten)" value="{{ old('form.prepation_time', $recipe ? $recipe->prepation_time : '') }}" />
                <x-input.text name="form.number_of_people" label="Aantal personen" value="{{ old('form.number_of_people', $recipe ? $recipe->number_of_people : '') }}" />
            </div>

            <x-input.textarea name="form.description" label="Omschrijving">
                {{ old('form.description', $recipe ? $recipe->description : '') }}
            </x-input.textarea>
            <x-input.textarea name="form.tips" label="Tip">
                {{ old('form.tips', $recipe ? $recipe->tips : '') }}
            </x-input.textarea>
        </div>

        <div class="space-y-1" x-show="tab === 'allergens'" x-transition>
            <h3 class="text-xl font-semibold mb-2">Allergenen</h3>

            <div class="flex flex-col">
                @foreach($allergensOptions as $key => $option)
                    <label class="inline-flex items-center">
                        <input type="checkbox" wire:model.fill="allergens" value="{{ $key }}" @if(in_array($key, old('allergens', $recipe ? $recipe->allergens : []))) checked @endif>
                        <span class="ml-2 text-sm">{{ __($option) }}</span>
                    </label>
                @endforeach
            </div>
        </div>


        <div class="space-y-4" x-data="{ ingredients: @entangle('ingredients') }" x-show="tab === 'ingredients'" x-transition>
            <h3 class="text-xl font-semibold mb-2">Ingrediënten</h3>

            @error('ingredients') <div><span class="text-red-500 text-sm">{{ $message }}</span></div> @enderror 

            <template x-for="(ingredient, index) in ingredients" :key="index">
                <div class="flex space-x-4 items-center">
                    <input type="text" x-model="ingredient.amount" placeholder="Hoeveelheid" class="rounded-lg px-4 py-1.5 border border-gray-600 disabled:bg-gray-200 w-1/3">
                    <input type="text" x-model="ingredient.name" placeholder="Ingrediënt" class="rounded-lg px-4 py-1.5 border border-gray-600 disabled:bg-gray-200 w-2/3">
                    <button @click="ingredients.splice(index, 1);" class="text-red-500"><i class="fas fa-trash"></i></button>
                </div>
            </template>

            <button type="button" @click="ingredients.push({ amount: '', name: '' });" class="rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600"><i class="fas fa-plus"></i> Ingrediënt toevoegen</button>
        </div>

        <div class="space-y-4" x-data="{ steps: @entangle('steps') }" x-show="tab === 'preparation'" x-init="console.log(steps)" x-transition>
            <h3 class="text-xl font-semibold mb-2">Bereiden</h3>

            @error('steps') <div><span class="text-red-500 text-sm">{{ $message }}</span></div> @enderror 

            <template x-for="(step, index) in steps" :key="index">
                <div class="flex space-x-4 items-center">
                    <input type="text" x-model="step.description" placeholder="Stap omschrijving" class="rounded-lg px-4 py-1.5 border border-gray-600 disabled:bg-gray-200 w-full"></textarea>
                    <button @click="steps.splice(index, 1);" class="text-red-500"><i class="fas fa-trash"></i></button>
                </div>
            </template>

            <button type="button" @click="steps.push({description: ''});" class="rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600"><i class="fas fa-plus"></i> Stap toevoegen</button>
        </div>
    </div>

    <hr class="my-4 border-black">

    <div>
        <button type="submit" class="rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600"><i class="fas fa-save"></i> Opslaan</button>
    </div>
</form wire:submit="createGirthMeasurement">