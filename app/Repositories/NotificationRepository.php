<?php
declare(strict_types=1);

namespace App\Repositories;

use Domain\Contracts\Model\DomainableContract;
use Domain\Models\DomainModel;
use Domain\Models\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Support\Collection;

final class NotificationRepository extends EloquentRepository implements DomainableContract
{
    /**
     * @param DatabaseNotification|null $eloquent
     * @return void
     */
    public function __construct(DatabaseNotification $eloquent = null)
    {
        $this->eloquent = is_null($eloquent) ? new DatabaseNotification: $eloquent;
    }

    /**
     * @param Model $model
     * @return DomainModel
     */
    public static function toModel(Model $model): DomainModel
    {
        return Notification::of(self::of($model));
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public static function toModels(Collection $collection): Collection
    {
        return $collection->transform(function ($item) {
            return $item instanceof DatabaseNotification ? self::toModel($item) : $item;
        });
    }

    /**
     * @return DomainModel
     */
    public function notifiable(): DomainModel
    {
        $resource = $this->eloquent->notifiable;
        return EloquentRepository::assign($resource);
    }

    /**
     * @param  mixed $query
     * @param  array $args
     * @return mixed
     */
    public static function build($query, array $args = [])
    {
        $query = parent::build($query, $args);
        $args  = collect($args);

        return $query;
    }

}
