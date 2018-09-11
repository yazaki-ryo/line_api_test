<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Traits\Collections\Domainable;
use App\Traits\Database\Eloquent\Scopable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class EloquentPrefecture extends Model
{
    use Domainable, Scopable, SoftDeletes;

    /** @var string */
    protected $table = 'prefectures';

    /**
     * @var array
     */
    protected $fillable = [
        //
    ];

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
