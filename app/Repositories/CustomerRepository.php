<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentCustomer;
use App\Services\Collection\DomainCollection;
use Domain\Contracts\Model\DomainModelable;
use Domain\Models\Customer;
use Domain\Models\Prefecture;
use Domain\Models\Sex;
use Domain\Models\Store;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;

final class CustomerRepository implements DomainModelable
{
    /** @var EloquentCustomer */
    private $eloquent;

    /**
     * @param EloquentCustomer|null $eloquent
     * @return void
     */
    public function __construct(EloquentCustomer $eloquent = null)
    {
        $this->eloquent = is_null($eloquent) ? new EloquentCustomer : $eloquent;
    }

    /**
     * @param int $id
     * @return Customer|null
     */
    public function findById(int $id): ?Customer
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
     * @return Customer
     */
    public static function toModel(Model $model): Customer
    {
        return Customer::of(self::of($model));
    }

    /**
     * @param EloquentCollection $collection
     * @return DomainCollection
     */
    public static function toModels(EloquentCollection $collection): DomainCollection
    {
        return $collection->transform(function (EloquentCustomer $item) {
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
     * @return Prefecture
     */
    public function prefecture(): Prefecture
    {
        $resource = $this->eloquent->prefecture;
        return PrefectureRepository::toModel($resource);
    }

    /**
     * @return Sex
     */
    public function sex(): Sex
    {
        $resource = $this->eloquent->sex;
        return SexRepository::toModel($resource);
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
     * @param EloquentCustomer $eloquent
     * @return self
     */
    private static function of(EloquentCustomer $eloquent)
    {
        return new self($eloquent);
    }

}
