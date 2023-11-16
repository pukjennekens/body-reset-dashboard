<?php

namespace App\Livewire\Forms;

use Livewire\Component;

class Login extends Component
{
    public LoginForm $form;

    public function login()
    {
        $this->validate();

        if (! auth()->attempt($this->form->toArray())) {
            $this->addError('form.email', 'Deze combinatie van e-mailadres en wachtwoord is niet bekend.');
            return;
        }

        // Redirect the user to the dashboard.
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.forms.login');
    }
}
