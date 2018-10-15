<?php
declare(strict_types=1);

namespace App\Http\Controllers\Tags;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tags\UpdateRequest;
use App\Repositories\UserRepository;
use Domain\Models\Tag;
use Domain\Models\User;
use Domain\UseCases\Tags\UpdateTag;
use Illuminate\Contracts\Auth\Factory as Auth;

final class UpdateController extends Controller
{
    /** @var UpdateTag */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  UpdateTag $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(UpdateTag $useCase, Auth $auth)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.tags.update'))),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @param int $tagId
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(int $tagId)
    {
        /** @var Tag $tag */
        $tag = $this->useCase->getTag($tagId);

        $this->authorize('update', $tag);

        return view('tags.edit', [
            'row' => $tag,
            /**
             * TODO XXX configから取得
             */
            'labels' => [
                'default' => 'デフォルト',
                'primary' => 'プライマリ',
                'info'    => 'インフォメーション',
                'success' => 'サクセス',
                'warning' => 'ワーニング',
                'danger'  => 'デンジャー',
            ],
        ]);
    }

    /**
     * @param  UpdateRequest $request
     * @param  int $tagId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, int $tagId)
    {
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());

        /** @var Tag $tag */
        $tag = $this->useCase->getTag($tagId);
        $args = $request->validated();

        $this->authorize('update', $tag);

        $callback = function () use ($user, $tag, $args) {
            $this->useCase->excute($user, $tag, $args);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.tags'), 'action' => __('elements.words.updated')]), 'success');
        return redirect()->route('tags');
    }

}
