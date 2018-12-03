<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentCompany;
use App\Services\DomainCollection;
use Domain\Contracts\Model\DomainableContract;
use Domain\Models\Company;
use Domain\Models\DomainModel;
use Domain\Models\Plan;
use Domain\Models\Prefecture;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class CompanyRepository extends EloquentRepository implements DomainableContract
{
    /**
     * @param EloquentCompany|null $eloquent
     * @return void
     */
    public function __construct(EloquentCompany $eloquent = null)
    {
        $this->eloquent = is_null($eloquent) ? new EloquentCompany: $eloquent;
    }

    /**
     * @param Model $model
     * @return DomainModel
     */
    public static function toModel(Model $model): DomainModel
    {
        return Company::of(self::of($model));
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public static function toModels(Collection $collection): Collection
    {
        return $collection->transform(function ($item) {
            return $item instanceof EloquentCompany ? self::toModel($item) : $item;
        });
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
     * @param  array $args
     * @return DomainCollection
     */
    public function tags(array $args = []): DomainCollection
    {
        $collection = empty($args) ? $this->eloquent->tags : TagRepository::build($this->eloquent->tags(), $args)->get();
        return TagRepository::toModels($collection);
    }

    /**
     * @param  array $args
     * @return DomainCollection
     */
    public function users(array $args = []): DomainCollection
    {
        $collection = empty($args) ? $this->eloquent->users : UserRepository::build($this->eloquent->users(), $args)->get();
        return UserRepository::toModels($collection);
    }

    /**
     * @return Plan|null
     */
    public function plan(): ?Plan
    {
        if (is_null($resource = $this->eloquent->plan)) {
            return null;
        }
        return PlanRepository::toModel($resource);
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
