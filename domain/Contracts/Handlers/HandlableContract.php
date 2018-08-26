<?php
declare(strict_types=1);

namespace Domain\Contracts\Handlers;

interface HandlableContract
{
    /**
     * @param $data
     * @return void
     */
    public function process($data): void;
}
