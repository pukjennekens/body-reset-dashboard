@extends('components.dashboard-user-layout', ['user' => $user])

@section('content')
    <h3 class="text-2xl font-semibold mb-4">
        Bestellingen:
    </h3>

    @livewire('user-orders-overview', ['userId' => $user->id])
@endsection