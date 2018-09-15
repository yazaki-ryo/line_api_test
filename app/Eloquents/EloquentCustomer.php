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
use Illuminate\Database\Eloquent\Relations\MorphToMany;

final class EloquentCustomer extends Model
{
    use Domainable, Scopable, SoftDeletes;

    /** @var string */
    protected $table = 'customers';

    /**
     * @var array
     */
    protected $fillable = [
        'store_id',
        'prefecture_id',
        'sex_id',
//         'group_id',
//         'introducer_id',
        'last_name',
        'first_name',
        'last_name_kana',
        'first_name_kana',
        'office',
        'office_kana',
        'department',
        'position',

        'postal_code',
        'address',
        'building',
        'tel',
        'fax',
        'email',
        'mobile_phone',

        'mourned_at',
        'birthday',
        'anniversary',
        'likes_and_dislikes',
        'note',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'mourned_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'anniversary' => 'date',
        'birthday'    => 'date',
        'cancel_cnt'  => 'int',
        'noshow_cnt'  => 'int',
    ];

    /**
     * @return HasOne
     */
    public function prefecture(): HasOne
    {
        return $this->hasOne(EloquentPrefecture::class, 'id', 'prefecture_id');
    }

    /**
     * @return HasOne
     */
    public function sex(): HasOne
    {
        return $this->hasOne(EloquentSex::class, 'id', 'sex_id');
    }

    /**
     * @return BelongsTo
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(EloquentStore::class, 'store_id', 'id');
    }

    /**
     * @return MorphToMany
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(EloquentTag::class, 'taggable', 'taggables', 'taggable_id', 'tag_id', 'id', 'id')->withTimestamps();
    }

    /**
     * @return HasMany
     */
    public function visitedHistories(): HasMany
    {
        return $this->hasMany(EloquentVisitedHistory::class, 'customer_id', 'id');
    }

    /**
     * @param  Builder $query
     * @param  string $value
     * @param  string $operator
     * @return Builder
     */
    public function scopeLastName(Builder $query, string $value, string $operator = '='): Builder
    {
        $field = sprintf('%s.last_name', $this->getTable());

        return $query->when($operator === 'like', function(Builder $q) use ($field, $value) {
            $q->where($field, 'like', sprintf('%%%s%%', $value));
        }, function(Builder $q) use ($value, $field, $operator) {
            $q->where($field, $operator, $value);
        });
    }

    /**
     * @param  Builder $query
     * @param  string $value
     * @param  string $operator
     * @return Builder
     */
    public function scopeFirstName(Builder $query, string $value, string $operator = '='): Builder
    {
        $field = sprintf('%s.first_name', $this->getTable());

        return $query->when($operator === 'like', function(Builder $q) use ($field, $value) {
            $q->where($field, 'like', sprintf('%%%s%%', $value));
        }, function(Builder $q) use ($value, $field, $operator) {
            $q->where($field, $operator, $value);
        });
    }

    /**
     * @param  Builder $query
     * @param  string $value
     * @param  string $operator
     * @return Builder
     */
    public function scopeOffice(Builder $query, string $value, string $operator = '='): Builder
    {
        $field = sprintf('%s.office', $this->getTable());

        return $query->when($operator === 'like', function(Builder $q) use ($field, $value) {
            $q->where($field, 'like', sprintf('%%%s%%', $value));
        }, function(Builder $q) use ($value, $field, $operator) {
            $q->where($field, $operator, $value);
        });
    }

    /**
     * @param  Builder $query
     * @param  string $value
     * @param  string $operator
     * @return Builder
     */
    public function scopeFreeWord(Builder $query, string $value): Builder
    {
        return $query->where(function(Builder $q1) use ($value) {
            $q1->orWhere(function(Builder $q2) use ($value) {
                $q2->lastName($value, 'like');
            });
            $q1->orWhere(function(Builder $q2) use ($value) {
                $q2->firstName($value, 'like');
            });
            $q1->orWhere(function(Builder $q2) use ($value) {
                $q2->office($value, 'like');
            });
        });
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
     * @param  Builder $query
     * @param  int $value
     * @return Builder
     */
    public function scopeCompanyId(Builder $query, int $value): Builder
    {
        return $query->whereHas('store', function(Builder $q) use ($value) {
            $q->where('stores.company_id', '=', $value);
        });
    }

}
