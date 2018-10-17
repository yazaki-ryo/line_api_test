<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentReservation;
use Domain\Contracts\Model\DomainableContract;
use Domain\Exceptions\DomainRuleException;
use Domain\Models\Customer;
use Domain\Models\DomainModel;
use Domain\Models\Reservation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class ReservationRepository extends EloquentRepository implements DomainableContract
{
    /** @var EloquentReservation */
    protected $eloquent;

    /**
     * @param EloquentReservation|null $eloquent
     * @return void
     */
    public function __construct(EloquentReservation $eloquent = null)
    {
        $this->eloquent = is_null($eloquent) ? new EloquentReservation : $eloquent;
    }

    /**
     * @param Model $model
     * @return DomainModel
     */
    public static function toModel(Model $model): DomainModel
    {
        return Reservation::of(self::of($model));
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public static function toModels(Collection $collection): Collection
    {
        return $collection->transform(function (EloquentReservation $item) {
            return self::toModel($item);
        });
    }

    /**
     * @return Customer|null
     * @throws DomainRuleException
     */
    public function customer(): ?Customer
    {
        if (is_null($resource = $this->eloquent->customer)) {
            return null;
        }

        return CustomerRepository::toModel($resource);
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

        $query->when($args->has($key = 'store_id'), function (Builder $q) use ($key, $args) {
            $q->storeId((int)$args->get($key));
        });

        return $query;
    }

}
