<?php
declare(strict_types=1);

namespace Domain\UseCases\Settings;

use App\Traits\Database\Transactionable;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Company;
use Domain\Models\User;

final class UpdateCompany
{
    use Transactionable;

    /**
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param  User $user
     * @return Company
     * @throws NotFoundException
     */
    public function getCompany(User $user): Company
    {
        if (is_null($resource = $user->company())) {
            throw new NotFoundException('Resource not found.');
        }
        return $resource;
    }

    /**
     * @param User $user
     * @param Company $company
     * @param array $args
     * @return bool
     * @throws NotFoundException
     */
    public function excute(User $user, Company $company, array $args = []): bool
    {
        $args = $this->domainize($user, $args);

        return $this->transaction(function () use ($company, $args) {
            return $company->update($args);
        });
    }

    /**
     * @param User $user
     * @param array $args
     * @return array
     */
    private function domainize(User $user, array $args = []): array
    {
        $args = collect($args);

        if ($args->has($key = '')) {
            //
        }

        return $args->all();
    }

}
