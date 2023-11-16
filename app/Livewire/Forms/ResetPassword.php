<?php

namespace App\Livewire\Forms;

use Livewire\Component;

class ResetPassword extends Component
{
    public ResetPasswordForm $form;

    public function resetPassword()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.forms.reset-password');
    }
}
