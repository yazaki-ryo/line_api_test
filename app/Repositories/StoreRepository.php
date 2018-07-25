<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentStore;
use App\Services\Collection\DomainCollection;
use Domain\Contracts\Model\DomainModelable;
use Domain\Models\Prefecture;
use Domain\Models\Store;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;

final class StoreRepository implements DomainModelable
{
    /** @var EloquentStore */
    private $eloquent;

    /**
     * @param EloquentStore|null $eloquent
     * @return void
     */
    public function __construct(EloquentStore $eloquent = null)
    {
        $this->eloquent = $eloquent;
        $this->eloquent = is_null($eloquent) ? new EloquentStore: $eloquent;
    }

    /**
     * @param int $id
     * @return Store|null
     */
    public function findById(int $id): ?Store
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
     * @return Prefecture|null
     */
    public function prefecture(): ?Prefecture
    {
        if (is_null($resource = $this->eloquent->prefecture)) {
            return null;
        }
        return PrefectureRepository::toModel($resource);
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
