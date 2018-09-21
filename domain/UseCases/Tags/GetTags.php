<?php
declare(strict_types=1);

namespace Domain\UseCases\Tags;

use App\Services\DomainCollection;
use Domain\Models\User;

final class GetTags
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
     * @return DomainCollection
     */
    private function domainize(User $user, array $args = []): DomainCollection
    {
        /** @var Collection $collection */
        $collection = collect($args);

//         if ($collection->has($key = 'mourning_flag') && ! is_null($collection->get($key))) {
//             $collection->put($key, ! ((bool)$collection->get($key)));
//         }

        return $user->store()->tags($collection->all());
    }

}
