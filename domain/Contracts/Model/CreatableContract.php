<?php
declare(strict_types=1);

namespace Domain\Contracts\Model;

interface CreatableContract
{
    /**
     * @param array $args
     */
    public function create(array $args = []);
}
