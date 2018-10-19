<?php
declare(strict_types=1);

namespace Domain\UseCases\Reservations\VisitedHistories;

use App\Traits\Database\Transactionable;
use Domain\Contracts\Model\FindableContract;
use Domain\Exceptions\NotFoundException;
use Domain\Models\Customer;
use Domain\Models\Reservation;
use Domain\Models\User;

final class CreateVisitedHistory
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
     * @param  User $user
     * @param  Customer $customer
     * @param  Reservation $reservation
     * @return void
     */
    public function excute(User $user, Customer $customer, Reservation $reservation): void
    {
        $args = $this->domainize($user, $reservation);

        $this->transaction(function () use ($customer, $args) {
            return $customer->addVisitedHistory($args);
        });
    }

    /**
     * @param  User $user
     * @param  Reservation $reservation
     * @param  array $args
     * @return array
     */
    private function domainize(User $user, Reservation $reservation): array
    {
        $args = collect([]);

        $args->put('reservation_id', $reservation->id());

//         if (! is_null($value = $reservation->customerId())) {
//             $args->put('customer_id', $value);
//         }

        if (! is_null($value = $reservation->reservedAt())) {
            $args->put('visited_at', $value);
        }

        if (! is_null($value = $reservation->seat())) {
            $args->put('seat', $value);
        }

        if (! is_null($value = $reservation->amount())) {
            $args->put('amount', $value);
        }

        return $args->all();
    }

}
