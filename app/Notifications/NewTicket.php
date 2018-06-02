<?php

namespace Bugger\Notifications;

use Bugger\Ticket;
use Bugger\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewTicket extends Notification implements ShouldQueue
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
        $mail->subject('A New Issue Was Discovered :(')
            ->greeting('Hello, '.$this->user->getFullName())
            ->line('Hello '.$this->user->getFullName().', A new ticket was created in project, '. $this->ticket->project->name)
            ->line('Ticket Name: '. $this->ticket->name)
            ->line('Ticket Description: '. $this->ticket->description)
            ->action('View Tickets', url('projects',$this->ticket->project->id));
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
