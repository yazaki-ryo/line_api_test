<?php
declare(strict_types=1);

namespace Domain\Traits;

use Domain\Contracts\Transaction;

trait Transactional
{
    /**
     * @param callable $callee
     * @return mixed
     */
    public function transaction(callable $callee)
    {
        return app(Transaction::class)->transaction($callee);
    }

}
