<?php
declare(strict_types=1);

namespace App\Traits\Repositories;

trait Restorable
{
    /**
     * @param int $id
     * @return void
     */
    public function restore(int $id): void
    {
        if (! is_null($resource = $this->eloquent->onlyTrashed()->find($id))) {
            $resource->restore();
        }
    }
}
