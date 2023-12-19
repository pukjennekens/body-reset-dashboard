<?php

namespace App\Livewire;

use App\Models\Branch;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class BranchTable extends PowerGridComponent
{
    use WithExport;

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
        if(auth()->user()->hasRole('admin')) return Branch::query();
        if(auth()->user()->hasRole('manager')) return Branch::query()->whereIn('id', auth()->user()->manager_branches);

        return Branch::query()->where('id', 0);
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('phone_number')
            ->addColumn('address', fn(Branch $branch) => $branch->street_name . ' ' . $branch->house_number)
            ->addColumn('postal_code')
            ->addColumn('city')
            ->addColumn('country', fn(Branch $branch) => $branch->getCountry())
            ->addColumn('province');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Naam', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Telefoonnummer', 'phone_number')
                ->sortable()
                ->searchable(),

            Column::make('Adres', 'address')
                ->sortable()
                ->searchable(),

            Column::make('Postcode', 'postal_code')
                ->sortable()
                ->searchable(),

            Column::make('Plaatsnaam', 'city')
                ->sortable()
                ->searchable(),

            Column::make('Land', 'country')
                ->sortable()
                ->searchable(),

            Column::make('Provincie', 'province')
                ->sortable()
                ->searchable(),

            Column::action('Acties')
        ];
    }

    #[On('branch-created')]
    #[On('branch-updated')]
    #[On('branch-deleted')]
    public function updatingBranchTable(): void
    {
        $this->refresh();
    }

    public function actions(\App\Models\Branch $row): array
    {
        return [
            Button::add('show-branch')  
                ->slot('<i class="fas fa-eye"></i>')
                ->class('text-xs bg-primary text-white p-2 rounded-md hover:bg-green-700')
                ->route('dashboard.admin.settings.branches.show', ['id' => $row->id]),
            Button::add('delete-branch')  
                ->slot('<i class="fas fa-trash"></i>')
                ->class('text-xs bg-red-500 text-white p-2 rounded-md hover:bg-red-700')
                ->openModal('delete-branch', ['id' => $row->id])
                ->can(auth()->user()->hasRole('admin')),
        ];
    }
}
