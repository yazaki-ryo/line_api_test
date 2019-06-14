<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentSeat;
use App\Services\DomainCollection;
use Domain\Contracts\Model\DomainableContract;
use Domain\Models\DomainModel;
use Domain\Models\Store;
use Domain\Models\Seat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class SeatRepository extends EloquentRepository implements DomainableContract
{
    /**
     * @param EloquentSeat|null $eloquent
     * @return void
     */
    public function __construct(EloquentSeat $eloquent = null)
    {
        $this->eloquent = is_null($eloquent) ? new EloquentSeat: $eloquent;
    }

    /**
     * @param Model $model
     * @return DomainModel
     */
    public static function toModel(Model $model): DomainModel
    {
        return Tag::of(self::of($model));
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public static function toModels(Collection $collection): Collection
    {
        return $collection->transform(function ($item) {
            return $item instanceof EloquentSeat ? self::toModel($item) : $item;
        });
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
     * @param  mixed $query
     * @param  array $args
     * @return mixed
     */
    public static function build($query, array $args = [])
    {
        $query = parent::build($query, $args);
        $args  = collect($args);

        $query->when($args->has($key = 'store_id') && ! is_null($args->get($key)), function (Builder $q) use ($key, $args) {
            $q->storeId($args->get($key));
        });

        return $query;
    }

}
