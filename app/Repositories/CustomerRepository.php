<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentCustomer;
use App\Services\DomainCollection;
use Domain\Contracts\Model\DomainableContract;
use Domain\Models\Company;
use Domain\Models\DomainModel;
use Domain\Models\Customer;
use Domain\Models\Prefecture;
use Domain\Models\Sex;
use Domain\Models\Store;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class CustomerRepository extends EloquentRepository implements DomainableContract
{
    /** @var EloquentCustomer */
    protected $eloquent;

    /**
     * @param EloquentCustomer|null $eloquent
     * @return void
     */
    public function __construct(EloquentCustomer $eloquent = null)
    {
        $this->eloquent = is_null($eloquent) ? new EloquentCustomer : $eloquent;
    }

    /**
     * @param Model $model
     * @return Customer
     */
    public static function toModel(Model $model): DomainModel
    {
        return Customer::of(self::of($model));
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public static function toModels(Collection $collection): Collection
    {
        return $collection->transform(function (EloquentCustomer $item) {
            return self::toModel($item);
        });
    }

    /**
     * @return Company|null
     */
    public function company(): ?Company
    {
        if (is_null($resource = optional($this->eloquent->store)->company)) {
            return null;
        }
        return CompanyRepository::toModel($resource);
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
     * @return Sex|null
     */
    public function sex(): ?Sex
    {
        if (is_null($resource = $this->eloquent->sex)) {
            return null;
        }

        return SexRepository::toModel($resource);
    }

    /**
     * @return Store|null
     */
    public function store(): ?Store
    {
        if (is_null($resource = $this->eloquent->store)) {
            return null;
        }

        return StoreRepository::toModel($resource);
    }

    /**
     * @param  array $args
     * @return DomainCollection
     */
    public function tags(array $args = []): DomainCollection
    {
        $collection = TagRepository::build($this->eloquent->tags(), $args)->get();
        return TagRepository::toModels($collection);
    }

    /**
     * @param  array $args
     * @return DomainCollection
     */
    public function visitedHistories(array $args = []): DomainCollection
    {
        $collection = VisitedHistoryRepository::build($this->eloquent->visitedHistories(), $args)->get();
        return VisitedHistoryRepository::toModels($collection);
    }

    /**
     * @param  mixed $query
     * @param  array $args
     * @return mixed
     */
    public static function build($query, array $args = [])
    {
        $args = collect($args);

        $query->when($args->has($key = 'company_id'), function (Builder $q) use ($key, $args) {
            $q->companyId($args->get($key));
        });

        $query->when($args->has($key = 'store_id'), function (Builder $q) use ($key, $args) {
            $q->storeId($args->get($key));
        });

        $query->when($args->has($key = 'free_word'), function (Builder $q) use ($key, $args) {
            $q->freeWord($args->get($key));
        });

        $query->when($args->has($key = 'trashed'), function (Builder $q1) use ($key, $args) {
            $q1->when((int)$args->get($key) === 2, function (Builder $q2) {
                $q2->withTrashed();
            });
            $q1->when((int)$args->get($key) === 3, function (Builder $q2) {
                $q2->onlyTrashed();
            });
        });

        return $query;
    }
}
