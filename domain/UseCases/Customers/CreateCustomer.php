<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use Domain\Contracts\Customers\CreateCustomerInterface;
use Domain\Contracts\Database\TransactionalInterface;
use Domain\Models\Customer;
use Illuminate\Contracts\Auth\Factory as Auth;

final class CreateCustomer
{
    /** @var CreateCustomerInterface */
    private $createCustomerService;

    /** @var TransactionalInterface */
    private $transactionalService;

    /**
     * @param CreateCustomerInterface $createCustomerService
     * @param TransactionalInterface $transactionalService
     * @return void
     */
    public function __construct(
        CreateCustomerInterface $createCustomerService,
        TransactionalInterface $transactionalService
    ) {
        $this->createCustomerService = $createCustomerService;
        $this->transactionalService = $transactionalService;
    }

    /**
     * @param Auth $auth
     * @param array $args
     * @return Customer
     */
    public function excute(Auth $auth, array $args = []): Customer
    {
        $args = $this->domainize($auth, $args);

        return $this->transactionalService->transaction(function () use ($args) {
            return $this->createCustomerService->create($args);
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
