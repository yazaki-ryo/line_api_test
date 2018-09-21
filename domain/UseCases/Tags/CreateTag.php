<?php
declare(strict_types=1);

namespace Domain\UseCases\Tags;

use App\Traits\Database\Transactionable;
use Domain\Models\Store;
use Domain\Models\Tag;
use Domain\Models\User;

final class CreateTag
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
     * @param Store $store
     * @param array $args
     * @return Tag
     */
    public function excute(User $user, Store $store, array $args = []): Tag
    {
        $args = $this->domainize($user, $args);

        return $this->transaction(function () use ($store, $args) {
            return $store->addTag($args);
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

        if ($args->has($key = '')) {
            //
        }

        return $args->all();
    }

}
