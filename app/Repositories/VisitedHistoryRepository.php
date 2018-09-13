<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentVisitedHistory;
use Domain\Contracts\Model\DomainableContract;
use Domain\Exceptions\DomainRuleException;
use Domain\Models\Customer;
use Domain\Models\DomainModel;
use Domain\Models\VisitedHistory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class VisitedHistoryRepository extends EloquentRepository implements DomainableContract
{
    /** @var EloquentVisitedHistory */
    protected $eloquent;

    /**
     * @param EloquentVisitedHistory|null $eloquent
     * @return void
     */
    public function __construct(EloquentVisitedHistory $eloquent = null)
    {
        $this->eloquent = is_null($eloquent) ? new EloquentVisitedHistory : $eloquent;
    }

    /**
     * @param Model $model
     * @return DomainModel
     */
    public static function toModel(Model $model): DomainModel
    {
        return VisitedHistory::of(self::of($model));
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public static function toModels(Collection $collection): Collection
    {
        return $collection->transform(function (EloquentVisitedHistory $item) {
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

        return $query;
    }

}
