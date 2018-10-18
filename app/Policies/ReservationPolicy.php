<?php
declare(strict_types=1);

namespace App\Policies;

use App\Eloquents\EloquentUser;
use Domain\Models\Reservation;
use Illuminate\Auth\Access\HandlesAuthorization;

final class ReservationPolicy
{
    use HandlesAuthorization;

    /**
     * @param  EloquentUser  $user
     * @param  string  $ability
     * @return boolean|null
     */
    public function before(EloquentUser $user, string $ability): ?bool
    {
        return null;
    }

    /**
     * @param  EloquentUser  $user
     * @param  Reservation  $reservation
     * @return bool
     */
    public function select(EloquentUser $user, Reservation $reservation): bool
    {
        if ($user->can('authorize', 'reservations.select')) {
            return true;
        } elseif ($user->can('authorize', 'own-company-reservations.select')
            && optional($user->store)->company_id === optional($reservation->store())->companyId()
        ) {
            return true;
        } elseif ($user->can('authorize', 'own-company-self-store-reservations.select')
            && $user->store_id === $reservation->storeId()
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param  EloquentUser  $user
     * @return bool
     */
    public function create(EloquentUser $user): bool
    {
        return false;
    }

    /**
     * @param  EloquentUser  $user
     * @param  Reservation  $reservation
     * @return bool
     */
    public function update(EloquentUser $user, Reservation $reservation): bool
    {
        if ($user->can('authorize', 'reservations.update')) {
            return true;
        } elseif ($user->can('authorize', 'own-company-reservations.update')
            && optional($user->store)->company_id === optional($reservation->store())->companyId()
        ) {
            return true;
        } elseif ($user->can('authorize', 'own-company-self-store-reservations.update')
            && $user->store_id === $reservation->storeId()
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param  EloquentUser  $user
     * @param  Reservation  $reservation
     * @return bool
     */
    public function delete(EloquentUser $user, Reservation $reservation): bool
    {
        if ($user->can('authorize', 'reservations.delete')) {
            return true;
        } elseif ($user->can('authorize', 'own-company-reservations.delete')
            && optional($user->store)->company_id === optional($reservation->store())->companyId()
        ) {
            return true;
        } elseif ($user->can('authorize', 'own-company-self-store-reservations.delete')
            && $user->store_id === $reservation->storeId()
        ) {
            return true;
        }

        return false;
    }

    /**
     * @param  EloquentUser  $user
     * @param  Reservation  $reservation
     * @return bool
     */
    public function restore(EloquentUser $user, Reservation $reservation): bool
    {
        if ($user->can('authorize', 'reservations.restore')) {
            return true;
        } elseif ($user->can('authorize', 'own-company-reservations.restore')
            && optional($user->store)->company_id === optional($reservation->store())->companyId()
        ) {
            return true;
        } elseif ($user->can('authorize', 'own-company-self-store-reservations.restore')
            && $user->store_id === $reservation->storeId()
        ) {
            return true;
        }

        return false;
    }

}

