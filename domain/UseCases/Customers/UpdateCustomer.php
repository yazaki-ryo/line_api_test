<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use Domain\Contracts\Customers\GetCustomerInterface;
use Domain\Contracts\Customers\UpdateCustomerInterface;
use Domain\Contracts\Database\TransactionalInterface;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Customer;
use Illuminate\Contracts\Auth\Factory as Auth;

final class UpdateCustomer
{
    /** @var GetCustomerInterface */
    private $getCustomerService;

    /** @var UpdateCustomerInterface */
    private $updateCustomerService;

    /** @var TransactionalInterface */
    private $transactionalService;

    /**
     * @param GetCustomerInterface $getCustomerService
     * @param UpdateCustomerInterface $updateCustomerService
     * @param TransactionalInterface $transactionalService
     * @return void
     */
    public function __construct(
        GetCustomerInterface $getCustomerService,
        UpdateCustomerInterface $updateCustomerService,
        TransactionalInterface $transactionalService
    ) {
        $this->getCustomerService = $getCustomerService;
        $this->updateCustomerService = $updateCustomerService;
        $this->transactionalService = $transactionalService;
    }

    /**
     * @param int $id
     * @return Customer
     */
    public function getCustomer(int $id): Customer
    {
        if (is_null($customer = $this->getCustomerService->findById($id))) {
            throw new NotFoundException('Resource not found.');
        }

        return $customer;
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
        $this->getCustomer($id);

        $args = $this->domainize($auth, $args);

        return $this->transactionalService->transaction(function () use ($id, $args) {
            return $this->updateCustomerService->update($id, $args);
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

        /**
         * TODO XXX 値自体はリクエスト時にバリデーションしているので、ここの処理が冗長でも必要かどうか要検討
         */
//         if ($auth->user()->can('roles', 'company-admin')) {
//             /**
//              * TODO プルダウンで選択出来る実装になった場合、ここで企業に紐付く店舗IDかどうか判定 -> 例外をスロー
//              */
//             $args->put('store_id', optional($auth->user()->store)->id);
//         } else {
//             $args->put('store_id', optional($auth->user()->store)->id);
//         }

        if ($args->has($key = '')) {
            //
        }

        return $args->all();
    }

}
