<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentReminder extends Notification
{
    use Queueable;

    /**
     * @var \App\Models\Appointment $appointment
     */
    public $appointment;

    /**
     * Create a new notification instance.
     */
    public function __construct(object $appointment)
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
                    ->subject('Herinnering voor je afspraak bij BodyReset')
                    ->greeting('Beste ' . $this->appointment->user->name)
                    ->line('Dit bericht dient als herinnering voor je afspraak bij BodyReset.')
                    ->line('Je heeft een afspraak gemaakt voor ' . $this->appointment->service->name . ' op ' . $this->appointment->start->format('d-m-Y H:i') . '.')
                    ->line('Deze afspraak duurt ' . $this->appointment->service->appointment_duration_minutes . ' minuten.')
                    ->line('Je kunt deze afspraak niet meer annuleren omdat hij binnen 24 uur plaatsvindt.')
                    ->action('Bekijk je afspraak online', route('dashboard.user.appointments'));
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
