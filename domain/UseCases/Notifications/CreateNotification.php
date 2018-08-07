<?php
declare(strict_types=1);

namespace Domain\UseCases\Notifications;

use App\Notifications\TestNotification;
use Domain\Models\User;

final class CreateNotification
{
    /**
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param  User $user
     * @return void
     */
    public function excute(User $user): void
    {
//         $user->notify(new TestNotification);

        foreach ($user->notifications() as $notification) {
            dd($notification->notifiable());
        }

        dd('end');
    }

}
