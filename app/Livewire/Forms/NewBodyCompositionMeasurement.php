<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use App\Models\User;
use App\Models\BodyCompositionMeasurement;

class NewBodyCompositionMeasurement extends Component
{
    public NewBodyCompositionMeasurementForm $form;

    public User $user;

    public function mount($id = null)
    {
        $this->user = User::find($id) ?? new User();
    }

    public function createBodyCompositionMeasurement()
    {
        $this->validate();

        $this->user->bodyCompositionMeasurements()->create($this->form->toArray());

        $this->dispatch('body-composition-measurement-created', userId: $this->user->id);
        $this->dispatch('user-updated', id: $this->user->id);
    }

    public function render()
    {
        return view('livewire.forms.new-body-composition-measurement', [
            'user' => $this->user,
        ]);
    }
}
