<?php

namespace App\Livewire\Forms;

use App\Models\Anamnesis as ModelsAnamnesis;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use LivewireUI\Modal\ModalComponent;

class Anamnesis extends ModalComponent
{
    public ModelsAnamnesis $anamnesis;
    public User $user;
    public AnamnesisForm $form;
    public $anamnesisSaved = false;

    public function mount($userId)
    {
        $this->user      = User::findOrFail($userId);
        $this->anamnesis = $this->user->anamnesis ?? new ModelsAnamnesis();
    }

    public function createAnamnesis()
    {
        $this->validate();

        $this->anamnesis->fill($this->form->toArray());
        $this->user->anamnesis()->save($this->anamnesis);

        $this->dispatch('anamnesis-created', id: $this->anamnesis->id);

        $this->anamnesisSaved = true;

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.forms.anamnesis');
    }
}
