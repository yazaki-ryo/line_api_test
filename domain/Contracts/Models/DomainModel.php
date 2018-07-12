<?php
declare(strict_types=1);

namespace Domain\Contracts\Models;

interface DomainModel
{
    public function toModel();
}
