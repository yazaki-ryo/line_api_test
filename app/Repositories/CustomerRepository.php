<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentCustomer;
use App\Services\Collection\DomainCollection;
use Domain\Contracts\Model\DomainModelable;
use Domain\Models\Company;
use Domain\Models\Customer;
use Domain\Models\Prefecture;
use Domain\Models\Sex;
use Domain\Models\Store;
use Illuminate\Database\Eloquent\Builder;
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
     * @param bool $trashed
     * @return Customer|null
     */
    public function findById(int $id, bool $trashed = false): ?Customer
    {
        $resource = $this->eloquent->newQuery()
            ->when($trashed, function (Builder $query) {
                $query->onlyTrashed();
            })->find($id);

        if (is_null($resource)) {
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
        $collection = $this->search($args)->get();
        return self::toModels($collection);
    }

    /**
     * @param array $args
     * @return Customer|null
     */
    public function create(array $args = []): ?Customer
    {
        if (is_null($resource = $this->eloquent->create($args))) {
            return null;
        }
        return self::toModel($resource);
    }

    /**
     * @param int $id
     * @param array $args
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
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        if (! is_null($resource = $this->eloquent->find($id))) {
            $resource->delete();
        }
    }

    /**
     * @param int $id
     * @return void
     */
    public function restore(int $id): void
    {
        if (! is_null($resource = $this->eloquent->onlyTrashed()->find($id))) {
            $resource->restore();
        }
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
     * @return DomainCollection
     */
    public function tags(): DomainCollection
    {
        $collection = $this->eloquent->tags;
        return TagRepository::toModels($collection);
    }

    /**
     * @param EloquentCustomer $eloquent
     * @return self
     */
    private static function of(EloquentCustomer $eloquent)
    {
        return new self($eloquent);
    }

    /**
     * @param array $args
     * @return Builder
     */
    private function search(array $args = []): Builder
    {
        $args = collect($args);
        $query = $this->eloquent->newQuery();

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
