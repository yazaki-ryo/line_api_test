<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers\Magazines;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\Magazines\MailRequest;
use Domain\Models\User;
use Domain\UseCases\Customers\Magazines\SendMail;

final class MailController extends Controller
{
    /** @var SendMail */
    private $useCase;

    /**
     * @param  SendMail $useCase
     * @return void
     */
    public function __construct(SendMail $useCase)
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
    public function __invoke(MailRequest $request)
    {   
        /** @var User $user */
        $user = $request->assign();
        $storeId = $request->cookie(config('cookie.name.current_store'));

        /** @var Store $store */
        $store = $this->useCase->getStore([
            'id' => $storeId,
        ]);

        $args = $request->validated();

        $callback = function () use ($user, $store, $args) {
            return $this->useCase->excute($user, $store, $args);
        };

        if (($result = rescue($callback, false)) === false) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.words.customers'), 'action' => __('elements.words.mail')]), 'success');
        return redirect()->route('customers.index', ['tab' => 'index']);
    }

}
