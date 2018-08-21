<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Traits\Collections\Domainable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class EloquentSex extends Model
{
    use Domainable, SoftDeletes;

    /** @var string */
    protected $table = 'sexes';

    /**
     * @var array
     */
    protected $fillable = [
        //
    ];

    /**
     * @return HasMany
     */
    public function customers(): HasMany
    {
        return $this->hasMany(EloquentCustomer::class, 'sex_id', 'id');
    }

}
