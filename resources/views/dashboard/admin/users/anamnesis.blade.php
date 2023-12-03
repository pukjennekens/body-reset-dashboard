@extends('components.dashboard-user-layout', ['user' => $user])

@section('content')
    <h3 class="text-2xl font-semibold mb-4">
        Anamnese:
    </h3>

    @livewire('admin-user-anamnesis', ['user' => $user])
@endsection