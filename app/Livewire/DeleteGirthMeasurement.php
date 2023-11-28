<?php

namespace App\Livewire;

use App\Models\GirthMeasurement;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DeleteGirthMeasurement extends ModalComponent
{
    public GirthMeasurement $girthMeasurement;

    public function mount($id = null)
    {
        $this->girthMeasurement = GirthMeasurement::find($id);
    }

    public function cancel()
    {
        $this->closeModal();
    }

    public function deleteGirthMeasurement()
    {
        $userId = $this->girthMeasurement->user->id;
        $this->girthMeasurement->delete();
        $this->dispatch('girth-measurement-deleted', userId: $userId);
        $this->dispatch('user-updated', id: $userId);
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.delete-girth-measurement');
    }
}
