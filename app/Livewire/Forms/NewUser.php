<?php

namespace App\Livewire\Forms;

use App\Models\Branch;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class NewUser extends ModalComponent
{
    public NewUserForm $form;
    public $role     = 'user';
    public $branches = [];
    public $trainers = [];

    public function mount()
    {
        $this->branches = Branch::all();
        $this->trainers = User::where('role', 'trainer')->get();
    }

    public function createUser()
    {
        $this->validate();

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.forms.new-user');
    }
}
