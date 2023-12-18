<?php

namespace App\Livewire;

use App\Models\Appointment;
use App\Models\Branch;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use LivewireUI\Modal\ModalComponent;

class MakeAppointment extends ModalComponent
{
    public $date          = null;
    public $from          = null;
    public $to            = null;
    public $branchId      = null;
    public $serviceId     = null;
    public $userId        = null;
    public $startDateTime = null;

    public Branch $branch;
    public Service $service;
    public User $user;

    public function mount($date, $from, $to, $branchId, $serviceId, $userId)
    {
        $this->date      = $date;
        $this->from      = $from;
        $this->to        = $to;
        $this->branchId  = $branchId;
        $this->serviceId = $serviceId;
        $this->userId    = $userId;

        $this->startDateTime = \Carbon\Carbon::createFromFormat('d-m-Y H:i', $this->date . ' ' . $this->from);

        $this->branch  = Branch::find($branchId);
        $this->service = Service::find($serviceId);
        $this->user    = User::find($userId);

        if(!$this->branch) abort(404);
        if(!$this->service) abort(404);
        if(!$this->user) abort(404);
    }

    public function cancel()
    {
        $this->closeModal();
    }

    public function makeAppointment()
    {
        if($this->user->credits < $this->service->price) {
            $this->addError('error', 'U heeft niet genoeg credits om deze afspraak te maken.');
            return;
        }

        $this->user->credits -= $this->service->price;
        $this->user->save();

        Appointment::create([
            'branch_id'  => $this->branchId,
            'service_id' => $this->serviceId,
            'user_id'    => $this->userId,
            'start'      => \Carbon\Carbon::createFromFormat('d-m-Y H:i', $this->date . ' ' . $this->from),
            'end'        => \Carbon\Carbon::createFromFormat('d-m-Y H:i', $this->date . ' ' . $this->to),
        ]);

        $this->closeModal();

        $this->dispatch('appointment-created');
    }

    public function render()
    {
        return view('livewire.make-appointment');
    }
}
