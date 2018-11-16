<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Traits\Repositories\Creatable;
use App\Traits\Repositories\Deletable;
use App\Traits\Repositories\Findable;
use App\Traits\Repositories\Restorable;
use App\Traits\Repositories\Synchronizable;
use App\Traits\Repositories\Updatable;
use Domain\Contracts\Model\CreatableContract;
use Domain\Contracts\Model\DeletableContract;
use Domain\Contracts\Model\DomainableContract;
use Domain\Contracts\Model\FindableContract;
use Domain\Contracts\Model\RestorableContract;
use Domain\Contracts\Model\UpdatableContract;
use Domain\Models\DomainModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class EloquentRepository implements
    CreatableContract,
    DeletableContract,
    DomainableContract,
    FindableContract,
    RestorableContract,
    UpdatableContract
{
    use Creatable,
        Deletable,
        Findable,
        Restorable,
        Synchronizable,
        Updatable;

    /** @var Model */
    protected $eloquent;

    /**
     * @param  Model $model
     * @return  DomainModel
     */
    abstract public static function toModel(Model $model): DomainModel;

    /**
     * @param  Collection $collection
     * @return  Collection
     */
    abstract public static function toModels(Collection $collection): Collection;

    /**
     * @param  mixed $query
     * @param  array $args
     * @return mixed
     */
    abstract public static function build($query, array $args = []);

    /**
     * @return array
     */
    public function attributesToArray(): array
    {
        return $this->eloquent->attributesToArray();
    }

    /**
     * @param Model $eloquent
     * @return self
     */
    protected static function of(Model $eloquent)
    {
        return new static($eloquent);
    }

    /**
     * @return Builder
     */
    protected function newQuery(): Builder
    {
        return $this->eloquent->newQuery();
    }
}
