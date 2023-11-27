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
        $this->showCheckBox();

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
        return PowerGrid::columns();
    }

    public function columns(): array
    {
        return [
            Column::add()
                ->title(__('Name'))
                ->field('name')
                ->searchable()
                ->sortable(),
            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    #[\Livewire\Attributes\On('recipe-created')]
    public function recipeCreated(): void
    {
        $this->refresh();
    }

    #[\Livewire\Attributes\On('delete-recipe')]
    public function deleteRecipe($id): void
    {
        $recipe = Recipe::find($id);
        $recipe->delete();
        $this->refresh();
    }

    public function actions(\App\Models\Recipe $row): array
    {
        return [
            Button::add('show-recipe')  
                ->slot('<i class="fas fa-edit"></i>')
                ->class('rounded-lg px-4 py-1.5 border-0 bg-primary text-sm text-white uppercase font-semibold hover:bg-green-600')
                ->dispatch('edit', ['id' => $row->id]),
            Button::add('delete-recipe')
                ->slot('<i class="fas fa-trash"></i>')
                ->class('rounded-lg px-4 py-1.5 border-0 bg-red-500 text-sm text-white uppercase font-semibold hover:bg-green-600')
                ->dispatch('delete-recipe', ['id' => $row->id]),
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
