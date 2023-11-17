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
        Log::debug('Resetting password', ['form' => $this->form]);
        $this->validate();
        Log::debug('Form validated', ['form' => $this->form]);

        $status = Password::reset(
            $this->form->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => $password,
                ])->save();

                event(new PasswordReset($user));
            }
        );

        Log::debug('Password reset status', ['status' => $status]);

        if ($status == Password::PASSWORD_RESET) {
            Log::debug('Password reset successful');
            $this->submitted = true;
        } else {
            Log::debug('Password reset failed', ['status' => $status]);
        }
    }

    public function render()
    {
        return view('livewire.forms.reset-password-token');
    }
}
