<?php
declare(strict_types=1);

namespace Domain\Contracts\Responses;

interface ExportableContract
{
    /**
     * @param array $data
     */
    public function export(array $data);
}
