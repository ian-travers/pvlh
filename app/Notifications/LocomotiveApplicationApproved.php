<?php

namespace App\Notifications;

use App\Models\LocomotiveApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LocomotiveApplicationApproved extends Notification
{
    use Queueable;

    protected $locApp;
    private $department;

    public function __construct(LocomotiveApplication $locApp, string $department)
    {
        $this->locApp = $locApp;
        $this->department = $department;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'action' => 'Заявка согласована',
            'department' => $this->department,
            'link' => "/applications/{$this->locApp->id}",
        ];
    }
}
