<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Traits\Collections\Domainable;
use App\Traits\Database\Eloquent\Scopable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

final class EloquentVisitedHistory extends Model
{
    use Domainable, Scopable, SoftDeletes;

    /** @var string */
    protected $table = 'visited_histories';

    /**
     * @var array
     */
    protected $fillable = [
        'reservation_id',
        'visited_at',
        'seat',
        'amount',
        'note',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'visited_at',
    ];

    /**
     * @return MorphMany
     */
    public function attachments(): MorphMany
    {
        return $this->morphMany(EloquentAttachment::class, 'attachmentable', 'attachmentable_type', 'attachmentable_id', 'id');
    }

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
    public function reservation(): BelongsTo
    {
        return $this->belongsTo(EloquentReservation::class, 'reservation_id', 'id');
    }

    /**
     * @param Builder $query
     * @param int $id
     * @return Builder
     */
    public function scopeStoreId(Builder $query, int $id): Builder
    {
        return $query->whereHas('customer', function(Builder $q) use ($id) {
            $q->where('store_id', $id);
        });
    }

}
