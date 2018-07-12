<?php
declare(strict_types=1);

namespace App\Eloquents;

use App\Collection\EloquentCollection;
use Domain\Contracts\Models\DomainModel;
use Domain\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

final class EloquentUser extends Authenticatable implements DomainModel
{
    use Notifiable;

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
        return User::ofByArray($this->attributesToArray());
    }

    /**
     * @param  array  $models
     * @return Collection
     */
    public function newCollection(array $models = []): Collection
    {
        return new EloquentCollection($models);
    }
}
