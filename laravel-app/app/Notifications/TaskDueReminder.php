<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskDueReminder extends Notification
{
    use Queueable;

    private $task;

    public function __construct($task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Reminder: Task Due Tomorrow')
            ->line('Your task "' . $this->task->name . '" is due tomorrow.')
            ->action('View Task', url('/tasks/' . $this->task->id))
            ->line('Make sure to complete it on time!');
    }
}

