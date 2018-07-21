<?php
declare(strict_types=1);

namespace Domain\Contracts\Prefectures;

use App\Services\Collection\DomainCollection;

interface GetPrefecturesInterface
{
    /**
     * @return DomainCollection
     */
    public function findAll(): DomainCollection;
}
