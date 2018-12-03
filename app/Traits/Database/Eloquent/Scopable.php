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

    /**
     * @param  Builder $query
     * @param  string|array $args
     * @param  bool $not
     * @return Builder
     */
    public function scopeNull(Builder $query, $args, bool $not = false): Builder
    {
        $args = is_array($args) ? $args : [$args];
        foreach ($args as $field ) {
            $query->{$not === false ? 'whereNull' : 'whereNotNull'}(sprintf('%s.%s', $this->getTable(), $field));
        }

        return $query;
    }

    /**
     * @param  Builder $query
     * @param  string|array $args
     * @return Builder
     */
    public function scopeRelations(Builder $query, $args): Builder
    {
        $args = is_array($args) ? $args : [$args];
        return $query->with($args);
    }
}
