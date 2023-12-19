<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class UserTable extends PowerGridComponent
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
        if(auth()->user()->hasRole('admin')) return User::query();
        if(auth()->user()->hasRole('manager')) return User::query()->whereIn('branch_id', auth()->user()->manager_branches)->where('role', '!=', 'admin')->where('role', '!=', 'manager');
        if(auth()->user()->hasRole('trainer')) return User::query()->where('trainer_user_id', auth()->user()->id)->where('role', '!=', 'admin')->where('role', '!=', 'manager')->where('role', '!=', 'trainer');

        return User::query()->where('id', 0);
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
            ->addColumn('email')
            ->addColumn('role', fn(User $model) => ucfirst($model->role))
            ->addColumn('created_at_formatted', fn (User $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable(),

            Column::make('Naam', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Type', 'role'),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable(),

            Column::action('Acties'),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('name')->operators(['contains']),
            Filter::inputText('email')->operators(['contains']),
        ];
    }

    public function actions(User $row): array
    {
        return [
            Button::add('show-user')  
                ->slot('<i class="fas fa-eye"></i>')
                ->class('rounded-lg px-4 py-1.5 border-0 bg-primary text-sm text-white uppercase font-semibold hover:bg-green-600')
                ->route('dashboard.admin.users.show', ['id' => $row->id]),
        ];
    }

    #[\Livewire\Attributes\On('user-created')]
    #[\Livewire\Attributes\On('user-updated')]
    #[\Livewire\Attributes\On('user-deleted')]
    public function userCreated(): void
    {
        $this->refresh();
    }
}
