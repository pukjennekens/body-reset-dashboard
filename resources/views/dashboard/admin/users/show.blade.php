@extends('components.dashboard-user-layout', ['user' => $user])

@section('content')
    @livewire('forms.user-personal-info', ['id' => $user->id])
@endsection