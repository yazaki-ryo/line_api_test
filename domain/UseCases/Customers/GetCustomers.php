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
     *
     */
//     $query->companyId(optional($user->store)->company_id);
//         $query->when($user->cant('roles', 'company-admin'), function (Builder $q) use ($user) {
//             $q->storeId($user->store_id);
//         });

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
