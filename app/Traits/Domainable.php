<?php
declare(strict_types=1);

namespace App\Traits;

use App\Services\DomainCollection;

trait Domainable
{
    /**
     * @param  array  $models
     * @return DomainCollection
     */
    public function newCollection(array $models = []): DomainCollection
    {
        return new DomainCollection($models);
    }
}
