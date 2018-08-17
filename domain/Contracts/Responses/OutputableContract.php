<?php
declare(strict_types=1);

namespace Domain\Contracts\Responses;

interface OutputableContract
{
    /**
     * @param  string $mode
     * @param  array $data
     */
    public function output(string $mode, array $data);
}
