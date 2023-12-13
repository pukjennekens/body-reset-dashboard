<?php

namespace App\Livewire;

use App\Models\Branch;
use Livewire\Component;

class AppointmentCalendar extends Component
{
    public $date    = null;
    public $month   = null;
    public $year    = null;
    public $days    = [];
    public $branch  = null;
    public $service = null;

    public function mount( $branchId )
    {
        $this->generateCalendar(now());
        $this->branch = Branch::find( $branchId );
    }

    public function generateCalendar($date)
    {
        $this->date  = $date;
        $this->month = $this->date->format('F');
        $this->year  = $this->date->year;
        $this->days  = $this->getDays($this->date);
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
