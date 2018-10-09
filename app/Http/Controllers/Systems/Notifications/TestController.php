<?php
declare(strict_types=1);

namespace App\Http\Controllers\Systems\Notifications;

use App\Http\Controllers\Systems\Controller;
use App\Repositories\UserRepository;
use Domain\Models\User;
use Domain\UseCases\Notifications\CreateNotification;
use Illuminate\Contracts\Auth\Factory as Auth;

final class TestController extends Controller
{
    /** @var CreateNotification */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  CreateNotification $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(CreateNotification $useCase, Auth $auth)
    {
        $this->middleware([
            'authenticate:administrator',
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke()
    {
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());
        $this->useCase->excute($user);
    }

}
