<?php

namespace Bugger\Notifications;

use Bugger\Project;
use Bugger\Ticket;
use Bugger\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserAssignedToProject extends Notification
{
    use Queueable;
    private $user;
    private $project;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Project $project)
    {
        $this->user = $user;
        $this->project = $project;
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
        $mail->subject('You were assigned to a project!')
            ->greeting('Hello, '.$this->user->getFullName())
            ->line('Hello '.$this->user->getFullName().', You were assigned to project: '. $this->project->name)
            ->action('View Project', url('projects.show',$this->project->id));
        $mail->line('You will receive emails notifications for new tickets created!');
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
