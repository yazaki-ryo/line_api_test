<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentVisitedHistory;
use App\Services\DomainCollection;
use Domain\Contracts\Model\DomainableContract;
use Domain\Exceptions\DomainRuleException;
use Domain\Models\Attachment;
use Domain\Models\Customer;
use Domain\Models\DomainModel;
use Domain\Models\Reservation;
use Domain\Models\VisitedHistory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class VisitedHistoryRepository extends EloquentRepository implements DomainableContract
{
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
        return $collection->transform(function ($item) {
            return $item instanceof EloquentVisitedHistory ? self::toModel($item) : $item;
        });
    }

    /**
     * @param  array $args
     * @return DomainCollection
     */
    public function attachments(array $args = []): DomainCollection
    {
        $collection = empty($args) ? $this->eloquent->attachments : AttachmentRepository::build($this->eloquent->attachments(), $args)->get();
        return AttachmentRepository::toModels($collection);
    }

    /**
     * @param  array $args
     * @return Attachment
     */
    public function addAttachment(array $args = []): Attachment
    {
        $resource = $this->eloquent->attachments()->create($args);
        return AttachmentRepository::toModel($resource);
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
     * @return Reservation|null
     */
    public function reservation(): ?Reservation
    {
        if (is_null($resource = $this->eloquent->reservation)) {
            return null;
        }

        return ReservationRepository::toModel($resource);
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

        return $query;
    }

}
