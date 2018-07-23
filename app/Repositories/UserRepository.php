<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentUser;
use App\Services\Collection\DomainCollection;
use Domain\Contracts\Model\DomainModel;
use Domain\Contracts\Model\DomainModels;
use Domain\Models\Company;
use Domain\Models\Store;
use Domain\Models\Role;
use Domain\Models\User;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;

final class UserRepository implements DomainModel, DomainModels
{
    /** @var EloquentUser */
    private $eloquent;

    /**
     * @param EloquentUser|null $eloquent
     * @return void
     */
    public function __construct(EloquentUser $eloquent = null)
    {
        $this->eloquent = is_null($eloquent) ? new EloquentUser : $eloquent;
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function findById(int $id): ?User
    {
        if (is_null($resource = $this->eloquent->find($id))) {
            return null;
        }
        return self::toModel($resource);
    }

    /**
     * @return DomainCollection
     */
    public function findAll(): DomainCollection
    {
        $collection = $this->eloquent->all();
        return self::toModels($collection);
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return bool
     */
    public function update(int $id, array $attributes = []): bool
    {
        if (is_null($resource = $this->eloquent->find($id))) {
            return false;
        }

        return $resource->update($attributes);
    }

    /**
     * @param Model $model
     * @param \Illuminate\Database\Eloquent\Model;
     * @return User
     */
    public static function toModel(Model $model): User
    {
        return User::of(self::of($model));
    }

    /**
     * @param EloquentCollection $collection
     * @return DomainCollection
     */
    public static function toModels(EloquentCollection $collection): DomainCollection
    {
        return $collection->transform(function (EloquentUser $item) {
            return self::toModel($item);
        });
    }

    /**
     * @return array
     */
    public function attributesToArray(): array
    {
        return $this->eloquent->attributesToArray();
    }

    /**
     * @return Role
     */
    public function role(): Role
    {
        $resource = $this->eloquent->role;
        return RoleRepository::toModel($resource);
    }

    /**
     * @return Company
     */
    public function company(): Company
    {
        $resource = $this->eloquent->company;
        return CompanyRepository::toModel($resource);
    }

    /**
     * @return Store
     */
    public function store(): Store
    {
        $resource = $this->eloquent->store;
        return StoreRepository::toModel($resource);
    }

    /**
     * @return DomainCollection
     */
    public function permissions(): DomainCollection
    {
        $collection = $this->eloquent->permissions;
        return PermissionRepository::toModels($collection);
    }

    /**
     * @param EloquentUser $eloquent
     * @return self
     */
    private static function of(EloquentUser $eloquent)
    {
        return new self($eloquent);
    }

}
