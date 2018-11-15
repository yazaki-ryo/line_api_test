<?php
declare(strict_types=1);

namespace App\Services;

use Domain\Models\DomainModel;
use Illuminate\Database\Eloquent\Collection;

final class DomainCollection extends Collection
{
    /**
     * @return void
     */
    public function destroy(): void
    {
        $this->each(function (DomainModel $item) {
            $item->delete();
        });
    }

    /**
     * @return array
     */
    public function pluckNamesByIds(): array
    {
        return $this->map(function (DomainModel $item) {
            return [
                'id'   => $item->id(),
                'name' => $item->name(),
            ];
        })->pluck('name', 'id')->all();
    }
}
