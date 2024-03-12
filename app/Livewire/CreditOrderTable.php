<?php

namespace App\Livewire;

use App\Models\CreditOrder;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
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

final class CreditOrderTable extends PowerGridComponent
{
    use WithExport;

    public int $perPage = 25;

    public function setUp(): array
    {
        return [
            Footer::make()
                ->showPerPage($this->perPage)
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return CreditOrder::query()
            ->with('user')
            ->with('creditOption')
            ->orderBy('id', 'desc');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('user_name', fn(CreditOrder $creditOrder) => $creditOrder->user ? $creditOrder->user->name : 'Niet gevonden')
            ->addColumn('credit_option_name', fn(CreditOrder $creditOrder) => $creditOrder->creditOption->name)
            ->addColumn('status')
            ->addColumn('price', fn(CreditOrder $creditOrder) => $creditOrder->currency . ' ' . number_format($creditOrder->price, 2))
            ->addColumn('payment_id');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Gebruiker', 'user_name', 'user.name'),
            Column::make('Credit pakket', 'credit_option_name', 'creditOption.name'),

            Column::make('Mollie status', 'status')
                ->sortable()
                ->searchable(),

            Column::make('Prijs', 'price')
                ->sortable()
                ->searchable(),

            Column::make('Mollie ID', 'payment_id')
                ->sortable()
                ->searchable(),
        ];
    }
}
