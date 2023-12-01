<?php

namespace App\Livewire\Forms;

use App\Models\Branch as ModelsBranch;
use LivewireUI\Modal\ModalComponent;

class Branch extends ModalComponent
{
    public $branch;
    public BranchForm $form;

    public function mount($id = null)
    {
        $this->branch = ModelsBranch::findOrNew($id);
    }

    public function createBranch()
    {
        $this->validate();

        $this->branch->fill($this->form->toArray());
        $this->branch->save();

        $this->dispatch('branch-created', id: $this->branch->id);

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.forms.branch');
    }
}
