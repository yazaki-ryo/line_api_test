<?php
declare(strict_types=1);

namespace App\Traits\Repositories;

use Domain\Models\DomainModel;

trait Creatable
{
    /**
     * @param array $args
     * @return DomainModel|null
     */
    public function create(array $args = []): ?DomainModel
    {
        if (is_null($resource = $this->eloquent->create($args))) {
            return null;
        }
        return static::toModel($resource);
    }

}
