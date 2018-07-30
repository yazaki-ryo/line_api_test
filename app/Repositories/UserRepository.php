<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentUser;
use App\Services\Collection\DomainCollection;
use Domain\Contracts\Model\DomainModelable;
use Domain\Models\Company;
use Domain\Models\Store;
use Domain\Models\Role;
use Domain\Models\User;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;

final class UserRepository implements DomainModelable
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
     * @param array $args
     * @return DomainCollection
     */
    public function findAll(array $args = []): DomainCollection
    {
        /**
         * TODO Search process.
         */

        $collection = $this->eloquent->all();
        return self::toModels($collection);
    }

    /**
     * @param int $id
     * @param array $args
     * @return bool
     */
    public function update(int $id, array $args = []): bool
    {
        if (is_null($resource = $this->eloquent->find($id))) {
            return false;
        }
        return $resource->update($args);
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
