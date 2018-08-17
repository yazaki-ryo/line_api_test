<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentUser;
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
    /** @var DatabaseNotification */
    protected $eloquent;

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
