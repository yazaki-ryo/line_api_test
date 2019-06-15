<?php
declare(strict_types=1);

namespace Domain\UseCases\Seats;

use App\Traits\Database\Transactionable;
use Domain\Contracts\Model\FindableContract;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Seat;
use Domain\Models\User;

final class UpdateSeat
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
     * @return Seat
     * @throws NotFoundException
     */
    public function getSeat(array $args): Seat
    {
        if (is_null($resource = $this->finder->findAll($args)->first())) {
            throw new NotFoundException('Resource not found.');
        }
        return $resource;
    }

    /**
     * @param  User $user
     * @param  Seat $seat
     * @param  array $args
     * @return bool
     */
    public function excute(User $user, Seat $seat, array $args = []): bool
    {
        $args = $this->domainize($user, $args);
        return $this->transaction(function () use ($seat, $args) {
            return $seat->update($args);
        });
    }

    /**
     * @param  User $user
     * @param  array $args
     * @return array
     */
    private function domainize(User $user, array $args = []): array
    {
        $args = collect($args);

        if ($args->has($key = '')) {
            //
        }

        return $args->all();
    }

}
