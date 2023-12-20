<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\BranchService;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class AppointmentCalendar extends Component
{
    public $date  = null;
    public $month = null;
    public $year  = null;
    public $days  = [];

    public $prevDisabled = false;
    public $nextDisabled = false;

    public $branch = null;
    public $user   = null;

    public $services  = [];
    public $serviceId = null;
    public $service   = null;

    public $slots = [];

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
        $this->serviceId = intval( $serviceId );
        $this->service   = Service::find($serviceId);

        if($this->serviceId && $this->service) $this->generateCalendar($this->date ?? now());
    }

    public function generateSlots()
    {
        $this->slots = [];

        foreach($this->days as $day)  {
            $serviceDuration        = $this->service->appointment_duration_minutes;
            $serviceDurationOverlap = $this->service->appointment_overlap_minutes;
            $actualServiceDuration  = $serviceDuration - $serviceDurationOverlap;
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

                    $slots = $from->diffInMinutes($to) / $actualServiceDuration;

                    for($i = 0; $i < $slots; $i++) {
                        $available = true;

                        $slotFrom             = $from->copy()->addMinutes($i * $actualServiceDuration);
                        $slotTo               = $slotFrom->copy()->addMinutes($serviceDuration);
                        $numberOfAppointments = 0;
                        $bookedByUser         = false;

                        if($slotFrom->lt(now())) {
                            $available = false;
                        } else {
                            foreach($appointments as $appointment) {
                                $appointmentFrom = $appointment->start;
                                $appointmentTo   = $appointment->end;
    
                                if(
                                    $slotFrom == $appointmentFrom && $slotTo == $appointmentTo
                                ) {
                                    $numberOfAppointments++;

                                    if($appointment->user_id == $this->user->id) {
                                        $bookedByUser = true;
                                        $available    = false;
                                    }
                                }
                            }

                            if($numberOfAppointments >= $maxAppointments) {
                                $available = false;
                            }
                        }

                        // If the slot doesn't surpass the opening times, add the slot
                        if($slotTo <= $to) {
                            $this->slots[$day->format('d-m-Y')][] = [
                                'date'                 => $day->format('d-m-Y'),
                                'from'                 => $slotFrom->format('H:i'),
                                'to'                   => $slotTo->format('H:i'),
                                'available'            => $available,
                                'maxAppointments'      => $maxAppointments,
                                'numberOfAppointments' => $numberOfAppointments,
                                'bookedByUser'         => $bookedByUser,
                            ];
                        }
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
        $this->month = \Carbon\Carbon::parse($this->date)->translatedFormat('F');
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

    #[On('appointment-created')]
    #[On('appointment-updated')]
    #[On('appointment-deleted')]
    public function refreshCalendar()
    {
        if($this->date && $this->service) $this->generateCalendar($this->date);
    }

    public function render()
    {
        return view('livewire.appointment-calendar');
    }
}
