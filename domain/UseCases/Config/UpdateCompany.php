<?php
declare(strict_types=1);

namespace Domain\UseCases\Config;

use App\Services\Collection\DomainCollection;
use Domain\Contracts\Database\TransactionalInterface;
use Domain\Contracts\Companies\GetCompanyInterface;
use Domain\Contracts\Companies\UpdateCompanyInterface;
use Domain\Contracts\Prefectures\GetPrefecturesInterface;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Company;

final class UpdateCompany
{
    /** @var GetCompanyInterface */
    private $getCompanyService;

    /** @var UpdateCompanyInterface */
    private $updateCompanyService;

    /** @var GetPrefecturesInterface */
    private $getPrefecturesService;

    /** @var TransactionalInterface */
    private $transactionalService;

    /**
     * @return void
     */
    public function __construct(
        GetCompanyInterface $getCompanyService,
        UpdateCompanyInterface $updateCompanyService,
        GetPrefecturesInterface $getPrefecturesService,
        TransactionalInterface $transactionalService)
    {
        $this->getCompanyService = $getCompanyService;
        $this->updateCompanyService = $updateCompanyService;
        $this->getPrefecturesService = $getPrefecturesService;
        $this->transactionalService = $transactionalService;
    }

    /**
     * @param int $id
     * @return Company
     */
    public function getCompany(int $id): Company
    {
        if (is_null($company = $this->getCompanyService->findById($id))) {
            throw new NotFoundException('Resource not found.');
        }

        return $company;
    }

    /**
     * @return DomainCollection
     */
    public function getPrefectures(): DomainCollection
    {
        return $this->getPrefecturesService->findAll();
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return bool
     * @throws NotFoundException
     */
    public function excute(int $id, array $attributes = []): bool
    {
        return $this->transactionalService->transaction(function () use ($id, $attributes) {
            $this->getCompanyService->findById($id);
            return $this->updateCompanyService->update($id, $attributes);
        });
    }

}
