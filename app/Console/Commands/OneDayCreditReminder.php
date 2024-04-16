<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class OneDayCreditReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:one-day-credit-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify the user if their credits are about to expire within 14 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = \App\Models\User::where('one_day_credits_reminder_sent', false)
            ->where('credits_expiration_date', '>=', now()->addDays(1))
            ->where('credits_expiration_date', '<', now()->addDays(2))
            ->get();

        foreach ($users as $user) {
            $user->notify(new \App\Notifications\OneDayCreditReminder($user));
            $user->update([
                'one_day_credits_reminder_sent' => true,
            ]);
        }

        $removeCreditsUsers = \App\Models\User::where('credits_expiration_date', '<', now())->get();
        foreach ($removeCreditsUsers as $user) {
            $user->update([
                'credits'               => 0,
                'credits_reminder_sent' => false,
                'one_day_credits_reminder_sent' => false,
            ]);
        }
    }
}
