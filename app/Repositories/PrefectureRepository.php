<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentPrefecture;
use App\Services\DomainCollection;
use Domain\Contracts\Model\DomainableContract;
use Domain\Models\DomainModel;
use Domain\Models\Prefecture;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class PrefectureRepository extends EloquentRepository implements DomainableContract
{
    /**
     * @param EloquentPrefecture|null $eloquent
     * @return void
     */
    public function __construct(EloquentPrefecture $eloquent = null)
    {
        $this->eloquent = is_null($eloquent) ? new EloquentPrefecture: $eloquent;
    }

    /**
     * @param Model $model
     * @return DomainModel
     */
    public static function toModel(Model $model): DomainModel
    {
        return Prefecture::of(self::of($model));
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public static function toModels(Collection $collection): Collection
    {
        return $collection->transform(function ($item) {
            return $item instanceof EloquentPrefecture ? self::toModel($item) : $item;
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
     * @param  array $args
     * @return DomainCollection
     */
    public function customers(array $args = []): DomainCollection
    {
        $collection = empty($args) ? $this->eloquent->customers : CustomerRepository::build($this->eloquent->customers(), $args)->get();
        return CustomerRepository::toModels($collection);
    }

    /**
     * @param  array $args
     * @return DomainCollection
     */
    public function stores(array $args = []): DomainCollection
    {
        $collection = empty($args) ? $this->eloquent->stores : StoreRepository::build($this->eloquent->stores(), $args)->get();
        return StoreRepository::toModels($collection);
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
