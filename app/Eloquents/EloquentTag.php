<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Traits\Collections\Domainable;
use App\Traits\Database\Eloquent\Scopable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

final class EloquentTag extends Model
{
    use Domainable, Scopable, SoftDeletes;

    /** @var string */
    protected $table = 'tags';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'label',
    ];

    /**
     * @return MorphToMany
     */
    public function customers(): MorphToMany
    {
        return $this->morphedByMany(EloquentCustomer::class, 'taggable', 'taggables', 'tag_id', 'taggable_id', 'id', 'id')->withTimestamps();
    }

    /**
     * @return BelongsTo
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(EloquentStore::class, 'store_id', 'id');
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
