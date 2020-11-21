<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Traits\Collections\Domainable;
use App\Traits\Database\Eloquent\Scopable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class EloquentSeat extends Model
{
    use Domainable, Scopable, SoftDeletes;

    /** @var string */
    protected $table = 'seats';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'floor',
    ];

    /**
     * @return BelongsTo
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(EloquentStore::class, 'store_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(EloquentReservation::class, 'seat', 'id');
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

}
