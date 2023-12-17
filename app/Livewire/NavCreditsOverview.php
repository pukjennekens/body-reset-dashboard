<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class NavCreditsOverview extends Component
{
    public User $user;

    public function mount()
    {
        $this->user = auth()->user();
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
        return view('livewire.nav-credits-overview');
    }
}
