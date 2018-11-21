<?php
declare(strict_types=1);

namespace App\Http\Views\Composers;

use App\Repositories\EloquentRepository;
use Domain\Models\Notification;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\View\View;

final class NotificationsComposer
{
    /** @var Auth */
    private $auth;

    /**
     * @param  Auth $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $this->excute($view);
    }

    /**
     * @param  View  $view
     * @return void
     */
    public function create(View $view)
    {
        $this->excute($view);
    }

    /**
     * @param  View  $view
     * @return void
     */
    private function excute(View $view)
    {
        if (! $this->auth->check()) return;

        $user = EloquentRepository::assign($this->auth->user(), true);

        $notifications = $user->notifications();

        $view->with('notifications', $notifications);
        $view->with('readNotifications', $notifications->filter(function (Notification $item) {
            return $item->readAt() !== null;
        }));
        $view->with('unreadNotifications', $notifications->filter(function (Notification $item) {
            return $item->readAt() === null;
        }));
    }

}
