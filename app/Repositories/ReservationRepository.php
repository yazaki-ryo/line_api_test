<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentReservation;
use Carbon\Carbon;
use Domain\Contracts\Model\DomainableContract;
use Domain\Exceptions\DomainRuleException;
use Domain\Models\Customer;
use Domain\Models\DomainModel;
use Domain\Models\Reservation;
use Domain\Models\Store;
use Domain\Models\VisitedHistory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class ReservationRepository extends EloquentRepository implements DomainableContract
{
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
        return $collection->transform(function ($item) {
            return $item instanceof EloquentReservation ? self::toModel($item) : $item;
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
     * @return VisitedHistory|null
     */
    public function visitedHistory(): ?VisitedHistory
    {
        if (is_null($resource = $this->eloquent->visitedHistory)) {
            return null;
        }

        return VisitedHistoryRepository::toModel($resource);
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

        $query->when($args->has($key = 'store_id'), function (Builder $q) use ($key, $args) {
            $q->storeId((int)$args->get($key));
        });

        $query->when(($args->has($key = 'reserved_date') && ! is_null($args->get($key))), function (Builder $q) use ($args, $key) {
//            debug($key, $args->get($key));
            $q->reservedAt(Carbon::parse($args->get($key))->startOfDay(), Carbon::parse($args->get($key))->endOfDay());
        });

        $query->when($args->has($key = 'page') && $args->get($key) > 0, function (Builder $q) use ($key, $args) {
            $rows_in_page = $args->get('rows_in_page', 25);
            $page = $args->get($key, 1);
            $offset = ($page - 1) * $rows_in_page;
            $q->limit($rows_in_page)->offset($offset);
        });

        $query->when($args->has($key = 'sort') && is_numeric($args->get($key)), function (Builder $q) use ($key, $args) {
            $sorting = $args->get('sort');
            switch ($sorting) {
                case '2': // 予約日が遠い順 予約日時 降順
                    $q->orderByDesc('reserved_at');
                    break;
                default: // 予約日が近い順 予約日時 昇順
                    $q->orderBy('reserved_at');
                    break;
            }
        });
        
        return $query;
    }

}
