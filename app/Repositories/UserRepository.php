<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentUser;
use App\Services\Collection\DomainCollection;
use Domain\Contracts\Model\DomainModel;
use Domain\Contracts\Model\DomainModels;
use Domain\Models\User;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;

final class UserRepository implements DomainModel, DomainModels
{
    /** @var EloquentUser */
    private $eloquent;

    /**
     * @param EloquentUser $eloquent
     * @return void
     */
    public function __construct(EloquentUser $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    /**
     * @return DomainCollection
     */
    public function findAll(): DomainCollection
    {
        $collection = $this->eloquent->findAll();

        return $this->toModels($collection);
    }

    /**
     * @param Model $model
     * @param \Illuminate\Database\Eloquent\Model;
     * @return User
     */
    public function toModel(Model $model): User
    {
        return User::of(self::of($model));
    }

    /**
     * @param EloquentCollection $collection
     * @return DomainCollection
     */
    public function toModels(EloquentCollection $collection): DomainCollection
    {
        return $collection->transform(function (EloquentUser $item) {
            return $this->toModel($item);
        });
    }

    /**
     * @param EloquentUser $eloquent
     * @return self
     */
    private static function of(EloquentUser $eloquent)
    {
        return new self($eloquent);
    }

}
