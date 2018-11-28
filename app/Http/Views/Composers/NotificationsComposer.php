<?php
declare(strict_types=1);

namespace App\Http\Views\Composers;

use Domain\Models\Notification;
use Domain\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class NotificationsComposer
{
    /** @var Request */
    private $request;

    /**
     * @param  Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (is_null($this->request->user())) {
            return;
        }

        $this->excute($view);
    }

    /**
     * @param  View  $view
     * @return void
     */
    public function create(View $view)
    {
        if (is_null($this->request->user())) {
            return;
        }

        $this->excute($view);
    }

    /**
     * @param  View  $view
     * @return void
     */
    private function excute(View $view)
    {
        /** @var User $user */
        $user = $this->request->assign();
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
