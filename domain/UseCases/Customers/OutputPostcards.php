<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use Domain\Contracts\Model\FindableContract;
use Domain\Contracts\Responses\OutputableContract;
use Domain\Models\User;

final class OutputPostcards
{
    /** @var OutputableContract $service */
    private $service;

    /** @var FindableContract */
    private $finder;

    /**
     * @param  OutputableContract $service
     * @param  FindableContract $finder
     * @return void
     */
    public function __construct(OutputableContract $service, FindableContract $finder)
    {
        $this->service = $service;
        $this->finder = $finder;
    }

    /**
     * @param User $user
     * @param array $args
     */
    public function excute(User $user, array $args)
    {
        $args = $this->domainize($user, $args);
        $data = $this->finder->findIds($args['ids'])->toArray();

        return $this->service
            ->setHandlersByKeys($args['mode'])
            ->output($data);
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

        if ($collection->has($key = 'selection')) {
            $collection->put('ids', explode(',', $collection->get($key)));
            $collection->forget($key);
        }

        return $collection->all();
    }

}
