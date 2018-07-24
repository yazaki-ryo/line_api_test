<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentPermission;
use App\Services\Collection\DomainCollection;
use Domain\Contracts\Model\DomainModelable;
use Domain\Models\Permission;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;

final class PermissionRepository implements DomainModelable
{
    /** @var EloquentPermission */
    private $eloquent;

    /**
     * @param EloquentPermission|null $eloquent
     * @return void
     */
    public function __construct(EloquentPermission $eloquent = null)
    {
        $this->eloquent = is_null($eloquent) ? new EloquentPermission: $eloquent;
    }

    /**
     * @param int $id
     * @return Permission|null
     */
    public function findById(int $id): ?Permission
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
     * @return Permission
     */
    public static function toModel(Model $model): Permission
    {
        return Permission::of(self::of($model));
    }

    /**
     * @param EloquentCollection $collection
     * @return DomainCollection
     */
    public static function toModels(EloquentCollection $collection): DomainCollection
    {
        return $collection->transform(function (EloquentPermission $item) {
            return self::toModel($item);
        });
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
     * @return array
     */
    public function attributesToArray(): array
    {
        return $this->eloquent->attributesToArray();
    }

    /**
     * @param EloquentPermission $eloquent
     * @return self
     */
    private static function of(EloquentPermission $eloquent)
    {
        return new self($eloquent);
    }

}
