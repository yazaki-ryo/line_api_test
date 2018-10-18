<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentStore;
use App\Services\DomainCollection;
use Domain\Contracts\Model\DomainableContract;
use Domain\Models\Company;
use Domain\Models\Customer;
use Domain\Models\DomainModel;
use Domain\Models\Prefecture;
use Domain\Models\Reservation;
use Domain\Models\Store;
use Domain\Models\Tag;
use Domain\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class StoreRepository extends EloquentRepository implements DomainableContract
{
    /** @var EloquentStore */
    protected $eloquent;

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
     * @param Model $model
     * @return DomainModel
     */
    public static function toModel(Model $model): DomainModel
    {
        return Store::of(self::of($model));
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public static function toModels(Collection $collection): Collection
    {
        return $collection->transform(function (EloquentStore $item) {
            return self::toModel($item);
        });
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
    public function reservations(array $args = []): DomainCollection
    {
        $collection = ReservationRepository::build($this->eloquent->reservations(), $args)->get();
        return ReservationRepository::toModels($collection);
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
     * @return Customer
     */
    public function addCustomer(array $args = []): Customer
    {
        if (is_null($resource = $this->eloquent->customers()->create($args))) {
            return null;
        }
        return CustomerRepository::toModel($resource);
    }

    /**
     * @param  array $args
     * @return Reservation
     */
    public function addReservation(array $args = []): Reservation
    {
        if (is_null($resource = $this->eloquent->reservations()->create($args))) {
            return null;
        }
        return ReservationRepository::toModel($resource);
    }

    /**
     * @param  array $args
     * @return Tag
     */
    public function addTag(array $args = []): Tag
    {
        if (is_null($resource = $this->eloquent->tags()->create($args))) {
            return null;
        }
        return TagRepository::toModel($resource);
    }

   /**
    * @param  array $args
    * @return User
    */
    public function addUser(array $args = []): User
    {
        if (is_null($resource = $this->eloquent->users()->create($args))) {
            return null;
        }
        return UserRepository::toModel($resource);
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
     * @param  mixed $query
     * @param  array $args
     * @return mixed
     */
    public static function build($query, array $args = [])
    {
        $args = collect($args);

        $query->when($args->has($key = 'id'), function (Builder $q) use ($key, $args) {
            $q->id($args->get($key));
        });

        $query->when($args->has($key = 'ids') && is_array($args->get($key)), function (Builder $q) use ($key, $args) {
            $q->ids($args->get($key));
        });

        $query->when($args->has($key = 'company_id'), function (Builder $q) use ($key, $args) {
            $q->companyId($args->get($key));
        });

        return $query;
    }

}
