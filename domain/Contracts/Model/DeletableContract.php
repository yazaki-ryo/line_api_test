<?php
declare(strict_types=1);

namespace Domain\Contracts\Model;

interface DeletableContract
{
    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;
}
