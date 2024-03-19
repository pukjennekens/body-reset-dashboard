<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use App\Livewire\Forms\ResetPasswordTokenForm;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Log;

class ResetPasswordToken extends Component
{
    public ResetPasswordTokenForm $form;

    public $submitted = false;
    public $token;

    public function mount($token)
    {
        $this->token = $token;
    }

    public function resetPassword()
    {
        $this->validate();

        $status = Password::reset(
            $this->form->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => $password,
                ])->save();

                event(new PasswordReset($user));
            }
        );

        
        if ($status == Password::PASSWORD_RESET) {
            $this->submitted = true;
        } else {
            $this->addError('form.email', 'Fout bij het resetten van het wachtwoord, het kan zijn dat uw token verlopen is. Vraag een nieuwe token aan en probeer het opnieuw binnen de aangegeven tijd in de e-mail.');
        }
    }

    public function render()
    {
        return view('livewire.forms.reset-password-token');
    }
}
