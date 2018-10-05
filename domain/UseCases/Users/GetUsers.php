<?php
declare(strict_types=1);

namespace Domain\UseCases\Users;

use App\Services\DomainCollection;
use Domain\Models\Company;
use Domain\Models\Store;
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

//         if ($collection->has($key = '') && ! is_null($collection->get($key))) {
//             $collection->put($key, ! ((bool)$collection->get($key)));
//         }

        /** @var Store $store */
        $store = $user->store();

        if ($user->can('authorize', 'users.select')) {
            // TODO
        } elseif ($user->can('authorize', 'own-company-users.select') && ! is_null($store) && ! is_null($company = $store->company())) {
            return $company->users($collection->all());
        } elseif ($user->can('authorize', 'own-company-self-store-users.select') && ! is_null($store)) {
            return $store->users($collection->all());
        } else {
            return new DomainCollection;
        }
    }

}
