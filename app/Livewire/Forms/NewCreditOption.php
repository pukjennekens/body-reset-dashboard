<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use App\Models\CreditOption;

class NewCreditOption extends ModalComponent
{
    public NewCreditOptionForm $form;
    public CreditOption $creditOption;

    public function mount($id = null)
    {
        $this->creditOption = $id ? CreditOption::find($id) : new CreditOption();
        $this->form->fill($this->creditOption);
    }

    public function createCreditOption()
    {
        $this->validate();

        if($this->creditOption->id) {
            $this->creditOption->update(
                array_merge(
                    $this->form->toArray(),
                    ['is_active' => $this->form->is_active ? 1 : 0]
                )
            );
            $this->dispatch('credit-option-updated');
        } else {
            CreditOption::create(
                array_merge(
                    $this->form->toArray(),
                    ['is_active' => $this->form->is_active ? 1 : 0]
                )
            );
            $this->dispatch('credit-option-created');
        }
        
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.forms.new-credit-option');
    }
}
