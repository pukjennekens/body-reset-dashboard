<?php

namespace App\Livewire;

use App\Models\Recipe;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class RecipeTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        return [
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Recipe::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('prepation_time', function(Recipe $recipe) {
                $hours   = floor($recipe->prepation_time / 60);
                $minutes = $recipe->prepation_time % 60;
                return sprintf('%02d:%02d', $hours, $minutes);
            })
            ->addColumn('allergens', function(Recipe $recipe) {
                $allergensOptions = [
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

                $allergens = array_map(function($allergen) use ($allergensOptions) {
                    return $allergensOptions[$allergen];
                }, $recipe->allergens);

                if (count($allergens) > 3) {
                    $allergens = array_slice($allergens, 0, 3);
                    $allergens[] = '...';
                }

                return implode(', ', $allergens);
            });
    }

    public function columns(): array
    {
        return [
            Column::add()
                ->title(__('Naam'))
                ->field('name')
                ->searchable()
                ->sortable(),
            Column::add()
                ->title(__('Bereidingstijd'))
                ->field('prepation_time'),
            Column::add()
                ->title(__('Aantal personen'))
                ->field('number_of_people'),
            Column::add()
                ->title(__('Allergenen'))
                ->field('allergens'),
            Column::action('Acties')
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    #[\Livewire\Attributes\On('recipe-created')]
    #[\Livewire\Attributes\On('recipe-updated')]
    #[\Livewire\Attributes\On('recipe-deleted')]
    public function recipeCreated(): void
    {
        $this->refresh();
    }

    public function actions(\App\Models\Recipe $row): array
    {
        return [
            Button::add('show-recipe')  
                ->slot('<i class="fas fa-edit"></i>')
                ->class('rounded-lg px-4 py-1.5 border-0 bg-primary text-sm text-white uppercase font-semibold hover:bg-green-600')
                ->openModal('forms.recipe', ['id' => $row->id]),
            Button::add('delete-recipe')
                ->slot('<i class="fas fa-trash"></i>')
                ->class('rounded-lg px-4 py-1.5 border-0 bg-red-500 text-sm text-white uppercase font-semibold hover:bg-red-700')
                ->openModal('delete-recipe', ['id' => $row->id]),
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
