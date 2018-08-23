<?php
declare(strict_types=1);

namespace App\Traits\Repositories;

use App\Repositories\NotificationRepository;
use Illuminate\Notifications\DatabaseNotificationCollection;

trait Notifiable
{
    /**
     * @param  mixed  $instance
     * @return void
     */
    public function notify($instance): void
    {
        $this->eloquent->notify($instance);
    }

    /**
     * @param  array $args
     * @return DatabaseNotificationCollection
     */
    public function notifications(array $args = []): DatabaseNotificationCollection
    {
        $collection = NotificationRepository::build($this->eloquent->notifications(), $args)->get();
        return NotificationRepository::toModels($collection);
    }

    /**
     * @param  array $args
     * @return DatabaseNotificationCollection
     */
    public function readNotifications(array $args = []): DatabaseNotificationCollection
    {
        $collection = NotificationRepository::build($this->eloquent->readNotifications(), $args)->get();
        return NotificationRepository::toModels($collection);
    }

    /**
     * @param  array $args
     * @return DatabaseNotificationCollection
     */
    public function unreadNotifications(array $args = []): DatabaseNotificationCollection
    {
        $collection = NotificationRepository::build($this->eloquent->unreadNotifications(), $args)->get();
        return NotificationRepository::toModels($collection);
    }

}
