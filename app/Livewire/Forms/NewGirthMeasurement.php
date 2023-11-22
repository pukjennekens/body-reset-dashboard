<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use App\Models\User;

class NewGirthMeasurement extends Component
{
    public NewGirthMeasurementForm $form;

    public User $user;

    public function mount($id = null)
    {
        $this->user = User::find($id) ?? new User();
    }

    public function createGirthMeasurement()
    {
        $this->validate();

        $this->user->girthMeasurements()->create($this->form->toArray());

        $this->dispatch('girth-measurement-created', userId: $this->user->id);
        $this->dispatch('user-updated', id: $this->user->id);

        $this->form->reset();

        $this->dispatch('close-modal', name: 'new-girth-measurement');
    }

    public function render()
    {
        return view('livewire.forms.new-girth-measurement');
    }
}
