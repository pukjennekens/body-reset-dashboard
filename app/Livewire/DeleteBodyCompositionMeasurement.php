<?php

namespace App\Livewire;

use App\Models\BodyCompositionMeasurement;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DeleteBodyCompositionMeasurement extends ModalComponent
{
    public BodyCompositionMeasurement $bodyCompositionMeasurement;

    public function mount($id = null)
    {
        $this->bodyCompositionMeasurement = BodyCompositionMeasurement::find($id);
    }

    public function cancel()
    {
        $this->closeModal();
    }

    public function deleteBodyCompositionMeasurement()
    {
        $userId = $this->bodyCompositionMeasurement->user->id;
        $this->bodyCompositionMeasurement->delete();
        $this->dispatch('body-composition-measurement-deleted', userId: $userId);
        $this->dispatch('user-updated', id: $userId);
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.delete-body-composition-measurement');
    }
}
