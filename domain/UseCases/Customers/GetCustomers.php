<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use App\Services\Collection\DomainCollection;
use Domain\Contracts\Customers\GetCustomersInterface;
use Illuminate\Contracts\Auth\Factory as Auth;

final class GetCustomers
{
    /** @var GetCustomersInterface */
    private $getCustomersService;

    /**
     * @param GetCustomersInterface $getCustomersService
     * @return void
     */
    public function __construct(GetCustomersInterface $getCustomersService)
    {
        $this->getCustomersService = $getCustomersService;
    }

    /**
     * @param Auth $auth
     * @param array $args
     * @return DomainCollection
     */
    public function excute(Auth $auth, array $args = []): DomainCollection
    {
        $args = $this->domainize($auth, $args);

        return $this->getCustomersService->findAll($args);
    }

    /**
     * @param Auth $auth
     * @param array $args
     * @return array
     */
    private function domainize(Auth $auth, array $args = []): array
    {
        $args = collect($args);
        $store = $auth->user()->store;

        $args->put('company_id', optional($store)->company_id);

        if ($auth->user()->cant('roles', 'company-admin')) {
            $args->put('store_id', optional($store)->id);
        }

        if ($args->has($key = 'free_word')) {
            if (is_null($args->get($key))) {
                $args->forget($key);
            }
        }

        return $args->all();
    }

}
