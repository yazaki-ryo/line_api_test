<?php
declare(strict_types=1);

namespace Domain\Contracts\Handlers;

interface HandlableContract
{
    /**
     * @return void
     */
    public function process(): void;
}
