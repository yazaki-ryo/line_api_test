<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use Domain\Contracts\Model\CreatableContract;
use Domain\Contracts\Database\TransactionableContract;
use Domain\Models\Customer;
use Domain\Models\User;

final class CreateCustomer
{
    /** @var CreatableContract */
    private $creator;

    /** @var TransactionableContract */
    private $transactionalService;

    /**
     * @param CreatableContract $creator
     * @param TransactionableContract $transactionalService
     * @return void
     */
    public function __construct(
        CreatableContract $creator,
        TransactionableContract $transactionalService
    ) {
        $this->creator = $creator;
        $this->transactionalService = $transactionalService;
    }

    /**
     * @param User $user
     * @param array $args
     * @return Customer
     */
    public function excute(User $user, array $args = []): Customer
    {
        $args = $this->domainize($user, $args);

        return $this->transactionalService->transaction(function () use ($args) {
            return $this->creator->create($args);
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

        /**
         * TODO XXX 値自体はリクエスト時にバリデーションしているので、ここの処理が冗長でも必要かどうか要検討
         */
//         if ($user->user()->can('roles', 'company-admin')) {
//             /**
//              * TODO プルダウンで選択出来る実装になった場合、ここで企業に紐付く店舗IDかどうか判定 -> 例外をスロー
//              */
//             $args->put('store_id', optional($user->user()->store)->id);
//         } else {
//             $args->put('store_id', optional($user->user()->store)->id);
//         }

        if ($args->has($key = '')) {
            //
        }

        return $args->all();
    }

}
