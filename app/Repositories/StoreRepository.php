<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentStore;
use App\Services\Collection\DomainCollection;
use Domain\Contracts\Model\DomainModelable;
use Domain\Models\Company;
use Domain\Models\Prefecture;
use Domain\Models\Store;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;

final class StoreRepository implements DomainModelable
{
    /** @var EloquentStore */
    private $eloquent;

    /**
     * @param EloquentStore|null $eloquent
     * @return void
     */
    public function __construct(EloquentStore $eloquent = null)
    {
        $this->eloquent = $eloquent;
        $this->eloquent = is_null($eloquent) ? new EloquentStore: $eloquent;
    }

    /**
     * @param int $id
     * @return Store|null
     */
    public function findById(int $id): ?Store
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
        $collection = $this->search($args)->get();
        return self::toModels($collection);
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
     * @param Model $model
     * @param \Illuminate\Database\Eloquent\Model;
     * @return Store
     */
    public static function toModel(Model $model): Store
    {
        return Store::of(self::of($model));
    }

    /**
     * @param EloquentCollection $collection
     * @return DomainCollection
     */
    public static function toModels(EloquentCollection $collection): DomainCollection
    {
        return $collection->transform(function (EloquentStore $item) {
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
        if (is_null($resource = $this->eloquent->company)) {
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
     * @return DomainCollection
     */
    public function users(): DomainCollection
    {
        $collection = $this->eloquent->users;
        return UserRepository::toModels($collection);
    }

    /**
     * @param EloquentStore $eloquent
     * @return self
     */
    private static function of(EloquentStore $eloquent)
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

        $query->when($args->has($key = 'id'), function (Builder $q) use ($key, $args) {
            $q->id($args->get($key));
        });

        $query->when($args->has($key = 'company_id'), function (Builder $q) use ($key, $args) {
            $q->companyId($args->get($key));
        });

        return $query;
    }

}
