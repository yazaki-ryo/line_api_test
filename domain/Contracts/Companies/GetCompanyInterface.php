<?php
declare(strict_types=1);

namespace Domain\Contracts\Companies;

use Domain\Models\Company;

interface GetCompanyInterface
{
    /**
     * @param  int $id
     * @param  bool $trashed
     * @return Company|null
     */
    public function findById(int $id, bool $trashed = false): ?Company;
}
