<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use App\Services\DomainCollection;
use Domain\Models\Company;
use Domain\Models\Store;
use Domain\Models\User;

final class GetCustomers
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
     * @return array
     */
    private function domainize(User $user, array $args = []): array
    {
        $args = collect($args);

        /** @var Store $store */
        $store = $user->store();

        /** @var Company $company */
        $company = $store->company();

        /**
         * TODO store, companyどちらかが削除済みかどうかの判定もここで必要か
         */

        /**
         * TODO ここでモデル経由でEloquentガードのauthorizableトレイトを利用してロール判定
         */

        $query = $company->customers();

//         if ($auth->user()->cant('roles', 'company-admin')) {
//             $query = $store->customers();
//         }

        if ($args->has($key = 'free_word')) {
            if (is_null($args->get($key))) {
                $args->forget($key);
            }
        }

        return [$query, $args->all()];
    }

}
