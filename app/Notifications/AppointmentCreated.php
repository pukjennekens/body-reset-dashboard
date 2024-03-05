<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentCreated extends Notification
{
    use Queueable;

    /**
     * @var \App\Models\Appointment $appointment The appointment that was created
     */
    private \App\Models\Appointment $appointment;

    /**
     * Create a new notification instance.
     */
    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Bevestiging van je afspraak bij BodyReset')
                    ->greeting('Beste ' . $this->appointment->user->name)
                    ->line('Je hebt een afspraak gemaakt voor ' . $this->appointment->service->name . ' op ' . $this->appointment->start->format('d-m-Y H:i') . '.')
                    ->line('Deze afspraak duurt ' . $this->appointment->service->appointment_duration_minutes . ' minuten.')
                    ->line('Wil je toch nog de afspraak annuleren? Dit kun je in je account doen, maximaal 24 uur van te voren.')
                    ->action('Bekijk je afspraak online', route('dashboard.user.appointments'))
                    ->attachData($this->appointment->getIcsCalendarInvite(), 'afspraak.ics', [
                        'mime' => 'text/calendar;charset=UTF-8;method=REQUEST',
                    ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
