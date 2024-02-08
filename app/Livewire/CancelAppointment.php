<?php

namespace App\Livewire;

use App\Models\Appointment;
use LivewireUI\Modal\ModalComponent;

class CancelAppointment extends ModalComponent
{
    public $appointmentId;
    public Appointment $appointment;

    public function mount($appointmentId)
    {
        $this->appointmentId = $appointmentId;
        $this->appointment = Appointment::findOrfail($appointmentId);
    }

    public function cancelAppointment()
    {
        if ($this->appointment->start->lt(now()->addDay())) return;

        $this->appointment->user->notify(new \App\Notifications\AppointmentCancelled($this->appointment));

        $creditsToRefund = $this->appointment->service->price;
        $this->appointment->user->increment('credits', $creditsToRefund);
        $this->appointment->delete();

        $this->dispatch('appointment-deleted');

        $this->closeModal();
    }

    public function cancel()
    {
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.cancel-appointment');
    }
}
