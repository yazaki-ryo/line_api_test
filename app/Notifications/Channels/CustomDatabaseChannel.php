<?php
declare(strict_types=1);

namespace App\Notifications\Channels;

use Illuminate\Notifications\Channels\DatabaseChannel;
use Illuminate\Notifications\Notification;

class CustomDatabaseChannel extends DatabaseChannel
{
    /**
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return \Illuminate\Database\Eloquent\Model
     *
     * {@inheritDoc}
     * @see \Illuminate\Notifications\Channels\DatabaseChannel::send()
     */
    public function send($notifiable, Notification $notification)
    {
        return $notifiable->routeNotificationFor('database')->create([
            'id'      => $notification->id,
            'type'    => $notification->type,
            'data'    => $this->getData($notifiable, $notification),
            'read_at' => null,
        ]);
    }
}
