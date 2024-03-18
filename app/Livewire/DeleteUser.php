<?php

namespace App\Livewire;

use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class DeleteUser extends ModalComponent
{
    public User $user;
    public $transferTo;

    public function mount($id = null)
    {
        $this->user = User::find($id);
    }

    public function cancel()
    {
        $this->closeModal();
    }

    public function deleteUser()
    {
        if($this->user->role == 'user') {
            $this->user->delete();
            $this->dispatch('user-deleted');
            $this->closeModal();
        } else {
            User::where('trainer_user_id', $this->user->id)->update(['trainer_user_id' => $this->transferTo]);
            $this->user->recipes()->update(['user_id' => $this->transferTo]);
            $this->user->nutritionPlans()->update(['user_id' => $this->transferTo]);
            $this->user->girthMeasurements()->update(['user_id' => $this->transferTo]);
            $this->user->bodyCompositionMeasurements()->update(['user_id' => $this->transferTo]);
            $this->user->appointments()->update(['user_id' => $this->transferTo]);
            $this->user->anamnesis()->update(['user_id' => $this->transferTo]);
            $this->user->creditOrders()->update(['user_id' => $this->transferTo]);
        }
    }

    public function render()
    {
        return view('livewire.delete-user');
    }
}
