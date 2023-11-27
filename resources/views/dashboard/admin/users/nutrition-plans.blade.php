@extends('components.dashboard-user-layout', ['user' => $user])

@section('content')
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-2xl font-semibold">
            Voedingsschema's:
        </h3>

        <button class="rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600" x-data="" x-on:click.prevent="$dispatch('openModal', {component: 'forms.nutrition-plan'})">
            <i class="fas fa-plus"></i>
        </button>
    </div>
@endsection