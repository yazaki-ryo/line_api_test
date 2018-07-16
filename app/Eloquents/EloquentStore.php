<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Collection\EloquentCollection;
use Domain\Contracts\Models\DomainModel;
use Domain\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class EloquentStore extends Model implements DomainModel
{
    use SoftDeletes;

    /** @var string */
    protected $table = 'stores';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * @return User
     */
    public function toModel(): User
    {
//         return User::ofByArray($this->attributesToArray());
    }

    /**
     * @param  array  $models
     * @return Collection
     */
    public function newCollection(array $models = []): Collection
    {
        return new EloquentCollection($models);
    }

    /**
     * @return BelongsTo
     */
    private function company(): BelongsTo
    {
        return $this->belongsTo(EloquentCompany::class, 'company_id', 'id');
    }

    /**
     * @return HasMany
     */
    private function users(): HasMany
    {
        return $this->hasMany(EloquentUser::class, 'store_id', 'id');
    }

}
