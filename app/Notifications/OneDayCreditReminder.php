<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OneDayCreditReminder extends Notification
{
    use Queueable;

    /**
     * @var \App\Models\User $user
     */
    public $user;

    /**
     * Create a new notification instance.
     */
    public function __construct(object $user)
    {
        $this->user = $user;
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
                    ->subject('Herinnering voor je credits bij BodyReset')
                    ->greeting('Beste ' . $this->user->name)
                    ->line('Dit bericht dient als herinnering voor je credits bij BodyReset.')
                    ->line('Je credits vervellen binnen 1 dag.')
                    ->line('Zorg ervoor dat je je credits op tijd gebruikt.')
                    ->action('Maak online een afspraak', route('dashboard.user.appointments'));
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
