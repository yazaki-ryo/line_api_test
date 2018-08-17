<?php
declare(strict_types=1);

namespace Domain\Adapters\Customers;

use App\Traits\Database\Transactionable;
use Domain\Contracts\Database\TransactionableContract;

final class UpdateCustomerAdapter implements TransactionableContract
{
    use Transactionable;
}
