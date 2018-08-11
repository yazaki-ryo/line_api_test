<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Traits\Domainable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

final class EloquentTag extends Model
{
    use Domainable, SoftDeletes;

    /** @var string */
    protected $table = 'tags';

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
     * @return MorphToMany
     */
    public function customers(): MorphToMany
    {
        return $this->morphedByMany(EloquentCustomer::class, 'taggable', 'taggables', 'tag_id', 'taggable_id', 'id', 'id')->withTimestamps();
    }

}
