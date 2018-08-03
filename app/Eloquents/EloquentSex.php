<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Services\Collection\DomainCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class EloquentSex extends Model
{
    use SoftDeletes;

    /** @var string */
    protected $table = 'sexes';

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
     * @return DomainCollection
     */
    public function newCollection(array $models = []): DomainCollection
    {
        return new DomainCollection($models);
    }

    /**
     * @return HasMany
     */
    public function customers(): HasMany
    {
        return $this->hasMany(EloquentCustomer::class, 'sex_id', 'id');
    }

}
