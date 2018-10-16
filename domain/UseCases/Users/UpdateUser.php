<?php
declare(strict_types=1);

namespace Domain\UseCases\Users;

use App\Traits\Database\Transactionable;
use Domain\Contracts\Model\FindableContract;
use Domain\Exceptions\NotFoundException;
use Domain\Models\User;

final class UpdateUser
{
    use Transactionable;

    /** @var FindableContract */
    private $finder;

    /**
     * @param FindableContract $finder
     * @return void
     */
    public function __construct(FindableContract $finder)
    {
        $this->finder = $finder;
    }

    /**
     * @param  array $args
     * @return User
     * @throws NotFoundException
     */
    public function getUser(array $args): User
    {
        if (is_null($resource = $this->finder->findAll($args)->first())) {
            throw new NotFoundException('Resource not found.');
        }
        return $resource;
    }

    /**
     * @param  User $user
     * @param  User $targetUser
     * @param  array $args
     * @return bool
     */
    public function excute(User $user, User $targetUser, array $args = []): bool
    {
        $args = $this->domainize($user, $targetUser, $args);

        return $this->transaction(function () use ($targetUser, $args) {
            return $targetUser->update($args);
        });
    }

    /**
     * @param  User $user
     * @param  User $targetUser
     * @param  array $args
     * @return array
     */
    private function domainize(User $user, User $targetUser, array $args = []): array
    {
        $args = collect($args);

        if ($args->has($key = '')) {
            //
        }

        return $args->all();
    }

}
