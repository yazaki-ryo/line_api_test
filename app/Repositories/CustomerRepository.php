<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentCustomer;
use App\Services\Collection\DomainCollection;
use Domain\Contracts\Model\DomainModel;
use Domain\Contracts\Model\DomainModels;
use Domain\Models\Company;
use Domain\Models\Store;
use Domain\Models\Role;
use Domain\Models\Customer;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;

final class CustomerRepository implements DomainModel, DomainModels
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
     * @return Customer|null
     */
    public function findById(int $id): ?Customer
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
     * @param array $attributes
     * @return bool
     */
    public function update(int $id, array $attributes = []): bool
    {
        if (is_null($resource = $this->eloquent->find($id))) {
            return false;
        }

        return $resource->update($attributes);
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

//     /**
//      * @return Role
//      */
//     public function role(): Role
//     {
//         $role = $this->eloquent->role;
//         return RoleRepository::toModel($role);
//     }

//     /**
//      * @return Company
//      */
//     public function company(): Company
//     {
//         $company = $this->eloquent->loadMissing('company')->company;
//         return CompanyRepository::toModel($company);
//     }

    /**
     * @return Store
     */
    public function store(): Store
    {
        $store = $this->eloquent->store;
        return StoreRepository::toModel($store);
    }

    /**
     * @param EloquentCustomer $eloquent
     * @return self
     */
    private static function of(EloquentCustomer $eloquent)
    {
        return new self($eloquent);
    }

}
