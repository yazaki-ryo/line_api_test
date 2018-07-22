<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentPlan;
use App\Services\Collection\DomainCollection;
use Domain\Contracts\Model\DomainModel;
use Domain\Contracts\Model\DomainModels;
use Domain\Models\Plan;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;

final class PlanRepository implements DomainModel, DomainModels
{
    /** @var EloquentPlan */
    private $eloquent;

    /**
     * @param EloquentPlan|null $eloquent
     * @return void
     */
    public function __construct(EloquentPlan $eloquent = null)
    {
        $this->eloquent = is_null($eloquent) ? new EloquentPlan: $eloquent;
    }

    /**
     * @param int $id
     * @return Plan|null
     */
    public function findById(int $id): ?Plan
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
     * @return Plan
     */
    public static function toModel(Model $model): Plan
    {
        return Plan::of(self::of($model));
    }

    /**
     * @param EloquentCollection $collection
     * @return DomainCollection
     */
    public static function toModels(EloquentCollection $collection): DomainCollection
    {
        return $collection->transform(function (EloquentPlan $item) {
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
    public function companies(): DomainCollection
    {
        $collection = $this->eloquent->companies;
        return CompanyRepository::toModels($collection);
    }

    /**
     * @param EloquentPlan $eloquent
     * @return self
     */
    private static function of(EloquentPlan $eloquent)
    {
        return new self($eloquent);
    }

}
