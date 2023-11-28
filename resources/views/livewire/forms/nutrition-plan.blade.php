<form wire:submit="createNutritionPlan" x-data="{ tab: 'general' }">
    <div class="grid grid-cols-12">
        <div class="col-span-3">
            <ul class="flex flex-col border-r pb-4 h-full">
                <li class="px-2 py-1 hover:bg-gray-200 cursor-pointer" x-on:click="tab = 'general'" :class="tab == 'general' && 'border-r-2 border-primary'">Algemeen</li>
                <li class="px-2 py-1 hover:bg-gray-200 cursor-pointer" x-on:click="tab = 'monday'" :class="tab == 'monday' && 'border-r-2 border-primary'">Maandag</li>
                <li class="px-2 py-1 hover:bg-gray-200 cursor-pointer" x-on:click="tab = 'tuesday'" :class="tab == 'tuesday' && 'border-r-2 border-primary'">Dinsdag</li>
                <li class="px-2 py-1 hover:bg-gray-200 cursor-pointer" x-on:click="tab = 'wednesday'" :class="tab == 'wednesday' && 'border-r-2 border-primary'">Woensdag</li>
                <li class="px-2 py-1 hover:bg-gray-200 cursor-pointer" x-on:click="tab = 'thursday'" :class="tab == 'thursday' && 'border-r-2 border-primary'">Donderdag</li>
                <li class="px-2 py-1 hover:bg-gray-200 cursor-pointer" x-on:click="tab = 'friday'" :class="tab == 'friday' && 'border-r-2 border-primary'">Vrijdag</li>
                <li class="px-2 py-1 hover:bg-gray-200 cursor-pointer" x-on:click="tab = 'saturday'" :class="tab == 'saturday' && 'border-r-2 border-primary'">Zaterdag</li>
                <li class="px-2 py-1 hover:bg-gray-200 cursor-pointer" x-on:click="tab = 'sunday'" :class="tab == 'sunday' && 'border-r-2 border-primary'">Zondag</li>
            </ul>
        </div>

        <div class="col-span-9 px-4">
            <div x-show="tab === 'general'" x-transition class="space-y-4 pb-4">
                <h3 class="text-xl font-semibold mb-2">Algemeen</h3>

                <x-input.date name="form.date" label="Datum" value="{{ old('form.date', $nutritionPlan ? $nutritionPlan->date->format('Y-m-d') : '') }}" />

                <x-input.textarea label="Opmerkingen" name="form.remark">
                    {{ old('form.remark', $nutritionPlan ? $nutritionPlan->remark : '') }}
                </x-input.textarea>

                <x-input.textarea label="Opmerkingen (intern)" name="form.remark_internal">
                    {{ old('form.remark_internal', $nutritionPlan ? $nutritionPlan->remark_internal : '') }}
                </x-input.textarea>
            </div>

            <div x-show="tab === 'monday'" x-transition class="space-y-4 pb-4" x-data="{ recipiesMonday: @entangle('recipies_monday') }">
                <h3 class="text-xl font-semibold mb-2">Maandag</h3>
                
                <x-input.textarea label="Opmerkingen" name="form.remark_monday">
                    {{ old('form.remark_monday', $nutritionPlan ? $nutritionPlan->remark_monday : '') }}
                </x-input.textarea>

                <template x-for="(recipe, index) in recipiesMonday" :key="index">
                    <div class="flex items-center gap-4">
                        <div class="inline-flex flex-col gap-2 w-full">
                            <select x-model="recipe.recipeId" placeholder="Hoeveelheid" class="rounded-lg px-4 py-1.5 border border-gray-600 disabled:bg-gray-200 w-full">
                                <option value="" disabled>Selecteer een recept</option>
                                @foreach ($recipies as $recipeId => $recipe)
                                    <option value="{{ $recipeId }}">{{ $recipe }}</option>
                                @endforeach
                            </select>

                            <textarea type="text" x-model="recipe.remark" placeholder="Ingrediënt" class="rounded-lg px-4 py-1.5 border border-gray-600 disabled:bg-gray-200 w-full"></textarea>
                        </div>

                        <button @click="recipiesMonday.splice(index, 1);" class="text-red-500"><i class="fas fa-trash"></i></button>
                    </div>
                </template>

                <button type="button" @click="recipiesMonday.push({ recipeId: '', remark: '' });" class="rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600"><i class="fas fa-plus"></i> Recept toevoegen</button>
            </div>

            <div x-show="tab === 'tuesday'" x-transition class="space-y-4 pb-4" x-data="{ recipiesTuesday: @entangle('recipies_tuesday') }">
                <h3 class="text-xl font-semibold mb-2">Dinsdag</h3>

                <x-input.textarea label="Opmerkingen" name="form.remark_tuesday">
                    {{ old('form.remark_tuesday', $nutritionPlan ? $nutritionPlan->remark_tuesday : '') }}
                </x-input.textarea>

                <template x-for="(recipe, index) in recipiesTuesday" :key="index">
                    <div class="flex items-center gap-4">
                        <div class="inline-flex flex-col gap-2 w-full">
                            <select x-model="recipe.recipeId" placeholder="Hoeveelheid" class="rounded-lg px-4 py-1.5 border border-gray-600 disabled:bg-gray-200 w-full">
                                <option value="" disabled>Selecteer een recept</option>
                                @foreach ($recipies as $recipeId => $recipe)
                                    <option value="{{ $recipeId }}">{{ $recipe }}</option>
                                @endforeach
                            </select>

                            <textarea type="text" x-model="recipe.remark" placeholder="Ingrediënt" class="rounded-lg px-4 py-1.5 border border-gray-600 disabled:bg-gray-200 w-full"></textarea>
                        </div>

                        <button @click="recipiesTuesday.splice(index, 1);" class="text-red-500"><i class="fas fa-trash"></i></button>
                    </div>
                </template>

                <button type="button" @click="recipiesTuesday.push({ recipeId: '', remark: '' });" class="rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600"><i class="fas fa-plus"></i> Recept toevoegen</button>
            </div>

            <div x-show="tab === 'wednesday'" x-transition class="space-y-4 pb-4" x-data="{ recipiesWednesday: @entangle('recipies_wednesday') }">
                <h3 class="text-xl font-semibold mb-2">Woensdag</h3>

                <x-input.textarea label="Opmerkingen" name="form.remark_wednesday">
                    {{ old('form.remark_wednesday', $nutritionPlan ? $nutritionPlan->remark_wednesday : '') }}
                </x-input.textarea>

                <template x-for="(recipe, index) in recipiesWednesday" :key="index">
                    <div class="flex items-center gap-4">
                        <div class="inline-flex flex-col gap-2 w-full">
                            <select x-model="recipe.recipeId" placeholder="Hoeveelheid" class="rounded-lg px-4 py-1.5 border border-gray-600 disabled:bg-gray-200 w-full">
                                <option value="" disabled>Selecteer een recept</option>
                                @foreach ($recipies as $recipeId => $recipe)
                                    <option value="{{ $recipeId }}">{{ $recipe }}</option>
                                @endforeach
                            </select>

                            <textarea type="text" x-model="recipe.remark" placeholder="Ingrediënt" class="rounded-lg px-4 py-1.5 border border-gray-600 disabled:bg-gray-200 w-full"></textarea>
                        </div>

                        <button @click="recipiesWednesday.splice(index, 1);" class="text-red-500"><i class="fas fa-trash"></i></button>
                    </div>
                </template>

                <button type="button" @click="recipiesWednesday.push({ recipeId: '', remark: '' });" class="rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600"><i class="fas fa-plus"></i> Recept toevoegen</button>
            </div>

            <div x-show="tab === 'thursday'" x-transition class="space-y-4 pb-4" x-data="{ recipiesThursday: @entangle('recipies_thursday') }">
                <h3 class="text-xl font-semibold mb-2">Donderdag</h3>

                <x-input.textarea label="Opmerkingen" name="form.remark_thursday">
                    {{ old('form.remark_thursday', $nutritionPlan ? $nutritionPlan->remark_thursday : '') }}
                </x-input.textarea>

                <template x-for="(recipe, index) in recipiesThursday" :key="index">
                    <div class="flex items-center gap-4">
                    <div class="inline-flex flex-col gap-2 w-full">
                        <select x-model="recipe.recipeId" placeholder="Hoeveelheid" class="rounded-lg px-4 py-1.5 border border-gray-600 disabled:bg-gray-200 w-full">
                        <option value="" disabled>Selecteer een recept</option>
                        @foreach ($recipies as $recipeId => $recipe)
                            <option value="{{ $recipeId }}">{{ $recipe }}</option>
                        @endforeach
                        </select>

                        <textarea type="text" x-model="recipe.remark" placeholder="Ingrediënt" class="rounded-lg px-4 py-1.5 border border-gray-600 disabled:bg-gray-200 w-full"></textarea>
                    </div>

                    <button @click="recipiesThursday.splice(index, 1);" class="text-red-500"><i class="fas fa-trash"></i></button>
                    </div>
                </template>

                <button type="button" @click="recipiesThursday.push({ recipeId: '', remark: '' });" class="rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600"><i class="fas fa-plus"></i> Recept toevoegen</button>
            </div>

            <div x-show="tab === 'friday'" x-transition class="space-y-4 pb-4" x-data="{ recipiesFriday: @entangle('recipies_friday') }">
                <h3 class="text-xl font-semibold mb-2">Vrijdag</h3>

                <x-input.textarea label="Opmerkingen" name="form.remark_friday">
                    {{ old('form.remark_friday', $nutritionPlan ? $nutritionPlan->remark_friday : '') }}
                </x-input.textarea>

                <template x-for="(recipe, index) in recipiesFriday" :key="index">
                    <div class="flex items-center gap-4">
                    <div class="inline-flex flex-col gap-2 w-full">
                        <select x-model="recipe.recipeId" placeholder="Hoeveelheid" class="rounded-lg px-4 py-1.5 border border-gray-600 disabled:bg-gray-200 w-full">
                        <option value="" disabled>Selecteer een recept</option>
                        @foreach ($recipies as $recipeId => $recipe)
                            <option value="{{ $recipeId }}">{{ $recipe }}</option>
                        @endforeach
                        </select>

                        <textarea type="text" x-model="recipe.remark" placeholder="Ingrediënt" class="rounded-lg px-4 py-1.5 border border-gray-600 disabled:bg-gray-200 w-full"></textarea>
                    </div>

                    <button @click="recipiesFriday.splice(index, 1);" class="text-red-500"><i class="fas fa-trash"></i></button>
                    </div>
                </template>

                <button type="button" @click="recipiesFriday.push({ recipeId: '', remark: '' });" class="rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600"><i class="fas fa-plus"></i> Recept toevoegen</button>
            </div>

            <div x-show="tab === 'saturday'" x-transition class="space-y-4 pb-4" x-data="{ recipiesSaturday: @entangle('recipies_saturday') }">
                <h3 class="text-xl font-semibold mb-2">Zaterdag</h3>

                <x-input.textarea label="Opmerkingen" name="form.remark_saturday">
                    {{ old('form.remark_saturday', $nutritionPlan ? $nutritionPlan->remark_saturday : '') }}
                </x-input.textarea>

                <template x-for="(recipe, index) in recipiesSaturday" :key="index">
                    <div class="flex items-center gap-4">
                    <div class="inline-flex flex-col gap-2 w-full">
                        <select x-model="recipe.recipeId" placeholder="Hoeveelheid" class="rounded-lg px-4 py-1.5 border border-gray-600 disabled:bg-gray-200 w-full">
                        <option value="" disabled>Selecteer een recept</option>
                        @foreach ($recipies as $recipeId => $recipe)
                            <option value="{{ $recipeId }}">{{ $recipe }}</option>
                        @endforeach
                        </select>

                        <textarea type="text" x-model="recipe.remark" placeholder="Ingrediënt" class="rounded-lg px-4 py-1.5 border border-gray-600 disabled:bg-gray-200 w-full"></textarea>
                    </div>

                    <button @click="recipiesSaturday.splice(index, 1);" class="text-red-500"><i class="fas fa-trash"></i></button>
                    </div>
                </template>

                <button type="button" @click="recipiesSaturday.push({ recipeId: '', remark: '' });" class="rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600"><i class="fas fa-plus"></i> Recept toevoegen</button>
            </div>

            <div x-show="tab === 'sunday'" x-transition class="space-y-4 pb-4" x-data="{ recipiesSunday: @entangle('recipies_sunday') }">
                <h3 class="text-xl font-semibold mb-2">Zondag</h3>

                <x-input.textarea label="Opmerkingen" name="form.remark_sunday">
                    {{ old('form.remark_sunday', $nutritionPlan ? $nutritionPlan->remark_sunday : '') }}
                </x-input.textarea>

                <template x-for="(recipe, index) in recipiesSunday" :key="index">
                    <div class="flex items-center gap-4">
                    <div class="inline-flex flex-col gap-2 w-full">
                        <select x-model="recipe.recipeId" placeholder="Hoeveelheid" class="rounded-lg px-4 py-1.5 border border-gray-600 disabled:bg-gray-200 w-full">
                        <option value="" disabled>Selecteer een recept</option>
                        @foreach ($recipies as $recipeId => $recipe)
                            <option value="{{ $recipeId }}">{{ $recipe }}</option>
                        @endforeach
                        </select>

                        <textarea type="text" x-model="recipe.remark" placeholder="Ingrediënt" class="rounded-lg px-4 py-1.5 border border-gray-600 disabled:bg-gray-200 w-full"></textarea>
                    </div>

                    <button @click="recipiesSunday.splice(index, 1);" class="text-red-500"><i class="fas fa-trash"></i></button>
                    </div>
                </template>

                <button type="button" @click="recipiesSunday.push({ recipeId: '', remark: '' });" class="rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600"><i class="fas fa-plus"></i> Recept toevoegen</button>
            </div>
        </div>
    </div>

    <hr>

    <div class="flex justify-end mt-4">
        <button type="submit" class="rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600"><i class="fas fa-save"></i> Opslaan</button>
    </div>
</form>