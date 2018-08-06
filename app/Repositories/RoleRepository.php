<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentRole;
use App\Services\DomainCollection;
use Domain\Contracts\Model\DomainableInterface;
use Domain\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;

final class RoleRepository implements DomainableInterface
{
    /** @var EloquentRole */
    private $eloquent;

    /**
     * @param EloquentRole|null $eloquent
     * @return void
     */
    public function __construct(EloquentRole $eloquent = null)
    {
        $this->eloquent = is_null($eloquent) ? new EloquentRole: $eloquent;
    }

    /**
     * @param int $id
     * @return Role|null
     */
    public function findById(int $id): ?Role
    {
        if (is_null($resource = $this->eloquent->find($id))) {
            return null;
        }
        return self::toModel($resource);
    }

    /**
     * @param array $args
     * @return DomainCollection
     */
    public function findAll(array $args = []): DomainCollection
    {
        $collection = $this->build($this->newQuery(), $args)->get();
        return self::toModels($collection);
    }

    /**
     * @param Model $model
     * @param \Illuminate\Database\Eloquent\Model;
     * @return Role
     */
    public static function toModel(Model $model): Role
    {
        return Role::of(self::of($model));
    }

    /**
     * @param EloquentCollection $collection
     * @return DomainCollection
     */
    public static function toModels(EloquentCollection $collection): DomainCollection
    {
        return $collection->transform(function (EloquentRole $item) {
            return self::toModel($item);
        });
    }

    /**
     * @return array
     */
    public function attributesToArray(): array
    {
        return $this->eloquent->attributesToArray();
    }

    /**
     * @param  array $args
     * @return DomainCollection
     */
    public function users(array $args = []): DomainCollection
    {
        $collection = UserRepository::build($this->eloquent->users(), $args);
        return UserRepository::toModels($collection);
    }

    /**
     * @param EloquentRole $eloquent
     * @return self
     */
    private static function of(EloquentRole $eloquent)
    {
        return new self($eloquent);
    }

    /**
     * @return Builder
     */
    private function newQuery(): Builder
    {
        return $this->eloquent->newQuery();
    }

    /**
     * @param Builder $query
     * @param array $args
     * @return Builder
     */
    public static function build(Builder $query, array $args = []): Builder
    {
        $args = collect($args);

        return $query;
    }

}
