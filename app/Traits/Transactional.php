<?php
declare(strict_types=1);

namespace App\Traits;

use Domain\Contracts\Database\Transaction;

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
