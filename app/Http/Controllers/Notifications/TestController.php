<?php
declare(strict_types=1);

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use Domain\Models\User;
use Domain\UseCases\Notifications\CreateNotification;
use Illuminate\Http\Request;

final class TestController extends Controller
{
    /** @var CreateNotification */
    private $useCase;

    /**
     * @param  CreateNotification $useCase
     * @return void
     */
    public function __construct(CreateNotification $useCase)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        /** @var User $user */
        $user = $request->assign();
        $this->useCase->excute($user);
    }

}
