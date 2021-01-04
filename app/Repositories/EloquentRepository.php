<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentAvatar;
use App\Eloquents\EloquentCompany;
use App\Eloquents\EloquentCustomer;
use App\Eloquents\EloquentPermission;
use App\Eloquents\EloquentPlan;
use App\Eloquents\EloquentPrefecture;
use App\Eloquents\EloquentPrintSetting;
use App\Eloquents\EloquentReservation;
use App\Eloquents\EloquentSex;
use App\Eloquents\EloquentStore;
use App\Eloquents\EloquentTag;
use App\Eloquents\EloquentUser;
use App\Eloquents\EloquentVisitedHistory;
use App\Eloquents\EloquentPrintHistory;
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
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;
use InvalidArgumentException;

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

    /** @var array */
    private static $modelMap = [
        EloquentAvatar::class => AvatarRepository::class,
        EloquentCompany::class => CompanyRepository::class,
        EloquentCustomer::class => CustomerRepository::class,
        EloquentPermission::class => PermissionRepository::class,
        EloquentPlan::class => PlanRepository::class,
        EloquentPrefecture::class => PrefectureRepository::class,
        EloquentPrintSetting::class => PrintSettingRepository::class,
        EloquentReservation::class => ReservationRepository::class,
        EloquentSex::class => SexRepository::class,
        EloquentStore::class => StoreRepository::class,
        EloquentTag::class => TagRepository::class,
        EloquentSeat::class => SeatRepository::class,
        EloquentUser::class => UserRepository::class,
        EloquentVisitedHistory::class => VisitedHistoryRepository::class,
        EloquentPrintHistory::class => PrintHistoryRepository::class,
    ];

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
     * @return array
     */
    public function attributesToArray(): array
    {
        return $this->eloquent->attributesToArray();
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

        $query->when($args->has($key = 'relations'), function (Builder $q) use ($key, $args) {
            $q->relations($args->get($key));
        });

        return $query;
    }

    /**
     * @param Model $model
     * @param bool $authenticatable
     * @throws InvalidArgumentException
     * @return DomainModel
     */
    public static function assign(Model $model, bool $authenticatable = false): DomainModel
    {
        if ($authenticatable && ! $model instanceof Authenticatable) {
            throw new InvalidArgumentException('Only authenticatable user models will be accepted.');
        }

        if (! is_null($repo = collect(static::$modelMap)->get(get_class($model)))) {
            return app()->make($repo)->toModel($model);
        }

        throw new InvalidArgumentException('No assignable model exists.');
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
