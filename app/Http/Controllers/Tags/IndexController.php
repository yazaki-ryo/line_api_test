<?php
declare(strict_types=1);

namespace App\Http\Controllers\Tags;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tags\SearchRequest;
use App\Repositories\UserRepository;
use Domain\Models\Tag;
use Domain\Models\User;
use Domain\UseCases\Tags\GetTags;
use Illuminate\Contracts\Auth\Factory as Auth;

final class IndexController extends Controller
{
    /** @var GetTags */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  GetTags $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(GetTags $useCase, Auth $auth)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.tags.select'))),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @param SearchRequest $request
     * @param Tag $tag
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke(SearchRequest $request, Tag $tag)
    {
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());
        $args = $request->validated();
        $storeId = session(config('session.name.current_store'));

        return view('tags.index', [
            'rows' => $this->useCase->excute($user, array_merge($args, [
                'store_id' => $storeId,
            ])),
            'row' => $tag,

            /**
             * TODO XXX from config file.
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

}
