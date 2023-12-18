<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class SubUsersOverview extends Component
{
    public $userId    = null;
    public $user = null;
    public $subUsers  = null;

    public function mount($userId)
    {
        $this->userId   = $userId;
        $this->user     = User::find($userId);
        $this->subUsers = $this->user->subUsers;
    }

    public function render()
    {
        return view('livewire.sub-users-overview');
    }
}
