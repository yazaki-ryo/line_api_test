<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentUser;
use App\Services\DomainCollection;
use Domain\Contracts\Model\DomainableInterface;
use Domain\Models\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;

final class NotificationRepository implements DomainableInterface
{
    /** @var DatabaseNotification */
    private $eloquent;

    /**
     * @param DatabaseNotification|null $eloquent
     * @return void
     */
    public function __construct(DatabaseNotification $eloquent = null)
    {
        $this->eloquent = is_null($eloquent) ? new DatabaseNotification: $eloquent;
    }

    /**
     * @param int $id
     * @return Notification|null
     */
    public function findById(int $id): ?Notification
    {
        if (is_null($resource = $this->eloquent->find($id))) {
            return null;
        }
        return self::toModel($resource);
    }

    /**
     * @param array $args
     * @return DomainCollection
     */
    public function findAll(array $args = []): DomainCollection
    {
        $collection = $this->build($this->newQuery(), $args)->get();
        return self::toModels($collection);
    }

    /**
     * @param Model $model
     * @param \Illuminate\Database\Eloquent\Model;
     * @return Notification
     */
    public static function toModel(Model $model): Notification
    {
        return Notification::of(self::of($model));
    }

    /**
     * @param EloquentCollection $collection
     * @return DatabaseNotificationCollection
     */
    public static function toModels(EloquentCollection $collection): DatabaseNotificationCollection
    {
        return $collection->transform(function (DatabaseNotification $item) {
            return self::toModel($item);
        });
    }

    /**
     * @return mixed [Some notifiable model.]
     */
    public function notifiable()
    {
        $resource = $this->eloquent->notifiable;

        if ($resource instanceof EloquentUser) {
            return UserRepository::toModel($resource);
        }

        return null;
    }

    /**
     * @return array
     */
    public function attributesToArray(): array
    {
        return $this->eloquent->attributesToArray();
    }

    /**
     * @param DatabaseNotification $eloquent
     * @return self
     */
    private static function of(DatabaseNotification $eloquent)
    {
        return new self($eloquent);
    }

    /**
     * @return Builder
     */
    private function newQuery(): Builder
    {
        return $this->eloquent->newQuery();
    }

    /**
     * @param  mixed $query
     * @param  array $args
     * @return mixed
     */
    public static function build($query, array $args = [])
    {
        $args = collect($args);

        return $query;
    }

}
