<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentPlan;
use App\Services\DomainCollection;
use Domain\Contracts\Model\DomainableContract;
use Domain\Models\DomainModel;
use Domain\Models\Plan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class PlanRepository extends EloquentRepository implements DomainableContract
{
    /**
     * @param EloquentPlan|null $eloquent
     * @return void
     */
    public function __construct(EloquentPlan $eloquent = null)
    {
        $this->eloquent = is_null($eloquent) ? new EloquentPlan: $eloquent;
    }

    /**
     * @param Model $model
     * @return DomainModel
     */
    public static function toModel(Model $model): DomainModel
    {
        return Plan::of(self::of($model));
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public static function toModels(Collection $collection): Collection
    {
        return $collection->transform(function ($item) {
            return $item instanceof EloquentPlan ? self::toModel($item) : $item;
        });
    }

    /**
     * @param  array $args
     * @return DomainCollection
     */
    public function companies(array $args = []): DomainCollection
    {
        $collection = empty($args) ? $this->eloquent->companies : CompanyRepository::build($this->eloquent->companies(), $args)->get();
        return CompanyRepository::toModels($collection);
    }

    /**
     * @param  mixed $query
     * @param  array $args
     * @return mixed
     */
    public static function build($query, array $args = [])
    {
        $query = parent::build($query, $args);
        $args  = collect($args);

        return $query;
    }

}
