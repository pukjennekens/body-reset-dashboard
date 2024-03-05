<?php

namespace App\Livewire;

use App\Models\BranchService;
use App\Models\Service;
use Livewire\Attributes\On;
use Livewire\Component;

class BranchServiceOpeningHours extends Component
{
    public BranchService $branchService;
    public Service $service;

    public $opening_hours_monday    = [];
    public $opening_hours_tuesday   = [];
    public $opening_hours_wednesday = [];
    public $opening_hours_thursday  = [];
    public $opening_hours_friday    = [];
    public $opening_hours_saturday  = [];
    public $opening_hours_sunday    = [];
    public $opening_hours_holiday   = [];

    public $success      = false;
    public $successCount = 0;

    public function mount($branchId, $serviceId)
    {
        $this->branchService = BranchService::where('branch_id', $branchId)
            ->where('service_id', $serviceId)
            ->firstOrFail();

        $this->opening_hours_monday    = $this->branchService->opening_hours_monday    ?? [ 'closed' => false, 'times' => [] ];
        $this->opening_hours_tuesday   = $this->branchService->opening_hours_tuesday   ?? [ 'closed' => false, 'times' => [] ];
        $this->opening_hours_wednesday = $this->branchService->opening_hours_wednesday ?? [ 'closed' => false, 'times' => [] ];
        $this->opening_hours_thursday  = $this->branchService->opening_hours_thursday  ?? [ 'closed' => false, 'times' => [] ];
        $this->opening_hours_friday    = $this->branchService->opening_hours_friday    ?? [ 'closed' => false, 'times' => [] ];
        $this->opening_hours_saturday  = $this->branchService->opening_hours_saturday  ?? [ 'closed' => false, 'times' => [] ];
        $this->opening_hours_sunday    = $this->branchService->opening_hours_sunday    ?? [ 'closed' => false, 'times' => [] ];
        $this->opening_hours_holiday   = $this->branchService->opening_hours_holiday   ?? [];
    }

    public function saveBranchServiceOpeningHours()
    {
        $this->branchService->update([
            'opening_hours_monday'    => $this->opening_hours_monday,
            'opening_hours_tuesday'   => $this->opening_hours_tuesday,
            'opening_hours_wednesday' => $this->opening_hours_wednesday,
            'opening_hours_thursday'  => $this->opening_hours_thursday,
            'opening_hours_friday'    => $this->opening_hours_friday,
            'opening_hours_saturday'  => $this->opening_hours_saturday,
            'opening_hours_sunday'    => $this->opening_hours_sunday,
            'opening_hours_holiday'   => $this->opening_hours_holiday,
        ]);

        $this->success = true;
        $this->successCount++;

        $this->dispatch('branch-service-updated');
    }

    public function render()
    {
        return view('livewire.branch-service-opening-hours');
    }
}
