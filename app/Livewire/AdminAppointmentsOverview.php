<?php

namespace App\Livewire;

use App\Models\Appointment;
use App\Models\Branch;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class AdminAppointmentsOverview extends Component
{
    public $date         = null;
    public $prevDisabled = false;
    public $nextDisabled = false;

    public $branches         = [];
    public $selectedBranchId = null;
    public $selectedBranch   = null;

    public $services          = [];
    public $selectedServiceId = null;
    public $selectedService   = null;

    private $user   = null;

    public $appointments = [];

    public function mount($userId)
    {
        $this->date   = now();

        $this->user   = User::find($userId);
        if(!$this->user) abort(404);

        if($this->selectedService && $this->selectedBranch) $this->generateAppointments($this->date);

        $this->services = Service::all();

        if($this->user->hasRole('admin')) {
            $this->branches = Branch::all();
        } elseif( $this->user->hasRole('manager') && $this->user->manager_branches ) {
            $this->branches = Branch::whereIn('id', $this->user->manager_branches);
        } elseif( $this->user->hasRole('trainer') && $this->user->branch_id ) {
            $this->branches = Branch::where('id', $this->user->branch_id);;
        }

        if(empty($this->branches)) $this->branches = [];
    }

    public function previousDay()
    {
        $this->date = $this->date->subDay();
        if($this->selectedService && $this->selectedBranch) $this->generateAppointments($this->date);
    }

    public function nextDay()
    {
        $this->date = $this->date->addDay();
        if($this->selectedService && $this->selectedBranch) $this->generateAppointments($this->date);
    }

    public function today()
    {
        $this->date = now();
        if($this->selectedService && $this->selectedBranch) $this->generateAppointments($this->date);
    }

    public function updatedSelectedServiceId()
    {
        $this->selectedService = Service::find($this->selectedServiceId);
        if($this->selectedService && $this->selectedBranch) $this->generateAppointments($this->date);
    }

    public function updatedSelectedBranchId()
    {
        $this->selectedBranch = Branch::find($this->selectedBranchId);
        if($this->selectedService && $this->selectedBranch) $this->generateAppointments($this->date);
    }

    public function generateAppointments($date)
    {
        $this->appointments = Appointment::where('branch_id', $this->selectedBranch->id)->where('service_id', $this->selectedService->id)->whereDate('start', $date->format('Y-m-d'))->get();
    }

    public function render()
    {
        return view('livewire.admin-appointments-overview');
    }
}
