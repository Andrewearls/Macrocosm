<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\User;
use App\Classes;

class Enrolled extends Notification
{
    use Queueable;

    public $student, $class;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $student, Classes $class)
    {
        $this->student = $student;
        $this->class = $class;
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
                    ->subject('New Student Enrolled!')
                    ->greeting('Hello, '. $this->class->instructor->name .'.')
                    ->line('This email is to inform you that '. $this->student->name .' has enrolled in your '. $this->class->name .' Class.')
                    ->line('Thank you for all your hard work!');
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
