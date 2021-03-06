<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentMailHistory;
use App\Services\DomainCollection;
use Domain\Contracts\Model\DomainableContract;
use Domain\Models\DomainModel;
use Domain\Models\Store;
use Domain\Models\Customer;
use Domain\Models\MailHistory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class MailHistoryRepository extends EloquentRepository implements DomainableContract
{
    /**
     * @param EloquentMailHistory|null $eloquent
     * @return void
     */
    public function __construct(EloquentMailHistory $eloquent = null)
    {
        $this->eloquent = is_null($eloquent) ? new EloquentMailHistory: $eloquent;
    }

    /**
     * @param Model $model
     * @return DomainModel
     */
    public static function toModel(Model $model): DomainModel
    {
        return MailHistory::of(self::of($model));
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public static function toModels(Collection $collection): Collection
    {
        return $collection->transform(function ($item) {
            return $item instanceof EloquentMailHistory ? self::toModel($item) : $item;
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
     * @return Customer|null
     */
    public function customer(): ?Customer
    {
        if (is_null($resource = $this->eloquent->customer)) {
            return null;
        }
        return CustomerRepository::toModel($resource);
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

        $query->when($args->has($key = 'customer_id') && ! is_null($args->get($key)), function (Builder $q) use ($key, $args) {
            $q->customerId($args->get($key));
        });

        $query->when($args->has($key = 'message_id') && ! is_null($args->get($key)), function (Builder $q) use ($key, $args) {
            $q->messageId($args->get($key));
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
                case '3': // ???????????? ?????? > ????????? ??????
                    $q->orderBy('title')
                        ->orderBy('created_at');
                    break;
                case '-1': // ????????? ?????? > ???????????? ??????
                    $q->orderByDesc('created_at')
                        ->orderBy('title');
                    break;
                default: // ????????? ?????? > ???????????? ??????
                    $q->orderBy('created_at')
                        ->orderBy('title');
                    break;
            }
        });

        return $query;
    }

}
