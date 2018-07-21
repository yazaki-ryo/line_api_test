<?php
declare(strict_types=1);

namespace Domain\Contracts\Companies;

interface UpdateCompanyInterface
{
    /**
     * @param int $id
     * @param array $inputs
     * @return bool
     */
    public function update(int $id, array $inputs = []): bool;
}
