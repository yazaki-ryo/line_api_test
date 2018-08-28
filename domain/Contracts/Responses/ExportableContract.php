<?php
declare(strict_types=1);

namespace Domain\Contracts\Responses;

interface ExportableContract
{
    /**
     * @param array $args
     */
    public function export(array $args);
}
