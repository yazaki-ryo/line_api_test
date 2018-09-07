<?php
declare(strict_types=1);

namespace Domain\Contracts\Handlers;

interface HandlableContract
{
    /**
     * @param array $args
     * @return void
     */
    public function process(array $args): void;

    /**
     * @return void
     */
    public function render(): void;

    /**
     * @return void
     */
    public function export(): void;

}
