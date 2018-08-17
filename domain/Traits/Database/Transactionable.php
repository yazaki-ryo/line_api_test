<?php
declare(strict_types=1);

namespace Domain\Traits\Database;

use Domain\Contracts\Database\TransactionableContract;

trait Transactionable
{
    /**
     * @param callable $callee
     * @return mixed
     */
    public function transaction(callable $callee)
    {
        return app(TransactionableContract::class)->transaction($callee);
    }

}
