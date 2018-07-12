<?php
declare(strict_types=1);

namespace App\Collection;

use Domain\Contracts\Models\DomainModelCollection;
use Illuminate\Database\Eloquent\{Collection, Model};

final class EloquentCollection extends Collection implements DomainModelCollection
{
    public function toModels(): Collection
    {
        return $this->transform(function (Model $item, $key) {
            return $item->toModel();
        });
    }
}
