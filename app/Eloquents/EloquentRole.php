<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Traits\Collections\Domainable;
use App\Traits\Database\Eloquent\Scopable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class EloquentRole extends Model
{
    use Domainable, Scopable, SoftDeletes;

    /** @var string */
    protected $table = 'roles';

    /**
     * @var array
     */
    protected $fillable = [
        //
    ];

    /**
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(EloquentUser::class, 'role_id', 'id');
    }

}
