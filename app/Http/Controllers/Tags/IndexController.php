<?php
declare(strict_types=1);

namespace App\Http\Controllers\Tags;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tags\SearchRequest;
use Domain\Models\Tag;
use Domain\Models\User;
use Domain\UseCases\Tags\GetTags;

final class IndexController extends Controller
{
    /** @var GetTags */
    private $useCase;

    /**
     * @param  GetTags $useCase
     * @return void
     */
    public function __construct(GetTags $useCase)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.tags.select'))),
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param SearchRequest $request
     * @param Tag $tag
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function __invoke(SearchRequest $request, Tag $tag)
    {
        /** @var User $user */
        $user = $request->assign();
        $args = $request->validated();
        $storeId = $request->cookie(config('cookie.name.current_store'));

        $store = $this->useCase->getStore([
            'id' => $storeId,
        ]);

        return view('tags.index', [
            'rows' => $this->useCase->excute($user, $store, $args),
            'row' => $tag,
        ]);
    }

}
