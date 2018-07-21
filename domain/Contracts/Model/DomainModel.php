<?php
declare(strict_types=1);

namespace Domain\Contracts\Model;

use Illuminate\Database\Eloquent\Model;

interface DomainModel
{
    public static function toModel(Model $model);
}
