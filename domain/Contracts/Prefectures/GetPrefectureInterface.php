<?php
declare(strict_types=1);

namespace Domain\Contracts\Prefectures;

use Domain\Models\Prefecture;

interface GetPrefectureInterface
{
    /**
     * @param  int $id
     * @param  bool $trashed
     * @return Prefecture|null
     */
    public function findById(int $id, bool $trashed = false): ?Prefecture;
}
