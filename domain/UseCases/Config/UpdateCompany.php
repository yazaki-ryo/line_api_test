<?php
declare(strict_types=1);

namespace Domain\UseCases\Config;

use Domain\Contracts\Database\TransactionalInterface;
use Domain\Contracts\Companies\GetCompanyInterface;
use Domain\Contracts\Companies\UpdateCompanyInterface;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Company;

final class UpdateCompany
{
    /** @var GetCompanyInterface */
    private $getCompanyService;

    /** @var UpdateCompanyInterface */
    private $updateCompanyService;

    /** @var TransactionalInterface */
    private $transactionalService;

    /**
     * @return void
     */
    public function __construct(GetCompanyInterface $getCompanyService, UpdateCompanyInterface $updateCompanyService, TransactionalInterface $transactionalService)
    {
        $this->getCompanyService = $getCompanyService;
        $this->updateCompanyService = $updateCompanyService;
        $this->transactionalService = $transactionalService;
    }

    /**
     * @param int $id
     * @return Company
     */
    public function get(int $id): Company
    {
        return $this->getCompanyService->findById($id);
    }

    /**
     * @param int $id
     * @param array $inputs
     * @return bool
     * @throws NotFoundException
     */
    public function excute(int $id, array $inputs = []): bool
    {
        return $this->transactionalService->transaction(function () use ($id, $inputs) {

            if (is_null($this->getCompanyService->findById($id))) {
                throw new NotFoundException('Resource not found.');
            }

            return $this->updateCompanyService->update($id, $inputs);
        });
    }

}
