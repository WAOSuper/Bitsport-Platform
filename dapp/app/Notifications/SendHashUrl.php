<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendHashUrl extends Notification implements ShouldQueue
{
    use Queueable;
    protected $url_hash;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($url_hash)
    {
        $this->url_hash = $url_hash;
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
        return (new MailMessage)
                    ->line('You have been Matched with a user for your P2P Match, Check-in now to start your Match.')
                    ->action('Check-In Now', url('match-start-check-in/'.$this->url_hash))
                    ->line('Thank you for using BitSport!');
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
