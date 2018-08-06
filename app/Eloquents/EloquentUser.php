<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Services\DomainCollection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

final class EloquentUser extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /** @var string */
    protected $table = 'users';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'store_id',
        'role_id',
        'password',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @param  array  $models
     * @return DomainCollection
     */
    public function newCollection(array $models = []): DomainCollection
    {
        return new DomainCollection($models);
    }

    /**
     * @return BelongsTo
     */
    public function store(): BelongsTo
    {
        return $this->belongsTo(EloquentStore::class, 'store_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function role(): HasOne
    {
        return $this->hasOne(EloquentRole::class, 'id', 'role_id');
    }

    /**
     * @return MorphToMany
     */
    public function permissions(): MorphToMany
    {
        return $this->morphToMany(EloquentPermission::class, 'permissible', 'permissibles', 'permissible_id', 'permission_id', 'id', 'id')->withTimestamps();
    }

}
