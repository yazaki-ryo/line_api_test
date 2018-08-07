<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Traits\Domainable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class EloquentPlan extends Model
{
    use Domainable, SoftDeletes;

    /** @var string */
    protected $table = 'plans';

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
    public function companies(): HasMany
    {
        return $this->hasMany(EloquentCompany::class, 'plan_id', 'id');
    }

}
