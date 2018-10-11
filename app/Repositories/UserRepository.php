<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentUser;
use App\Services\DomainCollection;
use App\Traits\Repositories\Authorizable;
use App\Traits\Repositories\Notifiable;
use Domain\Contracts\Model\DomainableContract;
use Domain\Models\Avatar;
use Domain\Models\Company;
use Domain\Models\DomainModel;
use Domain\Models\Role;
use Domain\Models\Store;
use Domain\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class UserRepository extends EloquentRepository implements DomainableContract
{
    use Authorizable, Notifiable;

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
     * @param  array $args
     * @return DomainCollection
     */
    public function avatars(array $args = []): DomainCollection
    {
        $collection = AvatarRepository::build($this->eloquent->avatars(), $args)->get();
        return AvatarRepository::toModels($collection);
    }

    /**
     * @param  array $args
     * @return Avatar
     */
    public function addAvatar(array $args = []): Avatar
    {
        if (is_null($resource = $this->eloquent->avatars()->create($args))) {
            return null;
        }
        return AvatarRepository::toModel($resource);
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
     * @param  mixed $query
     * @param  array $args
     * @return mixed
     */
    public static function build($query, array $args = [])
    {
        $args = collect($args);

        $query->when($args->has($key = 'id'), function (Builder $q) use ($key, $args) {
            $q->id($args->get($key));
        });

        $query->when($args->has($key = 'ids') && is_array($args->get($key)), function (Builder $q) use ($key, $args) {
            $q->ids($args->get($key));
        });

        $query->when($args->has($key = 'store_id') && ! is_null($args->get($key)), function (Builder $q) use ($key, $args) {
            $q->storeId($args->get($key));
        });

        return $query;
    }

}
