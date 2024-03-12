<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class UserAppointmentsOverview extends Component
{
    public $appointments;

    public $user;

    public function mount($userId)
    {
        $this->user = User::findOrFail($userId);
        $this->appointments = $this->user->appointments->sortByDesc('start');
    }

    #[On('appointment-created')]
    #[On('appointment-updated')]
    #[On('appointment-deleted')]
    public function refreshAppointments()
    {
        $this->appointments = $this->user->appointments;
    }

    public function render()
    {
        return view('livewire.user-appointments-overview', [
            'appointments' => $this->appointments,
        ]);
    }
}
