<?php
declare(strict_types=1);

namespace Domain\Contracts\Database;

interface Transaction
{
    /**
     * @param callable $callee
     * @return mixed
     */
    public function transaction(callable $callee);
}
