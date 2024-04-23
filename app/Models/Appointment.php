<?php

namespace App\Models;

use DateTimeZone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Spatie\IcalendarGenerator\Components\Calendar;
use Spatie\IcalendarGenerator\Components\Event;

class Appointment extends Model
{
    use HasFactory;

    public $fillable = [
        'branch_id',
        'service_id',
        'user_id',
        'start',
        'end',
        'reminder_sent',
        'module',
        'submodules',
        'cardio',
        'notes',
        'trainer_id',
    ];

    protected $casts = [
        'start' => 'datetime',
        'end'   => 'datetime',
        'submodules' => 'json',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trainer()
    {
        return $this->belongsTo(User::class, 'trainer_id');
    }

    public function scopeBetween($query, $start, $end)
    {
        return $query
            ->where('start', '>=', $start)
            ->where('end', '<=', $end);
    }

    public function getIcsCalendarInvite()
    {
        $timezone = new DateTimeZone('Europe/Amsterdam');
        $start = clone $this->start;
        $start->setTimezone($timezone);
        $end = clone $this->end;
        $end->setTimezone($timezone);

        $startFormatted = $start->format('Ymd\THis\Z');
        $endFormatted = $end->format('Ymd\THis\Z');

        Log::debug('Start: ' . $startFormatted);
        Log::debug('End: ' . $endFormatted);

        $ical = Calendar::create('Afspraak bij ' . $this->branch->name . ' voor ' . $this->service->name)
            ->event(Event::create($this->service->name)
                ->startsAt($start)
                ->endsAt($end)
                ->description('Je hebt een afspraak gemaakt voor ' . $this->service->name . ' op ' . $this->start->format('d-m-Y H:i') . '. Deze afspraak duurt ' . $this->service->appointment_duration_minutes . ' minuten.')
                ->addressName($this->branch->name)
            );

        return $ical->get();
    }
}
