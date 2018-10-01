<?php
declare(strict_types=1);

namespace Domain\UseCases\Users;

use App\Traits\Database\Transactionable;
use Domain\Exceptions\DomainRuleException;
use Domain\Models\Company;
use Domain\Models\Store;
use Domain\Models\User;
use Illuminate\Support\Collection;

final class CreateUser
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
     * @param User $user
     * @param array $args
     * @return User
     */
    public function excute(User $user, array $args = []): User
    {
        return $this->transaction(function () use ($user, $args) {
            return $this->domainize($user, $args);
        });
    }

    /**
     * @param User $user
     * @param array $args
     * @return User
     */
    private function domainize(User $user, array $args = []): User
    {
        $args = collect($args);

        if ($args->has($key = 'password')) {
            $args = $args->when(empty($args->get($key)), function (Collection $item) use ($key) {
                return $item->except($key);
            }, function (Collection $item) use ($key) {
                return $item->put($key, bcrypt($item->get($key)));
            });
        }

        /** @var Store $store */
        $store = $user->store();

        /** @var Company $company */
        $company = $store->company();

        if ($user->can('authorize', 'customers.create')) {
            // TODO
        } elseif ($user->can('authorize', 'own-company-customers.create') && ! is_null($company)) {
            $store = $company->stores([
                'id' => $args->get('store_id'),
            ])->first();
        } elseif ($user->can('authorize', 'own-company-self-store-customers.create') && ! is_null($store)) {
            // none
        } else {
            throw new DomainRuleException('The store is not properly selected.');
        }

        return $store->addUser($args->all());
    }

}
