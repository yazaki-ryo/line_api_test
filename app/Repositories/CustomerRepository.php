<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentCustomer;
use App\Services\DomainCollection;
use Domain\Contracts\Model\DomainableContract;
use Domain\Models\Company;
use Domain\Models\DomainModel;
use Domain\Models\Customer;
use Domain\Models\Prefecture;
use Domain\Models\Sex;
use Domain\Models\Store;
use Domain\Models\VisitedHistory;
use Domain\Models\PrintHistory;
use Domain\Models\Attachment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Carbon\Carbon;

final class CustomerRepository extends EloquentRepository implements DomainableContract
{
    /**
     * @param EloquentCustomer|null $eloquent
     * @return void
     */
    public function __construct(EloquentCustomer $eloquent = null)
    {
        $this->eloquent = is_null($eloquent) ? new EloquentCustomer : $eloquent;
    }

    /**
     * @param Model $model
     * @return Customer
     */
    public static function toModel(Model $model): DomainModel
    {
        return Customer::of(self::of($model));
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public static function toModels(Collection $collection): Collection
    {
        return $collection->transform(function ($item) {
            return $item instanceof EloquentCustomer ? self::toModel($item) : $item;
        });
    }

    /**
     * @return Company|null
     */
    public function company(): ?Company
    {
        if (is_null($resource = optional($this->eloquent->store)->company)) {
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
     * @return Sex|null
     */
    public function sex(): ?Sex
    {
        if (is_null($resource = $this->eloquent->sex)) {
            return null;
        }

        return SexRepository::toModel($resource);
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
     * @param  array $args
     * @return DomainCollection
     */
    public function reservations(array $args = []): DomainCollection
    {
        $collection = empty($args) ? $this->eloquent->reservations : ReservationRepository::build($this->eloquent->reservations(), $args)->get();
        return ReservationRepository::toModels($collection);
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
    public function visitedHistories(array $args = []): DomainCollection
    {
        $collection = empty($args) ? $this->eloquent->visitedHistories : VisitedHistoryRepository::build($this->eloquent->visitedHistories(), $args)->get();
        return VisitedHistoryRepository::toModels($collection);
    }

    /**
     * @param  array $args
     * @return DomainCollection
     */
    public function printHistories(array $args = []): DomainCollection
    {
        $collection = empty($args) ? $this->eloquent->printHistories : PrintHistoryRepository::build($this->eloquent->printHistories(), $args)->get();
        return PrintHistoryRepository::toModels($collection);
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
     * @return VisitedHistory
     */
    public function addVisitedHistory(array $args = []): VisitedHistory
    {
        $resource = $this->eloquent->visitedHistories()->create($args);
        return VisitedHistoryRepository::toModel($resource);
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

        $query->when($args->has($key = 'company_id') && ! is_null($args->get($key)), function (Builder $q) use ($key, $args) {
            $q->companyId($args->get($key));
        });

        $query->when($args->has($key = 'store_id') && ! is_null($args->get($key)), function (Builder $q) use ($key, $args) {
            $q->storeId($args->get($key));
        });

        $query->when($args->has($key = 'free_word') && ! is_null($args->get($key)), function (Builder $q) use ($key, $args) {
            $q->freeWord($args->get($key));
        });

        $query->when($args->has($key = 'mourning_flag') && ! is_null($args->get($key)), function (Builder $q) use ($key, $args) {
            $q->mourningFlag((bool)$args->get($key));
        });

        $end = 'visited_date_e';
        $query->when(($args->has($start = 'visited_date_s') && ! is_null($args->get($start)))
            || ($args->has($end) && ! is_null($args->get($end))), function (Builder $q) use ($args, $start, $end) {
            $q->visitedAt(
                $args->has($start) && ! is_null($args->get($start)) ? Carbon::parse($args->get($start))->startOfDay() : null,
                $args->has($end) && ! is_null($args->get($end)) ? Carbon::parse($args->get($end))->endOfDay() : null
            );
        });

        // ???????????????
        $end = 'birthday_e';
        $query->when(($args->has($start = 'birthday_s') && ! is_null($args->get($start)))
            || ($args->has($end) && ! is_null($args->get($end))), function (Builder $q) use ($args, $start, $end) {
            $q->Birthday(
                $args->has($start) && ! is_null($args->get($start)) ? (int)$args->get($start) : null,
                $args->has($end) && ! is_null($args->get($end)) ? (int)$args->get($end) : null
            );
        });

        // ???????????????
        $end = 'anniversary_e';
        $query->when(($args->has($start = 'anniversary_s') && ! is_null($args->get($start)))
            || ($args->has($end) && ! is_null($args->get($end))), function (Builder $q) use ($args, $start, $end) {
            $q->Anniversary(
                $args->has($start) && ! is_null($args->get($start)) ? (int)$args->get($start) : null,
                $args->has($end) && ! is_null($args->get($end)) ? (int)$args->get($end) : null
            );
        });

        // ????????????
        $query->when($args->has($key = 'tags') && is_array($args->get($key)), function (Builder $q) use ($key, $args) {
            $q->tagIds($args->get($key));
        });

        // ??????????????????
        $query->when($args->has($key = 'not_tags') && $args->get($key) === "1", function (Builder $q) use ($key, $args) {
            $q->notTags();
        });

        $query->when($args->has($key = 'trashed'), function (Builder $q1) use ($key, $args) {
            $q1->when($args->get($key) === 'with', function (Builder $q2) {
                $q2->withTrashed();
            });
            $q1->when($args->get($key) === 'only', function (Builder $q2) {
                $q2->onlyTrashed();
            });
        });

        $query->when($args->has($key = 'notNull') && is_array($args->get($key)), function (Builder $q) use ($key, $args) {
            $q->null($args->get($key), true);
        });

        $query->when($args->has($key = 'address'), function (Builder $q) use ($key, $args) {
            $q->Address($args->get($key), 'regexp');
        });

        $query->when(($args->has($key = 'address_flag') && ! is_null($args->get($key))), function (Builder $q1) use ($key, $args) {
            $q1->when($args->get($key) === 'with_address', function (Builder $q2) {
                $q2->WithAddress();
            });
            $q1->when($args->get($key) === 'no_address', function (Builder $q2) {
                $q2->NoAddress();
            });
        });        

        $query->when($args->has($key = 'page') && $args->get($key) > 0, function (Builder $q) use ($key, $args) {
            $rows_in_page = $args->get('rows_in_page', 25);
            $page = $args->get($key, 1);
            $offset = ($page - 1) * $rows_in_page;
            $q->limit($rows_in_page)->offset($offset);
        });

        $query->when($args->has($key = 'sort') && is_numeric($args->get($key)), function (Builder $q) use ($key, $args) {
            $subquery = \App\Eloquents\EloquentVisitedHistory::query();
            $subquery->selectRaw('customer_id, COUNT(id) AS visited_count');
            $subquery->groupBy('customer_id');

            $q->leftJoin(
                    \DB::raw("({$subquery->toSql()}) AS V"), 
                            'customers.id', '=', 'V.customer_id');
            $sorting = $args->get('sort');
            switch ($sorting) {
                case '1': // ????????? ?????? > ???????????? ??????
                    $q->orderByDesc('visited_count')
                        ->orderBy('customers.last_name_kana')
                        ->orderBy('customers.first_name_kana');
                    break;
                case '2': // ????????? ?????? > ???????????? ??????
                    $q->orderBy('visited_count')
                        ->orderBy('customers.last_name_kana')
                        ->orderBy('customers.first_name_kana');
                    break;
                case '3': // ???????????? ?????? > ????????? ??????
                    $q->orderBy('customers.last_name_kana')
                        ->orderBy('customers.first_name_kana')
                        ->orderBy('customers.created_at');
                    break;
                case '-1': // ????????? ?????? > ???????????? ??????
                    $q->orderByDesc('customers.created_at')
                        ->orderBy('customers.last_name_kana')
                        ->orderBy('customers.first_name_kana');
                    break;
                default: // ????????? ?????? > ???????????? ??????
                    $q->orderBy('customers.created_at')
                        ->orderBy('customers.last_name_kana')
                        ->orderBy('customers.first_name_kana');
                    break;
            }
        });
        
        $query->when($args->has($key = 'customer_ids') && is_array($args->get($key)), function (Builder $q) use ($key, $args) {
            $q->ids($args->get($key));
        });

        return $query;
    }
}
