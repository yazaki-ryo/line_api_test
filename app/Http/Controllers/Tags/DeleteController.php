<?php
declare(strict_types=1);

namespace App\Http\Controllers\Tags;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Domain\Models\User;
use Domain\UseCases\Tags\DeleteTag;
use Illuminate\Contracts\Auth\Factory as Auth;

final class DeleteController extends Controller
{
    /** @var DeleteTag */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  DeleteTag $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(DeleteTag $useCase, Auth $auth)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.tags.delete'))),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @param int $tagId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(int $tagId)
    {
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());

        $storeId = session(config('session.name.current_store'));

        /** @var Tag $tag */
        $tag = $this->useCase->getTag([
            'id' => $tagId,
            'store_id' => $storeId,
        ]);

        $this->authorize('delete', $tag);

        $callback = function () use ($user, $tag) {
            return $this->useCase->excute($user, $tag);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.tags'), 'action' => __('elements.words.deleted')]), 'info');
        return redirect()->route('tags.index');
    }

}
