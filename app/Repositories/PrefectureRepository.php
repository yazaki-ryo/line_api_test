<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentPrefecture;
use App\Services\Collection\DomainCollection;
use Domain\Contracts\Model\DomainModelable;
use Domain\Models\Prefecture;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;

final class PrefectureRepository implements DomainModelable
{
    /** @var EloquentPrefecture */
    private $eloquent;

    /**
     * @param EloquentPrefecture|null $eloquent
     * @return void
     */
    public function __construct(EloquentPrefecture $eloquent = null)
    {
        $this->eloquent = is_null($eloquent) ? new EloquentPrefecture: $eloquent;
    }

    /**
     * @param int $id
     * @return Prefecture|null
     */
    public function findById(int $id): ?Prefecture
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
        $collection = $this->build($this->newQuery(), $args)->get();
        return self::toModels($collection);
    }

    /**
     * @param Model $model
     * @param \Illuminate\Database\Eloquent\Model;
     * @return Prefecture
     */
    public static function toModel(Model $model): Prefecture
    {
        return Prefecture::of(self::of($model));
    }

    /**
     * @param EloquentCollection $collection
     * @return DomainCollection
     */
    public static function toModels(EloquentCollection $collection): DomainCollection
    {
        return $collection->transform(function (EloquentPrefecture $item) {
            return self::toModel($item);
        });
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
     * @return DomainCollection
     */
    public function customers(): DomainCollection
    {
        $collection = $this->eloquent->customers;
        return CustomerRepository::toModels($collection);
    }

    /**
     * @return DomainCollection
     */
    public function stores(): DomainCollection
    {
        $collection = $this->eloquent->stores;
        return StoreRepository::toModels($collection);
    }

    /**
     * @return array
     */
    public function attributesToArray(): array
    {
        return $this->eloquent->attributesToArray();
    }

    /**
     * @param EloquentPrefecture $eloquent
     * @return self
     */
    private static function of(EloquentPrefecture $eloquent)
    {
        return new self($eloquent);
    }

    /**
     * @return Builder
     */
    private function newQuery(): Builder
    {
        return $this->eloquent->newQuery();
    }

    /**
     * @param Builder $query
     * @param array $args
     * @return Builder
     */
    private function build(Builder $query, array $args = []): Builder
    {
        $args = collect($args);

        return $query;
    }

}
