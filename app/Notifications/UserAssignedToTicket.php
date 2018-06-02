<?php

namespace Bugger\Notifications;

use Bugger\Ticket;
use Bugger\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserAssignedToTicket extends Notification
{
    use Queueable;
    private $user;
    private $ticket;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Ticket $ticket)
    {
        $this->user = $user;
        $this->ticket = $ticket;
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
        $mail = new MailMessage;
        $mail->subject('You were assigned to an ticket!')
            ->greeting('Hello, '.$this->user->getFullName())
            ->line('Hello '.$this->user->getFullName().', You were assigned to ticket: '. $this->ticket->name)
            ->line('Ticket Description: '. $this->ticket->description)
            ->action('View Ticket', url('tickets.show',$this->ticket->id));
        return $mail;
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
