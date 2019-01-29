<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Traits\Collections\Domainable;
use App\Traits\Database\Eloquent\Scopable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

final class EloquentAttachment extends Model
{
    use Domainable, Scopable;

    /** @var string */
    protected $table = 'attachments';

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
    public function attachmentable(): MorphTo
    {
        return $this->morphTo('attachmentable', 'attachmentable_type', 'attachmentable_id');
    }

}
