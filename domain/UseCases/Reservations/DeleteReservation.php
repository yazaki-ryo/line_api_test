<?php
declare(strict_types=1);

namespace Domain\UseCases\Reservations;

use App\Traits\Database\Transactionable;
use Domain\Contracts\Model\FindableContract;
use Domain\Exceptions\NotFoundException;
use Domain\Models\User;
use Domain\Models\Reservation;

final class DeleteReservation
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
     * @return void
     */
    public function excute(User $user, Reservation $reservation): void
    {
        $this->transaction(function () use ($reservation) {
            $reservation->delete();
        });
    }

}
