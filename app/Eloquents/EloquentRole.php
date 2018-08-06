<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Services\DomainCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class EloquentRole extends Model
{
    use SoftDeletes;

    /** @var string */
    protected $table = 'roles';

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
    public function users(): HasMany
    {
        return $this->hasMany(EloquentUser::class, 'role_id', 'id');
    }

}
