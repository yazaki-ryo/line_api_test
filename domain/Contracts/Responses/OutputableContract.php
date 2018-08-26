<?php
declare(strict_types=1);

namespace Domain\Contracts\Responses;

interface OutputableContract
{
    /**
     * @param mixed $data
     */
    public function output($data);
}
