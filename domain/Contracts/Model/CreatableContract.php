<?php
declare(strict_types=1);

namespace Domain\Contracts\Model;

interface CreatableInterface
{
    /**
     * @param array $args
     */
    public function create(array $args = []);
}
