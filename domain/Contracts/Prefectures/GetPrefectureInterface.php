<?php
declare(strict_types=1);

namespace Domain\Contracts\Prefectures;

use Domain\Models\Prefecture;

interface GetPrefectureInterface
{
    /**
     * @param int $id
     * @return Prefecture|null
     */
    public function findById(int $id): ?Prefecture;
}
