<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentCompany;
use App\Services\Collection\DomainCollection;
use Domain\Contracts\Model\DomainModel;
use Domain\Contracts\Model\DomainModels;
use Domain\Models\Company;
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
     * @return Company
     */
    public function findById(int $id): Company
    {
        $role = $this->eloquent->find($id);

        return self::toModel($role);
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
     * @param EloquentCompany $eloquent
     * @return self
     */
    private static function of(EloquentCompany $eloquent)
    {
        return new self($eloquent);
    }

}
