<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\BranchService;
use App\Models\Service;
use App\Models\User;
use Livewire\Component;

class AppointmentCalendar extends Component
{
    public $date      = null;
    public $month     = null;
    public $year      = null;
    public $days      = [];

    public $branch    = null;
    public $user      = null;

    public $services  = [];
    public $serviceId = null;
    public $service   = null;

    public $slots     = [];

    public function mount($branchId, $userId)
    {
        $this->branch   = Branch::find( $branchId );
        $this->user     = User::find( $userId );
        $this->services = $this->branch->services;

        if(!$this->branch) abort(404);
        if(!$this->user) abort(404);

        if($this->serviceId) $this->selectService($this->serviceId);
    }

    public function selectService($serviceId)
    {
        $this->serviceId = $serviceId;
        $this->service   = Service::find($serviceId);
        $this->generateCalendar($this->date ?? now());
    }

    public function generateSlots()
    {
        $this->slots = [];

        foreach($this->days as $day)  {
            $serviceDuration        = $this->service->appointment_duration_minutes;
            $serviceDurationOverlap = $this->service->appointment_overlap_minutes;
            $openingHours           = $this->getBranchServiceOpeningHours($this->branch, $this->service, $day);

            if(!$openingHours) return null;

            if(!$openingHours['closed']) {
                foreach($openingHours['times'] as $time) {
                    $from = $day->copy()->setTimeFromTimeString($time['from']);
                    $to   = $day->copy()->setTimeFromTimeString($time['to']);

                    $fromDateTime    = $day->copy()->setTimeFromTimeString($time['from']);
                    $toDateTime      = $day->copy()->setTimeFromTimeString($time['to']);
                    $maxAppointments = intval( $openingHours['max_participants_per_slot'] ?? 1 );

                    $appointments = $this->branch->appointments()->between(
                        $fromDateTime->format('Y-m-d H:i:s'),
                        $toDateTime->format('Y-m-d H:i:s')
                    )->get();

                    $slots = $from->floatDiffInRealMinutes($to) / ($serviceDuration - $serviceDurationOverlap);

                    for($i = 0; $i < $slots; $i++) {
                        $available = true;

                        $slotFrom             = $from->copy()->addMinutes($i * $serviceDuration);
                        $slotTo               = $slotFrom->copy()->addMinutes($serviceDuration);
                        $numberOfAppointments = 0;

                        if($slotFrom->lt(now())) {
                            $available = false;
                        } else {
                            foreach($appointments as $appointment) {
                                $appointmentFrom = $appointment->start;
                                $appointmentTo   = $appointment->end;
    
                                if(
                                    $slotFrom->copy()->addMinutes(1)->between($appointmentFrom, $appointmentTo)
                                    ||
                                    $slotTo->copy()->subMinutes(1)->between($appointmentFrom, $appointmentTo)
                                ) {
                                    $numberOfAppointments++;
                                }
                            }

                            if($numberOfAppointments >= $maxAppointments) {
                                $available = false;
                            }
                        }

                        $this->slots[$day->format('d-m-Y')][] = [
                            'from'            => $slotFrom->format('H:i'),
                            'to'              => $slotTo->format('H:i'),
                            'available'       => $available,
                            'maxAppointments' => $maxAppointments,
                            'numberOfAppointments' => $numberOfAppointments,
                        ];
                    }
                }
            }
        }
    }

    public function getBranchServiceOpeningHours($branch, $service, $day)
    {
        $branchService = BranchService
            ::where('branch_id', $branch->id)
            ->where('service_id', $service->id)
            ->first();

        if(!$branchService) return null;

        $openingHours = $branchService->{'opening_hours_' . strtolower($day->format('l'))};

        if(!$openingHours) return null;

        return $openingHours;
    }

    public function generateCalendar($date)
    {
        $this->date  = $date;
        $this->month = $this->date->format('F');
        $this->year  = $this->date->year;
        $this->days  = $this->getDays($this->date);

        $this->generateSlots();
    }

    public function getDays($date)
    {
        $days = [];

        $start = $date->copy()->startOfWeek();
        $end   = $date->copy()->endOfWeek();

        while ($start->lte($end)) {
            $days[] = $start->copy();
            $start->addDay();
        }

        return $days;
    }

    public function nextWeek()
    {
        $this->generateCalendar($this->date->addWeek());
    }

    public function today()
    {
        $this->generateCalendar(now());
    }

    public function previousWeek()
    {
        $this->generateCalendar($this->date->subWeek());
    }

    public function render()
    {
        return view('livewire.appointment-calendar');
    }
}
