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

        $args->put('company_id', optional($auth->user()->company)->id);

        if ($auth->user()->cant('roles', 'company-admin')) {
            $args->put('store_id', optional($auth->user()->store)->id);
        }

        if ($args->has($key = '')) {
            //
        }

        return $args->all();
    }

}
