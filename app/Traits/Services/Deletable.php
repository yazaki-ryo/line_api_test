<?php
declare(strict_types=1);

namespace App\Traits\Services;

trait Deletable
{
    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->repo->delete($id);
    }

    /**
     * @param int $id
     * @return void
     */
    public function forceDelete(int $id): void
    {
        $this->repo->forceDelete($id);
    }

}
