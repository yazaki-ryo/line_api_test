<?php
declare(strict_types=1);

namespace Domain\Contracts\Sexes;

use Domain\Models\Sex;

interface GetSexInterface
{
    /**
     * @param int $id
     * @return Sex|null
     */
    public function findById(int $id): ?Sex;
}
