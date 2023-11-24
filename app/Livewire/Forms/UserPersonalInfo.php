<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class UserPersonalInfo extends Component
{
    public UserPersonalInfoForm $form;

    public User $user;

    public $editing = false;

    public function mount($id = null)
    {
        $this->user = User::find($id) ?? new User();
    }

    public function updatePersonalInfo()
    {
        if(!$this->editing) return;

        $this->validate();

        $this->user->update($this->form->toArray());

        $this->editing = false;

        $this->dispatch('user-updated', id: $this->user->id);
    }

    public function toggleEditing()
    {
        $this->editing = ! $this->editing;
    }

    public function cancelEditing()
    {
        $this->editing = false;
        $this->form->fill($this->user->toArray());
    }

    public function render()
    {
        return view('livewire.forms.user-personal-info', [
            'user' => $this->user,
        ]);
    }
}
