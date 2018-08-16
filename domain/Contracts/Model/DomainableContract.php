<?php
declare(strict_types=1);

namespace Domain\Contracts\Model;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;

interface DomainableContract
{
    /**
     * @param Model $model
     */
    public static function toModel(Model $model);

    /**
     * @param EloquentCollection $collection
     */
    public static function toModels(EloquentCollection $collection);
}
