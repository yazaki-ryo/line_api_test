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
use Domain\Models\Seat;
use Domain\Models\MailHistory;
use Domain\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class StoreRepository extends EloquentRepository implements DomainableContract
{
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
        return $collection->transform(function ($item) {
            return $item instanceof EloquentStore ? self::toModel($item) : $item;
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
//        $collection = empty($args) ? $this->eloquent->customers : CustomerRepository::build($this->eloquent->customers(), $args)->get();
        if (empty($args)) {
          $collection = $this->eloquent->customers;
        } else {
          $query = CustomerRepository::build($this->eloquent->customers(), $args);
          $collection = $query->get();
        }
        return CustomerRepository::toModels($collection);
    }
    
    public function numCustomers(array $args = []): int
    {
        if (empty($args)) {
            return $this->eloquent->customers->count();
        } else {
            $options = [];
            foreach ($args as $key => $value) {
              if ($key !== 'page') {
                $options[$key] = $value;
              }
            }
            return CustomerRepository::build($this->eloquent->customers(), $options)->count();
        }
    }

    /**
     * @param  array $args
     * @return DomainCollection
     */
    public function reservations(array $args = []): DomainCollection
    {
        $collection = empty($args) ? $this->eloquent->reservations : ReservationRepository::build($this->eloquent->reservations(), $args)->get();
        return ReservationRepository::toModels($collection);
    }
    
    public function numReservations(array $args = []): int
    {
        if (empty($args)) {
            return $this->eloquent->reservations->count();
        } else {
            $options = [];
            foreach ($args as $key => $value) {
              if ($key !== 'page') {
                $options[$key] = $value;
              }
            }
            return ReservationRepository::build($this->eloquent->reservations(), $options)->count();
        }
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
    public function seats(array $args = []): DomainCollection
    {
        $collection = empty($args) ? $this->eloquent->seats : SeatRepository::build($this->eloquent->seats(), $args)->get();
        return SeatRepository::toModels($collection);
    }

    /**
     * @param  array $args
     * @return Customer
     */
    public function addCustomer(array $args = []): Customer
    {
        $resource = $this->eloquent->customers()->create($args);
        return CustomerRepository::toModel($resource);
    }

    /**
     * @param  array $args
     * @return Reservation
     */
    public function addReservation(array $args = []): Reservation
    {
        $resource = $this->eloquent->reservations()->create($args);
        return ReservationRepository::toModel($resource);
    }

    /**
     * @param  array $args
     * @return Tag
     */
    public function addTag(array $args = []): Tag
    {
        $resource = $this->eloquent->tags()->create($args);
        return TagRepository::toModel($resource);
    }

    /**
     * @param  array $args
     * @return Seat
     */
    public function addSeat(array $args = []): Seat
    { 
        $resource = $this->eloquent->seats()->create($args);
        return SeatRepository::toModel($resource);
    }

   /**
    * @param  array $args
    * @return User
    */
    public function addUser(array $args = []): User
    {
        $resource = $this->eloquent->users()->create($args);
        return UserRepository::toModel($resource);
    }

    /**
     * @param  array $args
     * @return MailHistory
     */
    public function addMailHistory(array $args = []): MailHistory
    {
        $resource = $this->eloquent->mailHistories()->create($args);
        return MailHistoryRepository::toModel($resource);
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


    public function mailHistories(array $args = []): DomainCollection
    {
        if (empty($args)) {
            $collection = $this->eloquent->mailHistories;
          } else {
            $query = MailHistoryRepository::build($this->eloquent->mailHistories(), $args);
            $collection = $query->get();
          }
          return MailHistoryRepository::toModels($collection);
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

        $query->when($args->has($key = 'company_id'), function (Builder $q) use ($key, $args) {
            $q->companyId($args->get($key));
        });

        return $query;
    }

}
