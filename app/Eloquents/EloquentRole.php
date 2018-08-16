<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Traits\Collections\Domainable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class EloquentRole extends Model
{
    use Domainable, SoftDeletes;

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
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(EloquentUser::class, 'role_id', 'id');
    }

}
