<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Traits\Collections\Domainable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

final class EloquentCompany extends Model
{
    use Domainable, SoftDeletes;

    /** @var string */
    protected $table = 'companies';

    /**
     * @var array
     */
    protected $fillable = [
        'plan_id',
        'prefecture_id',
        'name',
        'kana',
        'postal_code',
        'address',
        'building_name',
        'tel',
        'fax',
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
     * @return HasManyThrough
     */
    public function users(): HasManyThrough
    {
        return $this->hasManyThrough(EloquentUser::class, EloquentStore::class, 'company_id', 'store_id', 'id', 'id');
    }

    /**
     * @return HasManyThrough
     */
    public function customers(): HasManyThrough
    {
        return $this->hasManyThrough(EloquentCustomer::class, EloquentStore::class, 'company_id', 'store_id', 'id', 'id');
    }

    /**
     * @return HasOne
     */
    public function plan(): HasOne
    {
        return $this->hasOne(EloquentPlan::class, 'id', 'plan_id');
    }

    /**
     * @return HasOne
     */
    public function prefecture(): HasOne
    {
        return $this->hasOne(EloquentPrefecture::class, 'id', 'prefecture_id');
    }

}
