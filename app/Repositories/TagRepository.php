<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentTag;
use App\Services\DomainCollection;
use Domain\Contracts\Model\DomainableInterface;
use Domain\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;

final class TagRepository implements DomainableInterface
{
    /** @var EloquentTag */
    private $eloquent;

    /**
     * @param EloquentTag|null $eloquent
     * @return void
     */
    public function __construct(EloquentTag $eloquent = null)
    {
        $this->eloquent = is_null($eloquent) ? new EloquentTag: $eloquent;
    }

    /**
     * @param int $id
     * @return Tag|null
     */
    public function findById(int $id): ?Tag
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
     * @return Tag
     */
    public static function toModel(Model $model): Tag
    {
        return Tag::of(self::of($model));
    }

    /**
     * @param EloquentCollection $collection
     * @return DomainCollection
     */
    public static function toModels(EloquentCollection $collection): DomainCollection
    {
        return $collection->transform(function (EloquentTag $item) {
            return self::toModel($item);
        });
    }

    /**
     * @param  array $args
     * @return DomainCollection
     */
    public function customers(array $args = []): DomainCollection
    {
        $collection = CustomerRepository::build($this->eloquent->customers(), $args)->get();
        return CustomerRepository::toModels($collection);
    }

    /**
     * @return array
     */
    public function attributesToArray(): array
    {
        return $this->eloquent->attributesToArray();
    }

    /**
     * @param EloquentTag $eloquent
     * @return self
     */
    private static function of(EloquentTag $eloquent)
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
     * @param  mixed $query
     * @param  array $args
     * @return mixed
     */
    public static function build($query, array $args = [])
    {
        $args = collect($args);

        return $query;
    }

}
