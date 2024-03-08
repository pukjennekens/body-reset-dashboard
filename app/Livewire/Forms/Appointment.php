<?php

namespace App\Livewire\Forms;

use App\Models\Appointment as ModelsAppointment;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use LivewireUI\Modal\ModalComponent;

class Appointment extends ModalComponent
{
    public AppointmentForm $form;

    public $appointment;
    public $submodules = [];

    public function mount($id)
    {
        if(!$id) return;
        $this->appointment = ModelsAppointment::find($id);
        $this->form->fill($this->appointment->toArray());
        $this->submodules = $this->appointment->submodules ?: [];
    }

    public function update()
    {
        $this->form->validate();

        if($this->appointment) {
            $this->appointment->update(array_merge($this->form->toArray(), ['submodules' => $this->submodules, 'trainer_id' => auth()->id()]));
        }

        $this->dispatch('appointment-updated');

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.forms.appointment');
    }
}
