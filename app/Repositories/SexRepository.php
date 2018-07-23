<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentSex;
use App\Services\Collection\DomainCollection;
use Domain\Contracts\Model\DomainModel;
use Domain\Contracts\Model\DomainModels;
use Domain\Models\Sex;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;

final class SexRepository implements DomainModel, DomainModels
{
    /** @var EloquentSex */
    private $eloquent;

    /**
     * @param EloquentSex|null $eloquent
     * @return void
     */
    public function __construct(EloquentSex $eloquent = null)
    {
        $this->eloquent = is_null($eloquent) ? new EloquentSex: $eloquent;
    }

    /**
     * @param int $id
     * @return Sex|null
     */
    public function findById(int $id): ?Sex
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
     * @return Sex
     */
    public static function toModel(Model $model): Sex
    {
        return Sex::of(self::of($model));
    }

    /**
     * @param EloquentCollection $collection
     * @return DomainCollection
     */
    public static function toModels(EloquentCollection $collection): DomainCollection
    {
        return $collection->transform(function (EloquentSex $item) {
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
    public function customers(): DomainCollection
    {
        $collection = $this->eloquent->customers;
        return CustomerRepository::toModels($collection);
    }

    /**
     * @param EloquentSex $eloquent
     * @return self
     */
    private static function of(EloquentSex $eloquent)
    {
        return new self($eloquent);
    }

}
