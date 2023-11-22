<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\On;

class UserProfileInfo extends Component
{
    public $user;

    public function mount($id)
    {
        $this->user = User::find($id);
    }

    #[On('user-updated')]
    public function updateUser($id)
    {
        if($this->user->id == $id)
            $this->user = User::find($id);
    }

    public function render()
    {
        return view('livewire.user-profile-info');
    }
}
