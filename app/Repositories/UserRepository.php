<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentUser;
use App\Services\DomainCollection;
use Domain\Contracts\Model\DomainableContract;
use Domain\Models\Company;
use Domain\Models\DomainModel;
use Domain\Models\Role;
use Domain\Models\Store;
use Domain\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Support\Collection;

final class UserRepository extends EloquentRepository implements DomainableContract
{
    /** @var EloquentUser */
    protected $eloquent;

    /**
     * @param EloquentUser|null $eloquent
     * @return void
     */
    public function __construct(EloquentUser $eloquent = null)
    {
        $this->eloquent = is_null($eloquent) ? new EloquentUser : $eloquent;
    }

    /**
     * @param Model $model
     * @return DomainModel
     */
    public static function toModel(Model $model): DomainModel
    {
        return User::of(self::of($model));
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public static function toModels(Collection $collection): Collection
    {
        return $collection->transform(function (EloquentUser $item) {
            return self::toModel($item);
        });
    }

    /**
     * @return Role|null
     */
    public function role(): ?Role
    {
        if (is_null($resource = $this->eloquent->role)) {
            return null;
        }
        return RoleRepository::toModel($resource);
    }

    /**
     * @return Company|null
     */
    public function company(): ?Company
    {
        if (is_null($resource = optional($this->eloquent->store)->company)) {
            return null;
        }
        return CompanyRepository::toModel($resource);
    }

    /**
     * @return Store|null
     */
    public function store(): ?Store
    {
        if (is_null($resource = $this->eloquent->store)) {
            return null;
        }
        return StoreRepository::toModel($resource);
    }

    /**
     * @param  array $args
     * @return DomainCollection
     */
    public function permissions(array $args = []): DomainCollection
    {
        $collection = PermissionRepository::build($this->eloquent->permissions(), $args)->get();
        return PermissionRepository::toModels($collection);
    }

    /**
     * @param  array $args
     * @return DomainCollection
     */
    public function notifications(array $args = []): DatabaseNotificationCollection
    {
        $collection = NotificationRepository::build($this->eloquent->notifications(), $args)->get();
        return NotificationRepository::toModels($collection);
    }

    /**
     * @param  array $args
     * @return DomainCollection
     */
    public function readNotifications(array $args = []): DatabaseNotificationCollection
    {
        $collection = NotificationRepository::build($this->eloquent->readNotifications(), $args)->get();
        return NotificationRepository::toModels($collection);
    }

    /**
     * @param  array $args
     * @return DomainCollection
     */
    public function unreadNotifications(array $args = []): DatabaseNotificationCollection
    {
        $collection = NotificationRepository::build($this->eloquent->unreadNotifications(), $args)->get();
        return NotificationRepository::toModels($collection);
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

    /**
     * @param  string  $ability
     * @param  array|mixed  $arguments
     * @return bool
     */
    public function can($ability, $arguments = []): bool
    {
        return $this->eloquent->can($ability, $arguments);
    }

    /**
     * @param  mixed  $instance
     * @return void
     */
    public function notify($instance): void
    {
        $this->eloquent->notify($instance);
    }

}
