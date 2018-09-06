<?php
declare(strict_types=1);

namespace Domain\Contracts\Responses;

interface ExportableContract
{
    /**
     * @param array $data
     * @param array $settings
     */
    public function export(array $data, array $settings = []);
}
