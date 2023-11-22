@extends('components.dashboard-user-layout', ['user' => $user])

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-2xl font-semibold">
            Lichaamssamenstelling metingen:
        </h3>

        <button class="rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600" x-data="" x-on:click.prevent="$dispatch('open-modal', 'new-body-composition-measurement')">
            <i class="fas fa-plus"></i>
        </button>

        <x-modal name="new-body-composition-measurement" focusable>
            <x-slot name="title">
                Nieuwe lichaamssamenstelling meting invoeren voor {{ $user->name }}
            </x-slot>

            @livewire('forms.new-body-composition-measurement', ['id' => $user->id])
        </x-modal>
    </div>

    @livewire('body-composition-measurements-table', ['id' => $user->id])

    <div class="flex items-center justify-between mb-4 mt-12">
        <h3 class="text-2xl font-semibold">
            Omtrek metingen:
        </h3>

        <button class="rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600" x-data="" x-on:click.prevent="$dispatch('open-modal', 'new-girth-measurement')">
            <i class="fas fa-plus"></i>
        </button>

        <x-modal name="new-girth-measurement" focusable>
            <x-slot name="title">
                Nieuwe omtrek meting invoeren voor {{ $user->name }}
            </x-slot>

            @livewire('forms.new-girth-measurement', ['id' => $user->id])
        </x-modal>
    </div>

    @livewire('girth-measurements-table', ['id' => $user->id])
@endsection