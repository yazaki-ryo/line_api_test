<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\CreateRequest;
use Domain\Models\User;
use Domain\UseCases\Customers\CreateCustomer;
use Illuminate\Http\UploadedFile;

final class CreateController extends Controller
{
    /** @var CreateCustomer */
    private $useCase;

    /**
     * @param  CreateCustomer $useCase
     * @return void
     */
    public function __construct(CreateCustomer $useCase)
    {
        $this->middleware([
            sprintf('authenticate:%s', $this->guard),
            sprintf('authorize:%s', implode('|', config('permissions.groups.customers.create'))),
        ]);

        $this->useCase = $useCase;
    }

    /**
     * @param CreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(CreateRequest $request)
    {
        /** @var User $user */
        $user = $request->assign();
        $storeId = $request->cookie(config('cookie.name.current_store'));

        /** @var Store $store */
        $store = $this->useCase->getStore([
            'id' => $storeId,
        ]);

        $args = $request->validated();

        /** @var UploadedFile $file */
        $file = $request->file('attachment');

        $callback = function () use ($user, $store, $args, $file) {
            return $this->useCase->excute($user, $store, $args, $file);
        };

        if (($result = rescue($callback, false)) === false) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.customers'), 'action' => __('elements.words.created')]), 'success');
        return redirect()->route('customers.edit', $result->id());
    }

}
