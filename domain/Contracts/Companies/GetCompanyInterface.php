<?php
declare(strict_types=1);

namespace Domain\Contracts\Companies;

use Domain\Models\Company;

interface GetCompanyInterface
{
    /**
     * @param int $id
     * @return Company|null
     */
    public function findById(int $id): ?Company;
}
