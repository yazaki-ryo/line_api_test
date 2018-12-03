<?php
declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Domain\Models\User;
use Domain\UseCases\Users\RestoreUser;
use Illuminate\Http\Request;

final class RestoreController extends Controller
{
    /** @var RestoreUser */
    private $useCase;

    /**
     * @param  RestoreUser $useCase
     * @return void
     */
    public function __construct(RestoreUser $useCase)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.users.restore'))),
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param Request $request
     * @param int $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request, int $userId)
    {
        /** @var User $user */
        $user = $request->assign();
        $storeId = $request->cookie(config('cookie.name.current_store'));

        /** @var User $targetUser */
        $targetUser = $this->useCase->getUser([
            'id' => $userId,
            'store_id' => $storeId,
            'trashed' => 'only',
        ]);

        $this->authorize('restore', $targetUser);

        $callback = function () use ($user, $targetUser) {
            return $this->useCase->excute($user, $targetUser);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.users'), 'action' => __('elements.words.restored')]), 'success');
        return redirect()->route('users.index');
    }

}
