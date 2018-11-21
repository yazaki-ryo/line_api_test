<?php
declare(strict_types=1);

namespace App\Http\Controllers\Systems\Tags;

use App\Http\Controllers\Systems\Controller;
use App\Http\Requests\Tags\CreateRequest;
use App\Repositories\EloquentRepository;
use Domain\Models\Tag;
use Domain\Models\Store;
use Domain\Models\User;
use Domain\UseCases\Tags\CreateTag;
use Illuminate\Contracts\Auth\Factory as Auth;

final class CreateController extends Controller
{
    /** @var CreateTag */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  CreateTag $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(CreateTag $useCase, Auth $auth)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.tags.create'))),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @param Tag $tag
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(Tag $tag)
    {
        return view('tags.add', [
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
     * @param CreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(CreateRequest $request)
    {
        /** @var User $user */
        $user = EloquentRepository::assign($this->auth->user(), true);

        /** @var Store $store */
        $store = $user->store();

        $args = $request->validated();

        $callback = function () use ($user, $store, $args) {
            return $this->useCase->excute($user, $store, $args);
        };

        if (($result = rescue($callback, false)) === false) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.tags'), 'action' => __('elements.words.created')]), 'success');
        return redirect()->route('tags.edit', $result->id());
    }

}
