<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-account';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Maak een gebruikersaccount met de rol "admin" aan.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Maak een gebruikersaccount met de rol "admin" aan.');

        $email = $this->ask('Wat is het e-mailadres van de gebruiker?');
        $password = $this->secret('Wat is het wachtwoord van de gebruiker?');

        try {
            User::create([
                'name' => 'Admin',
                'email' => $email,
                'password' => bcrypt($password),
            ]);
        } catch (\Exception $e) {
            $this->error('Er is iets misgegaan: '.$e->getMessage());

            return;
        }

        $this->info('Gebruiker aangemaakt.');
    }
}
