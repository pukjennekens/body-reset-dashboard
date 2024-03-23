<?php

namespace App\Livewire\Forms;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use LivewireUI\Modal\ModalComponent;

class NewUser extends ModalComponent
{
    public NewUserForm $form;
    public $branches = [];
    public $trainers = [];
    private $role    = 'user';

    public function mount()
    {
        $this->branches = Branch::all();
        $this->trainers = User::whereIn('role', ['trainer', 'manager', 'admin'])->get();
    }

    public function createUser()
    {
        $this->validate();

        if(auth()->user()->hasRole('admin')) $this->role = $this->form->role;

        $userData = $this->form->toArray();
        $userData['role'] = $this->role;

        foreach($userData as $key => $value) if(empty($value)) unset($userData[$key]);

        if($this->role != 'user') $userData['trainer_user_id'] = null;
        if($this->role != 'user' && $this->role != 'trainer') $userData['branch_id'] = null;

        $password = \Str::random(8);
        $userData['password'] = bcrypt($password);

        $user = User::create($userData);
        $user->role = $this->role;
        $user->save();

        if($this->role == 'user') $user->branch_id       = $this->form->branch_id;
        if($this->role == 'user') $user->trainer_user_id = $this->form->trainer_user_id;

        $this->dispatch('user-created');

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.forms.new-user');
    }
}
