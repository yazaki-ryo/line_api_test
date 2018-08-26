<?php
declare(strict_types=1);

namespace Domain\Contracts\Handlers;

interface HandlableContract
{
    /**
     * @param array $data
     * @return void
     */
    public function process(array $data): void;
}
