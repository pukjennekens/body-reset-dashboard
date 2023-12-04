<?php

namespace App\Livewire;

use App\Models\Service;
use LivewireUI\Modal\ModalComponent;

class DeleteService extends ModalComponent
{
    public Service $service;

    public function mount($id = null)
    {
        $this->service = Service::find($id);
    }

    public function cancel()
    {
        $this->closeModal();
    }

    public function deleteService()
    {
        $this->service->delete();
        $this->dispatch('service-deleted');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.delete-service');
    }
}
