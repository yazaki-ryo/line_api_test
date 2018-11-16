<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentPermission;
use App\Services\DomainCollection;
use Domain\Contracts\Model\DomainableContract;
use Domain\Models\DomainModel;
use Domain\Models\Permission;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class PermissionRepository extends EloquentRepository implements DomainableContract
{
    /**
     * @param EloquentPermission|null $eloquent
     * @return void
     */
    public function __construct(EloquentPermission $eloquent = null)
    {
        $this->eloquent = is_null($eloquent) ? new EloquentPermission: $eloquent;
    }

    /**
     * @param Model $model
     * @return DomainModel
     */
    public static function toModel(Model $model): DomainModel
    {
        return Permission::of(self::of($model));
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public static function toModels(Collection $collection): Collection
    {
        return $collection->transform(function (EloquentPermission $item) {
            return self::toModel($item);
        });
    }

    /**
     * @param  array $args
     * @return DomainCollection
     */
    public function users(array $args = []): DomainCollection
    {
        $collection = UserRepository::build($this->eloquent->users(), $args)->get();
        return UserRepository::toModels($collection);
    }

    /**
     * @param  mixed $query
     * @param  array $args
     * @return mixed
     */
    public static function build($query, array $args = [])
    {
        $args = collect($args);

        $query->when($args->has($key = 'id'), function (Builder $q) use ($key, $args) {
            $q->id($args->get($key));
        });

        $query->when($args->has($key = 'ids') && is_array($args->get($key)), function (Builder $q) use ($key, $args) {
            $q->ids($args->get($key));
        });

        return $query;
    }

}
