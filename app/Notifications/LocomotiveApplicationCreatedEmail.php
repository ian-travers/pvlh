<?php

namespace App\Notifications;

use App\Models\LocomotiveApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LocomotiveApplicationCreatedEmail extends Notification implements ShouldQueue
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
            ->line($this->locApp->created_at->format('d.m.Y H:i') . ' в системе зарегистрирована новая заявка на локомотив.')
            ->line('Заказчик: ' . $this->locApp->customer->name)
            ->line('Назначение: ' . $this->locApp->purpose->name)
            ->line('Дата: ' . $this->locApp->on_date->format('d.m.Y г.'))
            ->action('Подробнее о заявке', url("/applications/{$this->locApp->id}"))
            ->line('Если вы не хотите больше получать уведомления по электронной почте перейдите в настройки своего профиля и откажитесь от этих уведомлений.');
    }
}
