<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Traits\Collections\Domainable;
use App\Traits\Database\Eloquent\Scopable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

final class EloquentStore extends Model
{
    use Domainable, Scopable, SoftDeletes;

    /** @var string */
    protected $table = 'stores';

    /**
     * @var array
     */
    protected $fillable = [
        'company_id',
        'prefecture_id',
        'name',
        'kana',
        'personal_name',
        'postal_code',
        'address',
        'building',
        'tel',
        'fax',
        'email',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'starts_at',
        'ends_at',
    ];

    /**
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(EloquentCompany::class, 'company_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function customers(): HasMany
    {
        return $this->hasMany(EloquentCustomer::class, 'store_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(EloquentReservation::class, 'store_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function tags(): HasMany
    {
        return $this->hasMany(EloquentTag::class, 'store_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function seats(): HasMany
    {
        return $this->hasMany(EloquentSeat::class, 'store_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(EloquentUser::class, 'store_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function mailHistories(): HasMany
    {
        return $this->hasMany(EloquentMailHistory::class, 'store_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function prefecture(): HasOne
    {
        return $this->hasOne(EloquentPrefecture::class, 'id', 'prefecture_id');
    }

    /**
     * @param  Builder $query
     * @param  int $value
     * @return Builder
     */
    public function scopeId(Builder $query, int $value): Builder
    {
        $field = sprintf('%s.id', $this->getTable());

        return $query->where($field, '=', $value);
    }

    /**
     * @param  Builder $query
     * @param  int $value
     * @return Builder
     */
    public function scopeCompanyId(Builder $query, int $value): Builder
    {
        $field = sprintf('%s.company_id', $this->getTable());

        return $query->where($field, '=', $value);
    }

}
