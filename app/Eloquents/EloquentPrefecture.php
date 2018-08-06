<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Services\DomainCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class EloquentPrefecture extends Model
{
    use SoftDeletes;

    /** @var string */
    protected $table = 'prefectures';

    /**
     * @var array
     */
    protected $fillable = [
        //
    ];

    /**
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * @param  array  $models
     * @return Collection
     */
    public function newCollection(array $models = []): Collection
    {
        return new DomainCollection($models);
    }

    /**
     * @return HasMany
     */
    public function companies(): HasMany
    {
        return $this->hasMany(EloquentCompany::class, 'prefecture_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function customers(): HasMany
    {
        return $this->hasMany(EloquentCustomer::class, 'prefecture_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function stores(): HasMany
    {
        return $this->hasMany(EloquentStore::class, 'prefecture_id', 'id');
    }

}
