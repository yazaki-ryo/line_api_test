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
     */
    public function excute(User $user)
    {
        return $this->service
            ->setHandlersByKeys('new_year_card')// TODO Here is selected mode.
            ->output($this->finder->findMany()->toArray());// TODO Here is selected customers.
    }

}
