<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Collection\EloquentCollection;
use Domain\Contracts\Models\DomainModel;
use Domain\Models\User;
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
     * @return BeLongsToMany
     */
    public function users(): BeLongsToMany
    {
        return $this->belongsToMany(EloquentUser::class, 'permission_user', 'permission_id', 'user_id')->withTimestamps();
    }

    /**
     * @return User
     */
    public function toModel(): User
    {
        return User::ofByArray($this->attributesToArray());
    }

    /**
     * @param  array  $models
     * @return Collection
     */
    public function newCollection(array $models = []): Collection
    {
        return new EloquentCollection($models);
    }
}
