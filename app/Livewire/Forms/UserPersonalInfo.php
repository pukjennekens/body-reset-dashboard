<?php

namespace App\Livewire\Forms;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class UserPersonalInfo extends Component
{
    public UserPersonalInfoForm $form;

    public User $user;
    public $trainers = [];
    public $branches = [];
    public $role     = 'user';

    public $editing = false;

    public function mount($id = null)
    {
        $this->user     = User::find($id) ?? new User();
        $this->trainers = User::where('role', 'trainer')->get();
        $this->branches = Branch::all();
        $this->role     = $this->user->role ?? 'user';
    }

    public function updatePersonalInfo()
    {
        if(!$this->editing) return;

        $this->validate();

        // Get the user data
        $userData = $this->form->toArray();
        foreach($userData as $key => $value) if(empty($value)) unset($userData[$key]);

        // Map the manager branches array to an array with integers instead of strings
        if($this->form->manager_branches) {
            $managerBranches = [];
            foreach($this->form->manager_branches as $branch) $managerBranches[] = (int) $branch;
            $userData['manager_branches'] = $managerBranches;
        }

        Log::info($userData);

        // Get the role and verify if the current user is an admin
        $role = 'user';
        if(auth()->user()->hasRole('admin')) $role = $this->role;
        $userData['role'] = $role;

        // Set the trainer id to int and the branch id to int if they are not null
        $this->form->trainer_user_id = $this->form->trainer_user_id ? (int) $this->form->trainer_user_id : null;
        $this->form->branch_id       = $this->form->branch_id ? (int) $this->form->branch_id : null;

        // Update the user
        $this->user->update($userData);

        // Handle the rest of the actions
        $this->editing = false;
        $this->dispatch('user-updated', id: $this->user->id);
        return redirect()->route('dashboard.admin.users.show', $this->user->id);
    }

    public function toggleEditing()
    {
        $this->editing = ! $this->editing;
    }

    public function cancelEditing()
    {
        $this->editing = false;
        $this->form->fill($this->user->toArray());
    }

    public function render()
    {
        return view('livewire.forms.user-personal-info', [
            'user' => $this->user,
        ]);
    }
}
