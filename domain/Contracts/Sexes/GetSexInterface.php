<?php
declare(strict_types=1);

namespace Domain\Contracts\Sexes;

use Domain\Models\Sex;

interface GetSexInterface
{
    /**
     * @param  int $id
     * @param  bool $trashed
     * @return Sex|null
     */
    public function findById(int $id, bool $trashed = false): ?Sex;
}
