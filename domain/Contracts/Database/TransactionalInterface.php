<?php
declare(strict_types=1);

namespace Domain\Contracts\Database;

interface TransactionalInterface
{
    /**
     * @param callable $callee
     * @return mixed
     */
    public function transaction(callable $callee);
}
