<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use App\Traits\Database\Transactionable;
use Domain\Contracts\Model\CreatableContract;
use Domain\Models\Customer;
use Domain\Models\User;

final class CreateCustomer
{
    use Transactionable;

    /** @var CreatableContract */
    private $creator;

    /**
     * @param CreatableContract $creator
     * @return void
     */
    public function __construct(CreatableContract $creator)
    {
        $this->creator = $creator;
    }

    /**
     * @param User $user
     * @param array $args
     * @return Customer
     */
    public function excute(User $user, array $args = []): Customer
    {
        $args = $this->domainize($user, $args);

        return $this->transaction(function () use ($args) {
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
