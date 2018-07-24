<?php
declare(strict_types=1);

namespace App\Services\Collection;

use Illuminate\Database\Eloquent\Collection;

final class DomainCollection extends Collection
{
    /**
     * @return array
     */
    public function pluckNamesByIds(): array
    {
        return $this->map(function ($item) {
            return [
                'id'   => $item->id(),
                'name' => $item->name(),
            ];
        })->pluck('name', 'id')->all();
    }
}
