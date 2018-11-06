<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Traits\Collections\Domainable;
use App\Traits\Database\Eloquent\Scopable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class EloquentPrintSetting extends Model
{
    use Domainable, Scopable;

    /** @var string */
    protected $table = 'print_settings';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'data',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(EloquentUser::class, 'user_id', 'id');
    }

}
