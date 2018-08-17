<?php
declare(strict_types=1);

namespace Domain\Contracts\Model;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface DomainableContract
{
    /**
     * @param Model $model
     */
    public static function toModel(Model $model);

    /**
     * @param  Collection $collection
     * @return Collection
     */
    public static function toModels(Collection $collection): Collection;
}
