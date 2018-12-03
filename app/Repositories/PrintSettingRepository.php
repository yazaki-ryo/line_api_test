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
        return $collection->transform(function ($item) {
            return $item instanceof EloquentPrintSetting ? self::toModel($item) : $item;
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
        $query = parent::build($query, $args);
        $args  = collect($args);

        return $query;
    }

}
