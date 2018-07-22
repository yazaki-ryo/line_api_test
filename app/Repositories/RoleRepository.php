<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentRole;
use App\Services\Collection\DomainCollection;
use Domain\Contracts\Model\DomainModel;
use Domain\Contracts\Model\DomainModels;
use Domain\Models\Role;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;

final class RoleRepository implements DomainModel, DomainModels
{
    /** @var EloquentRole */
    private $eloquent;

    /**
     * @param EloquentRole|null $eloquent
     * @return void
     */
    public function __construct(EloquentRole $eloquent = null)
    {
        $this->eloquent = is_null($eloquent) ? new EloquentRole: $eloquent;
    }

    /**
     * @param int $id
     * @return Role|null
     */
    public function findById(int $id): ?Role
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
     * @param Model $model
     * @param \Illuminate\Database\Eloquent\Model;
     * @return Role
     */
    public static function toModel(Model $model): Role
    {
        return Role::of(self::of($model));
    }

    /**
     * @param EloquentCollection $collection
     * @return DomainCollection
     */
    public static function toModels(EloquentCollection $collection): DomainCollection
    {
        return $collection->transform(function (EloquentRole $item) {
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
     * @return DomainCollection
     */
    public function users(): DomainCollection
    {
        $collection = $this->eloquent->users;
        return UserRepository::toModels($collection);
    }

    /**
     * @param EloquentRole $eloquent
     * @return self
     */
    private static function of(EloquentRole $eloquent)
    {
        return new self($eloquent);
    }

}
