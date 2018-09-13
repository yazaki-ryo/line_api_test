<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Traits\Collections\Domainable;
use App\Traits\Database\Eloquent\Scopable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

final class EloquentAvatar extends Model
{
    use Domainable, Scopable;

    /** @var string */
    protected $table = 'avatars';

    /**
     * @var array
     */
    protected $fillable = [
        'path',
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
