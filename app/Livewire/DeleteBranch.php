<?php

namespace App\Livewire;

use App\Models\Branch;
use LivewireUI\Modal\ModalComponent;

class DeleteBranch extends ModalComponent
{
    public Branch $branch;

    public function mount($id = null)
    {
        $this->branch = Branch::find($id);
    }

    public function cancel()
    {
        $this->closeModal();
    }

    public function deleteBranch()
    {
        $this->branch->update([
            'hidden' => 1,
        ]);

        $this->dispatch('branch-deleted');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.delete-branch');
    }
}
