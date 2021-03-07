<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReportNotification extends Notification
{
    use Queueable;
    public $fromUser;
    public $reportedTo;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->fromUser = $user;
        $this->reportedTo = $user;
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
        $subject = ('This is '.$this->fromUser->name.'and I\'ve a complain about '.$this->reportedTo->name);
        $greeting = ('Hello ! '. $notifiable->name);

        return (new MailMessage)
            ->subject('Report notification')
            ->from($this->fromUser->email,'Sender')
            ->greeting($greeting)
            ->salutation('I hope you will take actions!')
            ->line($subject)
            ->line('Click the button below to see details')
            ->action('View complains', route('admin.reports'));
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
