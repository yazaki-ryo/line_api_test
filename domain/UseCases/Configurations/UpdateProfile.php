<?php
declare(strict_types=1);

namespace Domain\UseCases\Configurations;

use App\Traits\Database\Transactionable;
use Domain\Models\User;
use Illuminate\Support\Collection;

final class UpdateProfile
{
    use Transactionable;

    /**
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param  User $user
     * @param  array $args
     * @return bool
     */
    public function excute(User $user, array $args = []): bool
    {
        $args = $this->domainize($user, $args);

        return $this->transaction(function () use ($user, $args) {
            if (!empty($args['avatar'])) {
                $user->addAvatar([
                    'name' => $args['avatar'],
                ]);
            }
            return $user->update($args);
        });
    }

    /**
     * @param User $user
     * @param array $args
     * @return array
     */
    private function domainize(User $user, array $args = []): array
    {
        $args = collect($args);

        if ($args->has($key = 'password')) {
            $args = $args->when(empty($args->get($key)), function (Collection $item) use ($key) {
                return $item->except($key);
            }, function (Collection $item) use ($key) {
                return $item->put($key, bcrypt($item->get($key)));
            });
        }

        return $args->all();
    }

}
