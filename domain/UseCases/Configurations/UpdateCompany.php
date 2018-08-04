<?php
declare(strict_types=1);

namespace Domain\UseCases\Configurations;

use Domain\Contracts\Database\TransactionalInterface;
use Domain\Contracts\Companies\GetCompanyInterface;
use Domain\Contracts\Companies\UpdateCompanyInterface;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Company;
use Illuminate\Contracts\Auth\Factory as Auth;

final class UpdateCompany
{
    /** @var GetCompanyInterface */
    private $getCompanyService;

    /** @var UpdateCompanyInterface */
    private $updateCompanyService;

    /** @var TransactionalInterface */
    private $transactionalService;

    /**
     * @param GetCompanyInterface $getCompanyService
     * @param UpdateCompanyInterface $updateCompanyService
     * @param TransactionalInterface $transactionalService
     * @return void
     */
    public function __construct(
        GetCompanyInterface $getCompanyService,
        UpdateCompanyInterface $updateCompanyService,
        TransactionalInterface $transactionalService
    ) {
        $this->getCompanyService = $getCompanyService;
        $this->updateCompanyService = $updateCompanyService;
        $this->transactionalService = $transactionalService;
    }

    /**
     * @param int $id
     * @return Company
     * @throws NotFoundException
     */
    public function getCompany(int $id): Company
    {
        if (is_null($resource = $this->getCompanyService->findById($id))) {
            throw new NotFoundException('Resource not found.');
        }

        return $resource;
    }

    /**
     * @param Auth $auth
     * @param int $id
     * @param array $args
     * @return bool
     * @throws NotFoundException
     */
    public function excute(Auth $auth, int $id, array $args = []): bool
    {
        $this->getCompany($id);

        $args = $this->domainize($auth, $args);

        return $this->transactionalService->transaction(function () use ($id, $args) {
            return $this->updateCompanyService->update($id, $args);
        });
    }

    /**
     * @param Auth $auth
     * @param array $args
     * @return array
     */
    private function domainize(Auth $auth, array $args = []): array
    {
        $args = collect($args);

        if ($args->has($key = '')) {
            //
        }

        return $args->all();
    }

}
