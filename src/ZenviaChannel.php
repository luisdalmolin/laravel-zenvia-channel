<?php

namespace NotificationChannels\Zenvia;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use NotificationChannels\Zenvia\Exceptions\CouldNotSendNotification;

class ZenviaChannel
{
    /**
     * @var Zenvia
     */
    protected $zenvia;

    /**
     * Channel constructor.
     *
     * @param Zenvia $Zenvia
     */
    public function __construct(Zenvia $zenvia)
    {
        $this->zenvia = $zenvia;
    }

    /**
     * Send the given notification.
     *
     * @param mixed        $notifiable
     * @param Notification $notification
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toZenvia($notifiable);

        if (! $to = $notifiable->routeNotificationFor('zenvia')) {
            $to = $message->to;
        }

        $params  = $message->toArray();

        $this->zenvia->sendMessage($to, $params);
    }
}
