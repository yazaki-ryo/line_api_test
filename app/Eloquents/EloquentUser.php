<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Services\Collection\DomainCollection;
use Domain\Contracts\Model\DomainModel;
use Domain\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

final class EloquentUser extends Authenticatable implements DomainModel
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
     * @return Collection
     */
    public function findAll(): Collection
    {
        return $this->newQuery()->get();
    }

    /**
     * @return User
     */
    public function toModel(): User
    {
        return User::ofByArray(array_merge($this->attributesToArray(), [
            'role'        => $this->loadMissing('role')->role->toModel(),
            'permissions' => $this->loadMissing('permissions')->permissions->toModels(),
        ]));
    }

    /**
     * @param  array  $models
     * @return Collection
     */
    public function newCollection(array $models = []): Collection
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
     * @return BeLongsToMany
     */
    public function permissions(): BeLongsToMany
    {
        return $this->belongsToMany(EloquentPermission::class, 'permission_user', 'user_id', 'permission_id')->withTimestamps();
    }

    /**
     * @return EloquentCompany|null
     */
    public function getCompanyAttribute(): ?EloquentCompany
    {
        return $this->store->company;
    }

}
