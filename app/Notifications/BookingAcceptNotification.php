<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BookingAcceptNotification extends Notification
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
        $subject = ('This is '.$this->fromUser->name.', I have approved your trip');
        $greeting = ('Hello ! '. $notifiable->name);

        return (new MailMessage)
            ->subject('Booking status confirmed')
            ->from($this->fromUser->email,'Sender')
            ->greeting($greeting)
            ->salutation('I hope, we will have a great time!')
            ->line($subject)
            ->line('Click the button below to see details')
            ->action('See your trips', route('user.dashboard'));
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
