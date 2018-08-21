<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Traits\Collections\Domainable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;

final class EloquentAvatar extends Model
{
    use Domainable, SoftDeletes;

    /** @var string */
    protected $table = 'avatars';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @return MorphTo
     */
    public function avatarable(): MorphTo
    {
        return $this->morphTo('avatarable', 'avatarable_type', 'avatarable_id');
    }

}
