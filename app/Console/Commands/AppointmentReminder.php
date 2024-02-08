<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use Illuminate\Console\Command;

class AppointmentReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:appointment-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the appoinemtnts reminder command to notify users if they have an appointment within 24 hours.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $appointments = Appointment::where('start', '>', now())
            ->where('start', '<', now()->addDay())
            ->where('reminder_sent', false)
            ->get();

        foreach ($appointments as $appointment) {
            $appointment->user->notify(new \App\Notifications\AppointmentReminder($appointment));
            $appointment->reminder_sent = true;
            $appointment->save();
        }
    }
}
