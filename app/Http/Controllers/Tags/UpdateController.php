<?php
declare(strict_types=1);

namespace App\Http\Controllers\Tags;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tags\UpdateRequest;
use Domain\Models\Tag;
use Domain\Models\User;
use Domain\UseCases\Tags\UpdateTag;
use Illuminate\Http\Request;

final class UpdateController extends Controller
{
    /** @var UpdateTag */
    private $useCase;

    /**
     * @param  UpdateTag $useCase
     * @return void
     */
    public function __construct(UpdateTag $useCase)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.tags.update'))),
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param Request $request
     * @param int $tagId
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function view(Request $request, int $tagId)
    {
        $storeId = $request->cookie(config('cookie.name.current_store'));

        /** @var Tag $tag */
        $tag = $this->useCase->getTag([
            'id' => $tagId,
            'store_id' => $storeId,
        ]);

        $this->authorize('update', $tag);

        return view('tags.edit', [
            'row' => $tag,
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
        $user = $request->assign();
        $storeId = $request->cookie(config('cookie.name.current_store'));

        /** @var Tag $tag */
        $tag = $this->useCase->getTag([
            'id' => $tagId,
            'store_id' => $storeId,
        ]);
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
        return redirect()->route('tags.index');
    }

}
