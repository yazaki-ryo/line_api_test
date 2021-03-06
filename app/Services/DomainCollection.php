<?php
declare(strict_types=1);

namespace App\Services;

use Domain\Models\DomainModel;
use Domain\Models\PrintSetting;
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
     * @param bool $withDefaults
     * @return self
     */
    public function domainizePrintSettings(bool $withDefaults = false): self
    {
        return $this->sortBy(function (PrintSetting $item) {
            return $item->createdAt();
        })
        ->mapWithKeys(function (PrintSetting $item, $key) {
            return [$key + 1 => $item];
        })
        ->when($withDefaults, function (self $items) {
            return $items->put(10001, PrintSetting::ofByArray([
                'data' => json_encode(config('pdf.defaults.general')),
            ]));
        })
        ->when($withDefaults, function (self $items) {
            return $items->put(10002, PrintSetting::ofByArray([
                'data' => json_encode(config('pdf.defaults.new_year')),
            ]));
        });
    }
    
    public function toPlainObject() {
        $plainObjects = [];
        foreach ($this->items as $item) {
            $plainObjects[] = $item->toPlainObject();
        }
        return $plainObjects;
    }
}
