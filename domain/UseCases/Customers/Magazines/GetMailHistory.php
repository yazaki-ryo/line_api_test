<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers\Magazines;

use App\Services\DomainCollection;
use Domain\Contracts\Model\FindableContract;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Store;
use Domain\Models\User;

final class GetMailHistory
{
    /** @var FindableContract */
    private $finder;

     /**
     * @param FindableContract $finder
     * @return void
     */
    public function __construct(FindableContract $finder)
    {
        $this->finder = $finder;
    }

    /**
     * @param  array $args
     * @return Store
     * @throws NotFoundException
     */
    public function getStore(array $args): Store
    {
        if (is_null($resource = $this->finder->findAll($args)->first())) {
            throw new NotFoundException('Resource not found.');
        }
        return $resource;
    }

    public function count(User $user, Store $store, array $args = []): int
    {
        $args = $this->domainize($user, $args);
        
        return $store->numMailHistories($args);
    }

    /**
     * @param User $user
     * @param Store $store
     * @param array $args
     * @return DomainCollection
     */
    public function excute(User $user, Store $store, array $args = []): DomainCollection
    {
        $args = $this->domainize($user, $args);

        return $store->mailHistories($args);
    }

    /**
     * @param User $user
     * @param array $args
     * @return array
     */
    private function domainize(User $user, array $args = []): array
    {
        /** @var Collection $collection */
        $collection = collect($args);

        $collection->put('relations', [
            'store',
            'customer',
        ]);

        return $collection->all();
    }

}
