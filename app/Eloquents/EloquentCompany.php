<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Services\Collection\DomainCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

final class EloquentCompany extends Model
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
     * @param  array  $models
     * @return DomainCollection
     */
    public function newCollection(array $models = []): DomainCollection
    {
        return new DomainCollection($models);
    }

    /**
     * @return HasMany
     */
    public function stores(): HasMany
    {
        return $this->hasMany(EloquentStore::class, 'company_id', 'id');
    }

    /**
     * @return HasManyThrough
     */
    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(EloquentUser::class, EloquentStore::class, 'company_id', 'store_id', 'id', 'id');
    }

}
