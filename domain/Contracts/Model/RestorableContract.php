<?php
declare(strict_types=1);

namespace Domain\Contracts\Model;

interface RestorableContract
{
    /**
     * @param int $id
     * @return void
     */
    public function restore(int $id): void;
}
