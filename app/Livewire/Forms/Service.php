<?php

namespace App\Livewire\Forms;

use App\Models\Service as ModelsService;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Service extends ModalComponent
{
    public ServiceForm $form;
    public $service;

    public function mount($id = null)
    {
        $this->service = ModelsService::findOrNew($id);
        $this->form->fill($this->service);
    }

    public function saveService()
    {
        $this->validate();

        $this->service->fill($this->form->toArray());
        $this->service->save();

        $this->dispatch('service-created', id: $this->service->id);

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.forms.service');
    }
}
