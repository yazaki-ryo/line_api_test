<?php
declare(strict_types=1);

namespace App\Traits\Repositories;

trait Deletable
{
    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        if (! is_null($resource = $this->eloquent->find($id))) {
            $resource->delete();
        }
    }
}
