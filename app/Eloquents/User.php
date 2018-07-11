<?php
declare(strict_types=1);

namespace App\Eloquents;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

final class User extends Authenticatable
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

}
