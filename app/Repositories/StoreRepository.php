<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentStore;
use App\Services\Collection\DomainCollection;
use Domain\Contracts\Model\DomainModel;
use Domain\Contracts\Model\DomainModels;
use Domain\Models\Store;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;

final class StoreRepository implements DomainModel, DomainModels
{
    /** @var EloquentStore */
    private $eloquent;

    /**
     * @param EloquentStore $eloquent
     * @return void
     */
    public function __construct(EloquentStore $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    /**
     * @param int $id
     * @return Store
     */
    public function findById(int $id): Store
    {
        $role = $this->eloquent->find($id);

        return self::toModel($role);
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
     * @return Store
     */
    public static function toModel(Model $model): Store
    {
        return Store::of(self::of($model));
    }

    /**
     * @param EloquentCollection $collection
     * @return DomainCollection
     */
    public static function toModels(EloquentCollection $collection): DomainCollection
    {
        return $collection->transform(function (EloquentStore $item) {
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
     * @param EloquentStore $eloquent
     * @return self
     */
    private static function of(EloquentStore $eloquent)
    {
        return new self($eloquent);
    }

}
