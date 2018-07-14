<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Collection\EloquentCollection;
use Domain\Contracts\Models\DomainModel;
use Domain\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

final class EloquentCompany extends Model implements DomainModel
{
    use SoftDeletes;

    /** @var string */
    protected $table = 'companies';

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
     * @return HasMany
     */
    public function stores(): HasMany
    {
        return $this->hasMany(EloquentStore::class, 'company_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(EloquentUser::class, EloquentStore::class, 'company_id', 'store_id', 'id', 'id');
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
