<?php

namespace App\Livewire\Forms;

use Livewire\Component;

class Login extends Component
{
    public LoginForm $form;

    public function login()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.forms.login');
    }
}
