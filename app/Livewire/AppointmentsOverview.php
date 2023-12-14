<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class AppointmentsOverview extends Component
{
    public User $user;

    public function mount($userId)
    {
        $this->user = User::find($userId);

        if(!$this->user) abort(404);
    }

    public function render()
    {
        return view('livewire.appointments-overview');
    }
}
