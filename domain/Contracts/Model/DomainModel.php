<?php
declare(strict_types=1);

namespace Domain\Contracts\Model;

use Illuminate\Database\Eloquent\Model;

interface DomainModel
{
    public function toModel(Model $model);
}
