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
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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
     * @return MorphMany
     */
    public function attachments(): MorphMany
    {
        return $this->morphMany(EloquentAttachment::class, 'attachmentable', 'attachmentable_type', 'attachmentable_id', 'id');
    }

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
     * @return HasMany
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(EloquentReservation::class, 'customer_id', 'id');
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
    public function scopeLastNameKana(Builder $query, string $value, string $operator = '='): Builder
    {
        $field = sprintf('%s.last_name_kana', $this->getTable());

        return $query->when($operator === 'like', function(Builder $q) use ($field, $value) {
            // ひらがなをカタカナに変換
            $value = mb_convert_kana($value, 'KC');
            $q->where($field, 'like', sprintf('%%%s%%', $value));
        }, function(Builder $q) use ($value, $field, $operator) {
            // ひらがなをカタカナに変換
            $value = mb_convert_kana($value, 'KC');
            $q->where($field, $operator, $value);
        });
    }

    /**
     * @param  Builder $query
     * @param  string $value
     * @param  string $operator
     * @return Builder
     */
    public function scopeFirstNameKana(Builder $query, string $value, string $operator = '='): Builder
    {
        $field = sprintf('%s.first_name_kana', $this->getTable());

        return $query->when($operator === 'like', function(Builder $q) use ($field, $value) {
            // ひらがなをカタカナに変換
            $value = mb_convert_kana($value, 'KC');
            $q->where($field, 'like', sprintf('%%%s%%', $value));
        }, function(Builder $q) use ($value, $field, $operator) {
            // ひらがなをカタカナに変換
            $value = mb_convert_kana($value, 'KC');
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
    public function scopeTel(Builder $query, string $value, string $operator = '='): Builder
    {
        $field = sprintf('%s.tel', $this->getTable());

        return $query->when($operator === 'like', function(Builder $q) use ($field, $value) {
            // 「全角」数字を「半角」に変換します。
            $value = mb_convert_kana($value, 'n');
            $q->where($field, 'like', sprintf('%%%s%%', $value));
        }, function(Builder $q) use ($value, $field, $operator) {
            // 「全角」数字を「半角」に変換します。
            $value = mb_convert_kana($value, 'n');
            $q->where($field, $operator, $value);
        });
    }

    /**
     * @param  Builder $query
     * @param  string $value
     * @param  string $operator
     * @return Builder
     */
    public function scopeMobilePhone(Builder $query, string $value, string $operator = '='): Builder
    {
        $field = sprintf('%s.mobile_phone', $this->getTable());

        return $query->when($operator === 'like', function(Builder $q) use ($field, $value) {
            // 「全角」数字を「半角」に変換します。
            $value = mb_convert_kana($value, 'n');
            $q->where($field, 'like', sprintf('%%%s%%', $value));
        }, function(Builder $q) use ($value, $field, $operator) {
            // 「全角」数字を「半角」に変換します。
            $value = mb_convert_kana($value, 'n');
            $q->where($field, $operator, $value);
        });
    }

    /**
     * @param  Builder $query
     * @param  string $value
     * @param  string $operator
     * @return Builder
     */
    public function scopeNote(Builder $query, string $value, string $operator = '='): Builder
    {
        $field = sprintf('%s.note', $this->getTable());

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
    public function scopeLikesAndDislikes(Builder $query, string $value, string $operator = '='): Builder
    {
        $field = sprintf('%s.likes_and_dislikes', $this->getTable());

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
                $q2->lastNameKana($value, 'like');
            });
            $q1->orWhere(function(Builder $q2) use ($value) {
                $q2->firstNameKana($value, 'like');
            });
            $q1->orWhere(function(Builder $q2) use ($value) {
                $q2->office($value, 'like');
            });
            $q1->orWhere(function(Builder $q2) use ($value) {
                $q2->tel($value, 'like');
            });
            $q1->orWhere(function(Builder $q2) use ($value) {
                $q2->mobilePhone($value, 'like');
            });
            $q1->orWhere(function(Builder $q2) use ($value) {
                $q2->likesAndDislikes($value, 'like');
            });
            $q1->orWhere(function(Builder $q2) use ($value) {
                $q2->note($value, 'like');
            });
        });
    }

    /**
     * @param  Builder $query
     * @param  bool $isNull
     * @return Builder
     */
    public function scopeMourningFlag(Builder $query, bool $isNull = true): Builder
    {
        $field = sprintf('%s.mourned_at', $this->getTable());
        return $query->{$isNull === true ? 'whereNull' : 'whereNotNull'}($field);
    }

    /**
     * @param Builder $query
     * @param Carbon|null $start
     * @param Carbon|null $end
     * @return Builder
     */
    public function scopeVisitedAt(Builder $query, Carbon $start = null, Carbon $end = null): Builder
    {
        $field = 'visited_at';

        return $query->whereHas('visitedHistories', function(Builder $q1) use ($field, $start, $end) {
            $q1->when(! is_null($start), function (Builder $q2) use ($field, $start) {
                $q2->where($field, '>=', $start->format('Y-m-d H:i:s'));
            });

            $q1->when(! is_null($end), function (Builder $q2) use ($field, $end) {
                $q2->where($field, '<=', $end->format('Y-m-d H:i:s'));
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

    /**
     * @param Builder $query
     * @param array $ids
     * @param  bool $not
     * @return Builder
     */
    public function scopeTagIds(Builder $query, array $ids = [], bool $not = false): Builder
    {
        return $query->whereHas('tags', function(Builder $q) use ($ids, $not) {
            $q->{$not === false ? 'whereIn' : 'whereNotIn'}('tag_id', $ids);
        });
    }

}
