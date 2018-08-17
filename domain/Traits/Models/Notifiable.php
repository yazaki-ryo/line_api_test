<?php
declare(strict_types=1);

namespace Domain\Traits\Models;

use Illuminate\Support\Collection;

trait Notifiable
{
    /**
     * @param  mixed  $instance
     * @return void
     */
    public function notify($instance): void
    {
        $this->repo->notify($instance);
    }

    /**
     * @param  array $args
     * @return Collection
     */
    public function notifications(array $args = []): Collection
    {
        return $this->repo->notifications($args);
    }

    /**
     * @param  array $args
     * @return Collection
     */
    public function readNotifications(array $args = []): Collection
    {
        return $this->repo->readNotifications($args);
    }

    /**
     * @param  array $args
     * @return Collection
     */
    public function unreadNotifications(array $args = []): Collection
    {
        return $this->repo->unreadNotifications($args);
    }
}
