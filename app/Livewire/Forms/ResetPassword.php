<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use App\Models\User;
use App\Notifications\ResetPassword as NotificationsResetPassword;

class ResetPassword extends Component
{
    public ResetPasswordForm $form;

    public $submitted = false;

    public function resetPassword()
    {
        $this->validate();

        $user = User::where('email', $this->form->email)->first();
        if($user) $user->notify(new NotificationsResetPassword($user, $user->createToken('reset-password')->plainTextToken));

        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.forms.reset-password');
    }
}
