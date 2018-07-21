<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentCompany;
use App\Services\Collection\DomainCollection;
use Domain\Contracts\Model\DomainModel;
use Domain\Contracts\Model\DomainModels;
use Domain\Models\Company;
use Domain\Models\Plan;
use Domain\Models\Prefecture;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;

final class CompanyRepository implements DomainModel, DomainModels
{
    /** @var EloquentCompany */
    private $eloquent;

    /**
     * @param EloquentCompany $eloquent
     * @return void
     */
    public function __construct(EloquentCompany $eloquent)
    {
        $this->eloquent = $eloquent;
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
     * @return DomainCollection
     */
    public function findAll(): DomainCollection
    {
        $collection = $this->eloquent->all();
        return self::toModels($collection);
    }

    /**
     * @param int $id
     * @param array $inputs
     * @return bool
     */
    public function update(int $id, array $inputs = []): bool
    {
        if (is_null($resource = $this->eloquent->find($id))) {
            return false;
        }

        return $resource->update($inputs);
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
     * @return DomainCollection
     */
    public function users(): DomainCollection
    {
        $collection = $this->eloquent->users;
        return UserRepository::toModels($collection);
    }

    /**
     * @return Plan
     */
    public function plan(): Plan
    {
        $plan = $this->eloquent->plan;
        return PlanRepository::toModel($plan);
    }

    /**
     * @return Prefecture
     */
    public function prefecture(): Prefecture
    {
        $prefecture = $this->eloquent->prefecture;
        return PrefectureRepository::toModel($prefecture);
    }

    /**
     * @param EloquentCompany $eloquent
     * @return self
     */
    private static function of(EloquentCompany $eloquent)
    {
        return new self($eloquent);
    }

}
