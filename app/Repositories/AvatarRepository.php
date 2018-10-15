<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentAvatar;
use App\Eloquents\EloquentUser;
use Domain\Contracts\Model\DomainableContract;
use Domain\Exceptions\DomainRuleException;
use Domain\Models\DomainModel;
use Domain\Models\Avatar;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class AvatarRepository extends EloquentRepository implements DomainableContract
{
    /** @var EloquentAvatar */
    protected $eloquent;

    /**
     * @param EloquentAvatar|null $eloquent
     * @return void
     */
    public function __construct(EloquentAvatar $eloquent = null)
    {
        $this->eloquent = is_null($eloquent) ? new EloquentAvatar : $eloquent;
    }

    /**
     * @param Model $model
     * @return DomainModel
     */
    public static function toModel(Model $model): DomainModel
    {
        return Avatar::of(self::of($model));
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public static function toModels(Collection $collection): Collection
    {
        return $collection->transform(function (EloquentAvatar $item) {
            return self::toModel($item);
        });
    }

    /**
     * @return mixed DomainModel
     * @throws DomainRuleException
     */
    public function avatarable(): DomainModel
    {
        $resource = $this->eloquent->avatarable;

        if ($resource instanceof EloquentUser) {
            return UserRepository::toModel($resource);
        }

        throw new DomainRuleException('Either domain model should be returned.');
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
