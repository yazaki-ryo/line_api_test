<?php
declare(strict_types=1);

namespace App\Traits\Repositories;

use App\Services\DomainCollection;
use Domain\Models\DomainModel;
use Illuminate\Database\Eloquent\Builder;

trait Findable
{
    /**
     * @param int $id
     * @param bool $trashed
     * @return DomainModel|null
     */
    public function find(int $id, bool $trashed = false): ?DomainModel
    {
        $resource = $this->eloquent->newQuery()
            ->when($trashed, function (Builder $query) {
                $query->onlyTrashed();
            })->find($id);

        if (is_null($resource)) {
            return null;
        }
        return static::toModel($resource);
    }

    /**
     * @param array $args
     * @return DomainCollection
     */
    public function findMany(array $args = []): DomainCollection
    {
        $collection = $this->build($this->newQuery(), $args)->get();
        return static::toModels($collection);
    }
}
