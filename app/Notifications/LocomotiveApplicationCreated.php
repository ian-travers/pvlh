<?php

namespace App\Notifications;

use App\Models\LocomotiveApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LocomotiveApplicationCreated extends Notification
{
    use Queueable;

    protected $locApp;

    public function __construct(LocomotiveApplication $locApp)
    {
        $this->locApp = $locApp;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'action' => 'Новая заявка',
            'username' => $this->locApp->user->name,
            'customer' => $this->locApp->user->customer,
            'link' => "/applications/{$this->locApp->id}",
        ];
    }
}
