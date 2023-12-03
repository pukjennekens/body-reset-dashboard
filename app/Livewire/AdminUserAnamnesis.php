<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class AdminUserAnamnesis extends Component
{
    public User $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    #[On('anamnesis-created')]
    #[On('anamnesis-updated')]
    #[On('anamnesis-deleted')]
    public function refreshAnamnesis()
    {
        $this->user->refresh();
    }

    public function render()
    {
        return view('livewire.admin-user-anamnesis');
    }
}
