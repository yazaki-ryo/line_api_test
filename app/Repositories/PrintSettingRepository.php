<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentPrintSetting;
use Domain\Contracts\Model\DomainableContract;
use Domain\Models\DomainModel;
use Domain\Models\PrintSetting;
use Domain\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class PrintSettingRepository extends EloquentRepository implements DomainableContract
{
    /** @var EloquentPrintSetting */
    protected $eloquent;

    /**
     * @param EloquentPrintSetting|null $eloquent
     * @return void
     */
    public function __construct(EloquentPrintSetting $eloquent = null)
    {
        $this->eloquent = is_null($eloquent) ? new EloquentPrintSetting: $eloquent;
    }

    /**
     * @param Model $model
     * @return DomainModel
     */
    public static function toModel(Model $model): DomainModel
    {
        return PrintSetting::of(self::of($model));
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public static function toModels(Collection $collection): Collection
    {
        return $collection->transform(function (EloquentPrintSetting $item) {
            return self::toModel($item);
        });
    }

    /**
     * @return User|null
     */
    public function user(): ?User
    {
        if (is_null($resource = $this->eloquent->user)) {
            return null;
        }
        return UserRepository::toModel($resource);
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
