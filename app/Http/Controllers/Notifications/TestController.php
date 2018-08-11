<?php
declare(strict_types=1);

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
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
            'authenticate:user',
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke()
    {
        $user = UserRepository::toModel($this->auth->user());
        $this->useCase->excute($user);
    }

}
