<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Services\Collection\DomainCollection;
use Domain\Contracts\Model\DomainModel;
use Domain\Models\Permission;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BeLongsToMany;

final class EloquentPermission extends Model implements DomainModel
{
    use SoftDeletes;

    /** @var string */
    protected $table = 'permissions';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * @return Permission
     */
    public function toModel(): Permission
    {
        return Permission::ofByArray($this->attributesToArray());
    }

    /**
     * @param  array  $models
     * @return Collection
     */
    public function newCollection(array $models = []): Collection
    {
        return new DomainCollection($models);
    }

    /**
     * @return BeLongsToMany
     */
    public function users(): BeLongsToMany
    {
        return $this->belongsToMany(EloquentUser::class, 'permission_user', 'permission_id', 'user_id')->withTimestamps();
    }

}
