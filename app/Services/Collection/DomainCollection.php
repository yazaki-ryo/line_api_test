<?php
declare(strict_types=1);

namespace App\Services\Collection;

use Domain\Contracts\Model\DomainModelsCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final class DomainCollection extends Collection implements DomainModelsCollection
{
    public function toModels(): Collection
    {
        return $this->transform(function (Model $item, $key) {
            return $item->toModel();
        });
    }
}
