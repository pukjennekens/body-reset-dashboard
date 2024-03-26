<?php

namespace App\Livewire\Forms;

use App\Models\Branch;
use App\Models\Service;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class BranchServices extends Component
{
    public Branch $branch;
    public $allServices = [];
    public array $services = [];

    public function mount($branchId)
    {
        $this->branch      = Branch::findOrFail($branchId);
        $this->services    = $this->branch->services->pluck('id')->toArray();
        $this->allServices = Service::where('hidden', false)->get();
    }

    public function saveBranchServices()
    {
        $this->validate([
            'services' => ['nullable', 'array'],
            'services.*' => ['nullable', 'exists:services,id'],
        ]);

        $this->branch->services()->sync($this->services);

        $this->dispatch('branch-services-updated');

        // Temporary: reload the page to show the updated data
        return redirect()->route('dashboard.admin.settings.branches.show', $this->branch->id);
    }

    public function render()
    {
        return view('livewire.forms.branch-services');
    }
}
