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

        $role = 'user';

        if(auth()->user()->hasRole('admin')) $role = $this->form->role;

        $userData = $this->form->toArray();
        $userData['role'] = $role;

        if($role != 'user') $userData['trainer_user_id'] = null;
        if($role != 'user') $userData['branch_id'] = null;

        $password = \Str::random(8);
        $userData['password'] = bcrypt($password);

        $user = User::create($userData);

        if($role == 'user') $user->branches()->attach($this->form->branch_id);
        if($role == 'user') $user->trainers()->attach($this->form->trainer_user_id);

        $this->dispatch('user-created');

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.forms.new-user');
    }
}
