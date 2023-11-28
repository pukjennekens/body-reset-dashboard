<?php

namespace App\Livewire;

use App\Models\CreditOption;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class DeleteCreditOption extends ModalComponent
{
    public CreditOption $creditOption;

    public function mount($id = null)
    {
        $this->creditOption = CreditOption::find($id);
    }

    public function cancel()
    {
        $this->closeModal();
    }

    public function deleteCreditOption()
    {
        $this->creditOption->delete();
        $this->dispatch('credit-option-deleted');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.delete-credit-option');
    }
}
