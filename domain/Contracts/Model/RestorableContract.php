<?php
declare(strict_types=1);

namespace Domain\Contracts\Model;

interface RestorableInterface
{
    /**
     * @param int $id
     * @return void
     */
    public function restore(int $id): void;
}
