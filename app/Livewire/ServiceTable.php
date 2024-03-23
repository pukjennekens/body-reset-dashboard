<?php

namespace App\Livewire;

use App\Models\Service;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
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

final class ServiceTable extends PowerGridComponent
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
        return Service::query()->where('hidden', false);
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('appointment_duration_minutes')
            ->addColumn('appointment_overlap_minutes')
            ->addColumn('price');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Duur afspraak (minuten)', 'appointment_duration_minutes'),
            Column::make('Overlap afspraak (minuten)', 'appointment_overlap_minutes'),
            Column::make('Prijs (credits)', 'price')
                ->sortable()
                ->searchable(),

            Column::action('Acties')
        ];
    }

    #[On('service-created')]
    #[On('service-updated')]
    #[On('service-deleted')]
    public function updatingServiceTableGrid(): void
    {
        $this->refresh();
    }

    public function actions(\App\Models\Service $row): array
    {
        return [
            Button::add('edit-service')
                ->slot('<i class="fas fa-edit"></i>')
                ->class('text-xs bg-primary text-white p-2 rounded-md hover:bg-green-600')
                ->openModal('forms.service', ['id' => $row->id]),
            Button::add('delete-service')  
                ->slot('<i class="fas fa-trash"></i>')
                ->class('text-xs bg-red-500 text-white p-2 rounded-md hover:bg-red-700')
                ->openModal('delete-service', ['id' => $row->id]),
        ];
    }
}
