<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class FinalWinnerOfChallengeByAdmin extends Notification
{
    use Queueable;

    protected $challenge;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($challenge)
    {
        $this->challenge = $challenge;
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

        if($this->challenge->winner){
            return (new MailMessage)
            ->line('Final winner of challenge between "'.ucfirst($this->challenge->creator->username).'" and "'.ucfirst($this->challenge->opponent->username).'" is "'.ucfirst($this->challenge->winner->username).'"')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
        } else {
            return (new MailMessage)
            ->line('Challenge is draw between "'.ucfirst($this->challenge->creator->username).'" and "'.ucfirst($this->challenge->opponent->username))
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
        }
     ;
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
