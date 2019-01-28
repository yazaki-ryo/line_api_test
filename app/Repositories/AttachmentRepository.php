<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Eloquents\EloquentAttachment;
use Domain\Contracts\Model\DomainableContract;
use Domain\Models\DomainModel;
use Domain\Models\Attachment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class AttachmentRepository extends EloquentRepository implements DomainableContract
{
    /**
     * @param EloquentAttachment|null $eloquent
     * @return void
     */
    public function __construct(EloquentAttachment $eloquent = null)
    {
        $this->eloquent = is_null($eloquent) ? new EloquentAttachment : $eloquent;
    }

    /**
     * @param Model $model
     * @return DomainModel
     */
    public static function toModel(Model $model): DomainModel
    {
        return Attachment::of(self::of($model));
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public static function toModels(Collection $collection): Collection
    {
        return $collection->transform(function ($item) {
            return $item instanceof EloquentAttachment ? self::toModel($item) : $item;
        });
    }

    /**
     * @return DomainModel
     */
    public function attachmentable(): DomainModel
    {
        $resource = $this->eloquent->attachmentable;
        return EloquentRepository::assign($resource);
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
