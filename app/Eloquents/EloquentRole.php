<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Collection\EloquentCollection;
use Domain\Contracts\Models\DomainModel;
use Domain\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class EloquentRole extends Model implements DomainModel
{
    use SoftDeletes;

    /** @var string */
    protected $table = 'roles';

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
     * @return Role
     */
    public function toModel(): Role
    {
        return Role::ofByArray($this->attributesToArray());
    }

    /**
     * @param  array  $models
     * @return Collection
     */
    public function newCollection(array $models = []): Collection
    {
        return new EloquentCollection($models);
    }

    /**
     * @return HasMany
     */
    private function users(): HasMany
    {
        return $this->hasMany(EloquentUser::class, 'role_id', 'id');
    }

}
