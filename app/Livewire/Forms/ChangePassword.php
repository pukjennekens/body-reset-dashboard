<?php

namespace App\Livewire\Forms;

use Livewire\Component;

class ChangePassword extends Component
{
    public ChangePasswordForm $form;
    public $changed = false;

    public function changePassword()
    {
        $this->dispatch('notification', 'Password changed successfully!');
        $this->validate();

        auth()->user()->update([
            'password' => bcrypt($this->form->password)
        ]);

        $this->form->reset();
        $this->changed = true;
    }

    public function render()
    {
        return view('livewire.forms.change-password');
    }
}
