<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class ResetPassword extends Notification
{
    use Queueable;

    /**
     * @var \App\Models\User $user The user to reset the password
     */
    private User $user;

    /**
     * @var string $token The token to reset the password
     */
    private string $token;

    /**
     * Create a new notification instance.
     */
    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
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
                    ->subject('Wachtwoord resetten')
                    ->greeting('Hey ' . $this->user->name)
                    ->line('Je ontvangt deze e-mail omdat we een wachtwoord reset verzoek hebben ontvangen voor uw account.')
                    ->line('Klik op de onderstaande knop om uw wachtwoord te resetten.')
                    ->line('Deze wachtwoordreset link is 6 uur geldig.')
                    ->action('Reset wachtwoord', route('auth.reset-password.token', ['token' => $this->token]));
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
