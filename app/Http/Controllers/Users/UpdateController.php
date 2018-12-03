<?php
declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateRequest;
use Domain\Models\User;
use Domain\UseCases\Users\UpdateUser;
use Illuminate\Http\Request;

final class UpdateController extends Controller
{
    /** @var UpdateUser */
    private $useCase;

    /**
     * @param  UpdateUser $useCase
     * @return void
     */
    public function __construct(UpdateUser $useCase)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.users.update'))),
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param Request $request
     * @param int $userId
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(Request $request, int $userId)
    {
        $storeId = $request->cookie(config('cookie.name.current_store'));

        /** @var User $targetUser */
        $targetUser = $this->useCase->getUser([
            'id' => $userId,
            'store_id' => $storeId,
        ]);

        $this->authorize('update', $targetUser);

        return view('users.edit', [
            'row' => $targetUser,
        ]);
    }

    /**
     * @param  UpdateRequest $request
     * @param  int $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, int $userId)
    {
        /** @var User $user */
        $user = $request->assign();
        $storeId = $request->cookie(config('cookie.name.current_store'));

        /** @var User $targetUser */
        $targetUser = $this->useCase->getUser([
            'id' => $userId,
            'store_id' => $storeId,
        ]);
        $args = $request->validated();

        $this->authorize('update', $targetUser);

        $callback = function () use ($user, $targetUser, $args) {
            $this->useCase->excute($user, $targetUser, $args);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.users'), 'action' => __('elements.words.updated')]), 'success');
        return redirect()->route('users.edit', $userId);
    }

}
