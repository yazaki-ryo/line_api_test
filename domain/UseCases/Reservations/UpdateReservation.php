<?php
declare(strict_types=1);

namespace Domain\UseCases\Reservations;

use App\Traits\Database\Transactionable;
use Carbon\Carbon;
use Domain\Contracts\Model\FindableContract;
use Domain\Exceptions\NotFoundException;
use Domain\Models\User;
use Domain\Models\Reservation;

final class UpdateReservation
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
     * @return Reservation
     * @throws NotFoundException
     */
    public function getReservation(array $args): Reservation
    {
        if (is_null($resource = $this->finder->findAll($args)->first())) {
            throw new NotFoundException('Resource not found.');
        }
        return $resource;
    }

    /**
     * @param User $user
     * @param Reservation $reservation
     * @param array $args
     * @return bool
     */
    public function excute(User $user, Reservation $reservation, array $args = []): bool
    {
        $args = $this->domainize($user, $args);

        return $this->transaction(function () use ($reservation, $args) {
            return $reservation->update($args);
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

        if ($args->has($key1 = 'reserved_date')) {
            $date = $args->get($key1);

            if ($args->has($key2 = 'reserved_time') && !is_null($args->get($key2))) {
                $date = sprintf('%s %s', $date, $args->get($key2));
            }

            $args->put('reserved_at', Carbon::parse($date));
        }

        return $args->all();
    }

}
