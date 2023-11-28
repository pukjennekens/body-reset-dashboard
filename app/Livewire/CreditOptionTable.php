<?php

namespace App\Livewire;

use App\Models\CreditOption;
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

final class CreditOptionTable extends PowerGridComponent
{
    public string $sortField     = 'sort_order';
    public string $sortDirection = 'asc';

    public function setUp(): array
    {
        return [
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return CreditOption::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('price', fn (CreditOption $model) => '€ ' . number_format($model->price, 2, ',', '.') )
            ->addColumn('expiration_days')
            ->addColumn('credits')
            ->addColumn('is_active', fn (CreditOption $model) => $model->is_active ? '<i class="fa-solid fa-check"></i></span>' : '<i class="fa-solid fa-times"></i></span>')
            ->addColumn('sort_order')
            ->addColumn('created_at_formatted', fn (CreditOption $model) => Carbon::parse($model->created_at)->format('d-m-Y H:i'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Naam', 'name'),
            Column::make('Prijs', 'price'),
            Column::make('Verlooptijd', 'expiration_days'),
            Column::make('Aantal credits', 'credits'),
            Column::make('Actief', 'is_active'),
            Column::make('Sorteer volgorde', 'sort_order'),
            Column::make('Aangemaakt op', 'created_at_formatted', 'created_at'),
            Column::action('Acties'),
        ];
    }

    public function actions(CreditOption $row): array
    {
        return [
            Button::add('edit-credit-plan')
                ->slot('<i class="fas fa-edit"></i>')
                ->class('text-xs bg-primary text-white p-2 rounded-md hover:bg-green-600')
                ->openModal('forms.new-credit-option', ['id' => $row->id]),
            Button::add('delete-credit-plan')  
                ->slot('<i class="fas fa-trash"></i>')
                ->class('text-xs bg-red-500 text-white p-2 rounded-md hover:bg-red-700')
                ->openModal('delete-credit-option', ['id' => $row->id]),
        ];
    }

    public function filters(): array
    {
        return [];
    }

    #[\Livewire\Attributes\On('credit-option-created')]
    #[\Livewire\Attributes\On('credit-option-updated')]
    #[\Livewire\Attributes\On('credit-option-deleted')]
    public function refreshCreditOptions(): void
    {
        $this->refresh();
    }
}
