<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Traits\Collections\Domainable;
use App\Traits\Database\Eloquent\Scopable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

final class EloquentPermission extends Model
{
    use Domainable, Scopable, SoftDeletes;

    /** @var string */
    protected $table = 'permissions';

    /**
     * @var array
     */
    protected $fillable = [
        //
    ];

    /**
     * @return MorphToMany
     */
    public function users(): MorphToMany
    {
        return $this->morphedByMany(EloquentUser::class, 'permissible', 'permissibles', 'permission_id', 'permissible_id', 'id', 'id')->withTimestamps();
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
            $q->where($field, 'like', sprintf('%%%s%%', $value));
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
