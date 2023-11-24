<x-dashboard-layout>
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-2xl font-semibold mb-2">
            Recepten
        </h2>

        <button class="rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600" x-data="" x-on:click.prevent="$dispatch('open-modal', 'new-recipe')">
            <i class="fas fa-plus"></i>
        </button>
    </div>

    <x-modal name="new-recipe" focusable show>
        <x-slot name="title">
            Nieuw recept toevoegen
        </x-slot>

        <div x-data="{ tab: 'general' }">
            <div class="border-b flex my-4"> 
                <button class="px-2 py-1 inline-flex items-center gap-2 hover:bg-gray-200" :class="tab == 'general' && 'border-b border-primary'" x-on:click.prevent="tab = 'general'">
                    <i class="fas fa-info"></i>
                    Algemeen
                </button>
                <button class="px-2 py-1 inline-flex items-center gap-2 hover:bg-gray-200" :class="tab == 'allergens' && 'border-b border-primary'" x-on:click.prevent="tab = 'allergens'">
                    <i class="fa-solid fa-star-of-life"></i>
                    Allergenen
                </button>
                <button class="px-2 py-1 inline-flex items-center gap-2 hover:bg-gray-200" :class="tab == 'ingredients' && 'border-b border-primary'" x-on:click.prevent="tab = 'ingredients'">
                    <i class="fa-solid fa-basket-shopping"></i>
                    Ingrediënten
                </button>
                <button class="px-2 py-1 inline-flex items-center gap-2 hover:bg-gray-200" :class="tab == 'preparation' && 'border-b border-primary'" x-on:click.prevent="tab = 'preparation'">
                    <i class="fa-solid fa-kitchen-set"></i>
                    Bereiden
                </button>
            </div>

            <div class="space-y-4" x-show="tab === 'general'" x-transition>
                <h3 class="text-xl font-semibold mb-2">Algemeen</h3>

                <x-input.text name="name" label="Naam" />

                <x-input.select name="meal_type" label="Soort maaltijd">
                    <option value="breakfast">Ontbijt</option>
                    <option value="lunch">Lunch</option>
                    <option value="dinner">Diner</option>
                    <option value="snack">Snack</option>
                </x-input.select>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-input.text name="prep_time" label="Bereidingstijd (in minuten)" />
                    <x-input.text name="number_of_people" label="Aantal personen" />
                </div>

                <x-input.textarea name="description" label="Omschrijving" />
                <x-input.textarea name="tip" label="Tip" />
            </div>

            <div class="space-y-1" x-show="tab === 'allergens'" x-transition>
                <h3 class="text-xl font-semibold mb-2">Allergenen</h3>
                <x-input.checkbox name="allergens" label="Gluten" value="gluten" />
                <x-input.checkbox name="allergens" label="Schaaldieren" value="crustaceans" />
                <x-input.checkbox name="allergens" label="Eieren" value="eggs" />
                <x-input.checkbox name="allergens" label="Vis" value="fish" />
                <x-input.checkbox name="allergens" label="Pinda's" value="peanuts" />
                <x-input.checkbox name="allergens" label="Soja" value="soybeans" />
                <x-input.checkbox name="allergens" label="Melk" value="milk" />
                <x-input.checkbox name="allergens" label="Noten" value="nuts" />
                <x-input.checkbox name="allergens" label="Selderij" value="celery" />
                <x-input.checkbox name="allergens" label="Mosterd" value="mustard" />
                <x-input.checkbox name="allergens" label="Sesam" value="sesame" />
                <x-input.checkbox name="allergens" label="Sulfieten" value="sulfur_dioxide" />
                <x-input.checkbox name="allergens" label="Lupines" value="lupin" />
                <x-input.checkbox name="allergens" label="Weekdieren" value="molluscs" />
            </div>

            <div class="space-y-4" x-show="tab === 'ingredients'" x-transition x-data="{ ingredients: [] }">
                <h3 class="text-xl font-semibold mb-2">Ingrediënten</h3>

                <x-input.hidden name="ingredients" label="" x-model="ingredients" />

                <template x-for="(ingredient, index) in ingredients" :key="index">
                    <div class="flex space-x-4 items-center">
                        <input type="text" x-model="ingredient.amount" placeholder="Hoeveelheid" class="rounded-lg px-4 py-1.5 border border-gray-600 disabled:bg-gray-200 w-1/3">
                        <input type="text" x-model="ingredient.name" placeholder="Ingrediënt" class="rounded-lg px-4 py-1.5 border border-gray-600 disabled:bg-gray-200 w-2/3">
                        <button @click="ingredients.splice(index, 1);" class="text-red-500"><i class="fas fa-trash"></i></button>
                    </div>
                </template>

                <button @click="ingredients.push({ amount: '', name: '' })" class="rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600"><i class="fas fa-plus"></i> Ingrediënt toevoegen</button>
            </div>

            <div class="space-y-4" x-show="tab === 'preparation'" x-transition x-data="{ steps: [] }">
                <h3 class="text-xl font-semibold mb-2">Bereiden</h3>

                {{-- Same kind of repeater but only step textarea --}}
                <x-input.hidden name="steps" label="" x-model="steps" />

                <template x-for="(step, index) in steps" :key="index">
                    <div class="flex space-x-4 items-center">
                        <textarea type="text" x-model="step" placeholder="Stap omschrijving" class="rounded-lg px-4 py-1.5 border border-gray-600 disabled:bg-gray-200 w-full">
                        </textarea>
                        <button @click="steps.splice(index, 1)" class="text-red-500"><i class="fas fa-trash"></i></button>
                    </div>
                </template>

                <button @click="steps.push('')" class="rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600"><i class="fas fa-plus"></i> Stap toevoegen</button>
            </div>
        </div>

        <hr class="my-4 border-black">

        <div>
            <button type="submit" class="rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600"><i class="fas fa-save"></i> Opslaan</button>
        </div>
    </x-modal>

    <livewire:recipe-table />
</x-dashboard-layout>