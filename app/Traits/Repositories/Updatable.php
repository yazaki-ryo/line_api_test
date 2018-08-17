<?php
declare(strict_types=1);

namespace App\Traits\Repositories;

trait Updatable
{
    /**
     * @param  int $id
     * @param  array $args
     * @return bool
     */
    public function update(int $id, array $args = []): bool
    {
        if (is_null($resource = $this->eloquent->find($id))) {
            return false;
        }
        return $resource->update($args);
    }
}
