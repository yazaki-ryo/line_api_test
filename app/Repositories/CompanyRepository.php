<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentCompany;
use App\Services\DomainCollection;
use Domain\Contracts\Model\DomainableInterface;
use Domain\Models\Company;
use Domain\Models\Plan;
use Domain\Models\Prefecture;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;

final class CompanyRepository implements DomainableInterface
{
    /** @var EloquentCompany */
    private $eloquent;

    /**
     * @param EloquentCompany|null $eloquent
     * @return void
     */
    public function __construct(EloquentCompany $eloquent = null)
    {
        $this->eloquent = is_null($eloquent) ? new EloquentCompany: $eloquent;
    }

    /**
     * @param int $id
     * @return Company|null
     */
    public function findById(int $id): ?Company
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
     * @param  int $id
     * @param  array $args
     * @return bool
     */
    public function update(int $id, array $args = []): bool
    {
        if (is_null($resource = $this->eloquent->find($id))) {
            return false;
        }
        return $resource->update($args);
    }

    /**
     * @param Model $model
     * @param \Illuminate\Database\Eloquent\Model;
     * @return Company
     */
    public static function toModel(Model $model): Company
    {
        return Company::of(self::of($model));
    }

    /**
     * @param EloquentCollection $collection
     * @return DomainCollection
     */
    public static function toModels(EloquentCollection $collection): DomainCollection
    {
        return $collection->transform(function (EloquentCompany $item) {
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
     * @param  array $args
     * @return DomainCollection
     */
    public function customers(array $args = []): DomainCollection
    {
        $collection = CustomerRepository::build($this->eloquent->customers(), $args)->get();
        return CustomerRepository::toModels($collection);
    }

    /**
     * @param  array $args
     * @return DomainCollection
     */
    public function users(array $args = []): DomainCollection
    {
        $collection = UserRepository::build($this->eloquent->users(), $args)->get();
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
     * @param EloquentCompany $eloquent
     * @return self
     */
    private static function of(EloquentCompany $eloquent)
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
    public static function build(Builder $query, array $args = []): Builder
    {
        $args = collect($args);

        return $query;
    }

}
