<?php
declare(strict_types=1);

namespace App\Http\Controllers\Tags;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tags\SearchRequest;
use App\Repositories\UserRepository;
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
            'authenticate:user',
            sprintf('authorize:%s|%s', 'tags.*', 'tags.select'),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @param SearchRequest $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke(SearchRequest $request)
    {
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());
        $args = $request->validated();

        return view('tags.index', [
            'rows' => $this->useCase->excute($user, $args),
        ]);
    }

}
