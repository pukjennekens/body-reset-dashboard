<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    protected $casts = [
        'start' => 'datetime',
        'end'   => 'datetime',
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

    public function scopeBetween($query, $start, $end)
    {
        return $query
            ->where('start', '>=', $start)
            ->where('end', '<=', $end);
    }

    public function getIcsCalendarInvite()
    {
        $start = $this->start->format('Ymd\THis\Z');
        $end   = $this->end->format('Ymd\THis\Z');

        return
'BEGIN:VCALENDAR
VERSION:2.0
BEGIN:VEVENT
CLASS:PUBLIC
DESCRIPTION:U heeft een afspraak gemaakt voor ' . $this->service->name . ' op ' . $this->start->format('d-m-Y H:i') . '. Deze afspraak duurt ' . $this->service->appointment_duration_minutes . ' minuten.
DTSTART:' . $start . '
DTEND:' . $end . '
LOCATION:' . $this->branch->name . '
SUMMARY:Afspraak bij ' . $this->branch->name . ' voor ' . $this->service->name . '
END:VEVENT
END:VCALENDAR';
    }
}
