<?php
declare(strict_types=1);

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Repositories\EloquentRepository;
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
            sprintf('authenticate:%s', $this->guard),
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
        $user = EloquentRepository::assign($this->auth->user(), true);
        $this->useCase->excute($user);
    }

}
