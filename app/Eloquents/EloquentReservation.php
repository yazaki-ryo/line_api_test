<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Traits\Collections\Domainable;
use App\Traits\Database\Eloquent\Scopable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

final class EloquentReservation extends Model
{
    use Domainable, Scopable, SoftDeletes;

    /** @var string */
    protected $table = 'reservations';

    /**
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'reserved_at',
        'name',
        'seat',
        'amount',
        'reservation_code',
        'floor',
        'status',
        'note',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'reserved_at',
    ];

    /**
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(EloquentCustomer::class, 'customer_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(EloquentStore::class, 'store_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function visitedHistory(): HasOne
    {
        return $this->hasOne(EloquentVisitedHistory::class, 'reservation_id', 'id');
    }

    /**
     * @param  Builder $query
     * @param  int $value
     * @return Builder
     */
    public function scopeStoreId(Builder $query, int $value): Builder
    {
        $field = sprintf('%s.store_id', $this->getTable());

        return $query->where($field, '=', $value);
    }

    /**
     * @param Builder $query
     * @param Carbon|null $start
     * @param Carbon|null $end
     * @return Builder
     */
    public function scopeReservedAt(Builder $query, Carbon $start = null, Carbon $end = null): Builder
    {
        $field = 'reserved_at';

        $query->when(! is_null($start), function (Builder $q) use ($field, $start) {
            $q->where($field, '>=', $start->format('Y-m-d H:i:s'));
        });

        $query->when(! is_null($end), function (Builder $q) use ($field, $end) {
            $q->where($field, '<=', $end->format('Y-m-d H:i:s'));
        });

        return $query;
    }
}
