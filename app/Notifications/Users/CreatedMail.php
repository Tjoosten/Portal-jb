<?php

namespace App\Notifications\Users;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class CreatedMail
 * ----
 * The notification class that handles the mail notification.
 * When a new admin or tenant is created in the application.
 *
 * @package App\Notifications\Users
 */
class CreatedMail extends Notification implements ShouldQueue
{
    use Queueable;

    /** @var string $password The user generated password. */
    public $password;

    /** @var int $tries The number of time may attempted  */
    public $tries = 5;

    /**
     * Create a new notification instance.
     *
     * @param  string $password The generated password for the user.
     * @return void
     */
    public function __construct($password)
    {
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable De instantie van de gebruiker die gekoppeld is aan de notificatie. 
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable De instantie van de gebruiker die gekoppeld is aan de notificatie.
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Er is een login aangemaakt voor u op ' . config('app.name'))
            ->greeting('Hallo,')
            ->line('Een administrator heeft een login aangemaakt voor u op '  . config('app.name'))
            ->line("Je kunt je aanmelden met je email adres en het volgende wachtwoord: " . $this->password)
            ->action('login', route('login'));
    }
}
