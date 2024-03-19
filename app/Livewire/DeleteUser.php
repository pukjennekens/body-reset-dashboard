<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use LivewireUI\Modal\ModalComponent;

class DeleteUser extends ModalComponent
{
    public User $user;
    public $transferTo;
    public $password;

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
            if( auth()->user()->role == 'user' ) {
                $this->validate([
                    'password' => 'required|password',
                ]);

                // Validate password
                if(!Hash::check($this->password, $this->user->password)) {
                    $this->addError('password', 'Wachtwoord is incorrect');
                    return;
                }
            }

            $this->user->recipes()->delete();
            $this->user->nutritionPlans()->delete();
            $this->user->girthMeasurements()->delete();
            $this->user->bodyCompositionMeasurements()->delete();
            $this->user->appointments()->delete();
            $this->user->anamnesis()->delete();
            $this->user->creditOrders()->delete();
            $this->user->delete();
            
            return redirect()->route('dashboard.admin.users.index');
        } else {
            $this->validate([
                'transferTo' => 'required|exists:users,id',
            ]);

            User::where('trainer_user_id', $this->user->id)->update(['trainer_user_id' => $this->transferTo]);
            $this->user->recipes()->update(['user_id' => $this->transferTo]);
            $this->user->nutritionPlans()->update(['user_id' => $this->transferTo]);
            $this->user->girthMeasurements()->update(['user_id' => $this->transferTo]);
            $this->user->bodyCompositionMeasurements()->update(['user_id' => $this->transferTo]);
            $this->user->appointments()->update(['user_id' => $this->transferTo]);
            $this->user->anamnesis()->update(['user_id' => $this->transferTo]);
            $this->user->creditOrders()->update(['user_id' => $this->transferTo]);
            $this->user->delete();

            return redirect()->route('dashboard.admin.users.index');
        }
    }

    public function render()
    {
        return view('livewire.delete-user', [
            'users' => User::where('id', '!=', $this->user->id)->whereNotIn('role', ['user'])->get(),
        ]);
    }
}
