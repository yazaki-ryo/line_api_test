<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Services\Collection\DomainCollection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BeLongsToMany;

final class EloquentPermission extends Model
{
    use SoftDeletes;

    /** @var string */
    protected $table = 'permissions';

    /**
     * @var array
     */
    protected $fillable = [
        //
    ];

    /**
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * @param  array  $models
     * @return Collection
     */
    public function newCollection(array $models = []): Collection
    {
        return new DomainCollection($models);
    }

    /**
     * @return BeLongsToMany
     */
    public function users(): BeLongsToMany
    {
        return $this->belongsToMany(EloquentUser::class, 'permission_user', 'permission_id', 'user_id')->withTimestamps();
    }

    /**
     * @param  Builder $query
     * @param  string $value
     * @param  string $operator
     * @return Builder
     */
    public function scopeSlug(Builder $query, string $value, string $operator = '='): Builder
    {
        $field = sprintf('%s.slug', $this->getTable());

        return $query->when($operator === 'like', function(Builder $q) use ($field, $value) {
            $q->where($field, 'like', "%{$value}%");
        }, function(Builder $q) use ($value, $field, $operator) {
            $q->where($field, $operator, $value);
        });
    }

    /**
     * @param  Builder $query
     * @param  array $values
     * @param  string $operator
     * @return Builder
     */
    public function scopeSlugs(Builder $query, array $values = [], bool $not = false): Builder
    {
        $field = sprintf('%s.slug', $this->getTable());
        return $query->{$not ? 'whereNotIn' : 'whereIn'}($field, $values);
    }

}
