<?php

namespace App\Notifications;

use App\Models\LocomotiveApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LocomotiveApplicationCreatedEmail extends Notification
{
    use Queueable;

    protected $locApp;

    public function __construct(LocomotiveApplication $locApp)
    {
        $this->locApp = $locApp;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->subject('Заявка на локомотив')
            ->line('В системе зарегистрирована новая заявка на локомотив.')
            ->line('Заказчик: ' . $this->locApp->customer->name)
            ->action('Подробнее о заявке', url("/applications/{$this->locApp->id}"))
            ->line('Если вы не хотите больше получать уведомления по электронной почте перейдите в настройки своего профиля и откажитесь от этих уведомлений.');
    }
}
