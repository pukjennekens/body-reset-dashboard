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
        $this->allServices = Service::all();
    }

    public function saveBranchServices()
    {
        Log::debug($this->services);

        $this->validate([
            'services' => ['nullable', 'array'],
            'services.*' => ['nullable', 'exists:services,id'],
        ]);

        $this->branch->services()->sync($this->services);
    }

    public function render()
    {
        return view('livewire.forms.branch-services');
    }
}
