@extends('components.dashboard-user-layout', ['user' => $user])

@section('content')
    <h3 class="text-2xl font-semibold mb-4">
        Afspraken:
    </h3>

    @livewire('user-appointments-overview', ['userId' => $user->id])
@endsection