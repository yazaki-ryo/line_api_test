<?php
declare(strict_types=1);

namespace App\Http\Views\Composers;

use App\Repositories\UserRepository;
use Illuminate\Contracts\Auth\Factory as Auth;
use Illuminate\View\View;

final class AuthComposer
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

        $view->with('user', UserRepository::toModel($this->auth->user()));
    }

}
