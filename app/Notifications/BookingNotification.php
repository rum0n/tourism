<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BookingNotification extends Notification
{
    use Queueable;
    public $fromUser;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->fromUser = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $subject = ('You\'ve got a new booking by '. $this->fromUser->name);
        $greeting = ('Hello !'. $notifiable->name);

        return (new MailMessage)
            ->subject('Booking notification')
            ->from($this->fromUser->email,'Sender')
            ->greeting($greeting)
            ->salutation('Thank you for using our application!')
            ->line($subject)
            ->line('Click the button below to see details')
            ->action('Bookings', route('guide.dashboard'));

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
