<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentPrefecture;
use App\Services\Collection\DomainCollection;
use Domain\Contracts\Model\DomainModel;
use Domain\Contracts\Model\DomainModels;
use Domain\Models\Prefecture;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;

final class PrefectureRepository implements DomainModel, DomainModels
{
    /** @var EloquentPrefecture */
    private $eloquent;

    /**
     * @param EloquentPrefecture $eloquent
     * @return void
     */
    public function __construct(EloquentPrefecture $eloquent)
    {
        $this->eloquent = $eloquent;
    }

    /**
     * @param int $id
     * @return Prefecture
     */
    public function findById(int $id): Prefecture
    {
        $user = $this->eloquent->find($id);

        return self::toModel($user);
    }

    /**
     * @return DomainCollection
     */
    public function findAll(): DomainCollection
    {
        $collection = $this->eloquent->all();

        return self::toModels($collection);
    }

    /**
     * @param Model $model
     * @param \Illuminate\Database\Eloquent\Model;
     * @return Prefecture
     */
    public static function toModel(Model $model): Prefecture
    {
        return Prefecture::of(self::of($model));
    }

    /**
     * @param EloquentCollection $collection
     * @return DomainCollection
     */
    public static function toModels(EloquentCollection $collection): DomainCollection
    {
        return $collection->transform(function (EloquentPrefecture $item) {
            return self::toModel($item);
        });
    }

    /**
     * @return DomainCollection
     */
    public function companies(): DomainCollection
    {
        $collection = $this->eloquent->companies;

        return CompanyRepository::toModels($collection);
    }

    /**
     * @return DomainCollection
     */
    public function stores(): DomainCollection
    {
        $collection = $this->eloquent->stores;

        return StoreRepository::toModels($collection);
    }

    /**
     * @return array
     */
    public function attributesToArray(): array
    {
        return $this->eloquent->attributesToArray();
    }

    /**
     * @param EloquentPrefecture $eloquent
     * @return self
     */
    private static function of(EloquentPrefecture $eloquent)
    {
        return new self($eloquent);
    }

}
