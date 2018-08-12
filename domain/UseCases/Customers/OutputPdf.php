<?php
declare(strict_types=1);

namespace Domain\UseCases\Customers;

use Domain\Contracts\Model\FindableInterface;
use Domain\Contracts\Responses\OutputInterface;
use Domain\Models\Customer;
use Domain\Models\User;

final class OutputPdf
{
    /** @var OutputInterface $response */
    private $response;

    /** @var FindableInterface */
    private $finder;

    /**
     * @param  OutputInterface $response
     * @param  FindableInterface $finder
     * @return void
     */
    public function __construct(OutputInterface $response, FindableInterface $finder)
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
