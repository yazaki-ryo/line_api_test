<?php
declare(strict_types=1);

namespace Domain\Contracts\Responses;

interface OutputableContract
{
    /**
     * @param array $data
     */
    public function output(array $data);
}
