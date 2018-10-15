<?php
declare(strict_types=1);

namespace Domain\UseCases\Users;

use App\Services\DomainCollection;
use Domain\Models\Company;
use Domain\Models\User;

final class GetUsers
{
    /**
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @param array $args
     * @return DomainCollection
     */
    public function excute(User $user, array $args = []): DomainCollection
    {
        return $this->domainize($user, $args);
    }

    /**
     * @param User $user
     * @param array $args
     * @return DomainCollection
     */
    private function domainize(User $user, array $args = []): DomainCollection
    {
        /** @var Collection $collection */
        $collection = collect($args);

        /** @var Company $company */
        $company = $user->company();

        return is_null($company) ? new DomainCollection : $company->users($collection->all());
    }

}
