<?php
declare(strict_types=1);

namespace Domain\Contracts\Model;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;

interface DomainModels
{
    public static function toModels(EloquentCollection $collection);
}
