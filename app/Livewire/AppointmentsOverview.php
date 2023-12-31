<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\On;

class AppointmentsOverview extends Component
{
    public User $user;

    public function mount($userId)
    {
        $this->user = User::find($userId);

        if(!$this->user) abort(404);
    }

    #[On('appointment-created')]
    #[On('appointment-updated')]
    #[On('appointment-deleted')]
    public function refreshAppointments()
    {
        $this->user->refresh();
    }

    public function render()
    {
        return view('livewire.appointments-overview');
    }
}
