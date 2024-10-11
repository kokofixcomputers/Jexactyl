<?php

namespace Jexactyl\Notifications;

use Jexactyl\Models\User;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class MailTested extends Notification
{
    public function __construct(private User $user)
    {
    }

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail(): MailMessage
    {
        return (new MailMessage())
            ->subject('Ticket Replied')
            ->greeting('Hello ' . $this->user->name . '!')
            ->line('Your ticket has been replied! Please check the panel.');
    }
}
