<?php
declare(strict_types=1);

namespace Domain\UseCases\Adapters;

use Domain\Contracts\Model\FindableContract;
use Domain\Contracts\Database\TransactionableContract;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Customer;
use Domain\Models\User;

final class UpdateCustomerAdapter
{
    /** @var FindableContract */
    private $finder;

    /** @var TransactionableContract */
    private $transactionalService;

    /**
     * @param FindableContract $finder
     * @param TransactionableContract $transactionalService
     * @return void
     */
    public function __construct(
        FindableContract $finder,
        TransactionableContract $transactionalService
    ) {
        $this->finder = $finder;
        $this->transactionalService = $transactionalService;
    }

}
