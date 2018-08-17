<?php
declare(strict_types=1);

namespace App\Traits\Services;

use Domain\Models\DomainModel;

trait Creatable
{
    /**
     * @param array $args
     * @return DomainModel
     */
    public function create(array $args = []): DomainModel
    {
        return $this->repo->create($args);
    }

}
