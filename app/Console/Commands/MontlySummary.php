<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use App\Models\User;
use App\Notifications\MontlySummary as NotificationsMontlySummary;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class MontlySummary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:montly-summary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $prevMonthStart = now()->subMonth()->subMonth()->startOfMonth();
        $prevMonthEnd   = now()->subMonth()->subMonth()->endOfMonth();

        $appointments = Appointment::whereBetween('start', [$prevMonthStart, $prevMonthEnd])
            ->whereNotNull('trainer_id')
            ->get()
            ->groupBy('trainer_id')
            ->map(function ($appointments) {
                return $appointments->count();
            })
            ->mapWithKeys(function ($count, $trainerId) {
                $trainer = User::find($trainerId);

                return [$trainer->name => $count];
            });

        $users = User::where('notify_on_registration', true)->get();
        foreach ($users as $user) {
            $user->notify(new NotificationsMontlySummary($appointments));
        }
    }
}
