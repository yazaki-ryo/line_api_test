<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use Domain\Contracts\Model\FindableContract;
use Domain\Contracts\Responses\OutputableContract;
use Domain\Models\User;

final class OutputPostcards
{
    /** @var OutputableContract $response */
    private $response;

    /** @var FindableContract */
    private $finder;

    /**
     * @param  OutputableContract $response
     * @param  FindableContract $finder
     * @return void
     */
    public function __construct(OutputableContract $response, FindableContract $finder)
    {
        $this->response = $response;
        $this->finder = $finder;
    }

    /**
     * @param  User $user
     */
    public function excute(User $user)
    {
        $mode = 'test';
        $data = [];

        return $this->response->output($mode, $data);
    }

}
