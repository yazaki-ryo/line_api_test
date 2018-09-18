<?php
declare(strict_types=1);

namespace App\Traits\Database\Eloquent;

use Illuminate\Database\Eloquent\Builder;

trait Scopable
{
    /**
     * @param  Builder $query
     * @param  int $id
     * @param  string $operator
     * @return Builder
     */
    public function scopeId(Builder $query, int $id, string $operator = '='): Builder
    {
        $field = sprintf('%s.id', $this->getTable());

        return $query->when($operator === 'like', function(Builder $q) use ($field, $id) {
            $q->where($field, 'like', sprintf('%%%s%%', $id));
        }, function(Builder $q) use ($field, $id, $operator) {
            $q->where($field, $operator, $id);
        });
    }

    /**
     * @param  Builder $query
     * @param  array $ids
     * @param  bool $not
     * @return Builder
     */
    public function scopeIds(Builder $query, array $ids = [], bool $not = false): Builder
    {
        $field = sprintf('%s.id', $this->getTable());
        return $query->{$not === false ? 'whereIn' : 'whereNotIn'}($field, $ids);
    }
}
