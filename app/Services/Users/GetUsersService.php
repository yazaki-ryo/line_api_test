<?php
declare(strict_types=1);

namespace App\Services;

use App\Eloquents\EloquentUser;
use Domain\UseCases\Users\GetUsersInterface;
use Illuminate\Support\Collection;

final class GetUsersService implements GetUsersInterface
{
    /** @var EloquentUser */
    private $user;

    /**
     * @param EloquentUser $user
     */
    public function __construct(EloquentUser $user)
    {
        $this->user = $user;
    }

    /**
     * @return Collection
     */
    public function findAll(): Collection
    {
        return $this->user->findAll()->toModels();
    }
}
