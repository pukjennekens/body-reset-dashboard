<?php

namespace App\Livewire\Forms;

use Livewire\Component;

class Login extends Component
{
    public LoginForm $form;

    public function login()
    {
        $this->validate();

        try {
            if (! auth()->attempt($this->form->toArray())) {
                $this->addError('form.email', 'Deze combinatie van e-mailadres en wachtwoord is niet bekend.');
                return;
            }
        } catch (\Exception $e) {
            $this->addError('form.email', 'Omdat we een nieuw systeem hebben moet je je wachtwoord opnieuw instellen. Heb je dat al gedaan en lukt het nog steeds niet? Neem dan contact met ons op.');

            return;
        }

        request()->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.forms.login');
    }
}
