<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers\Pdf;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Domain\UseCases\Customers\OutputPdf;
use Illuminate\Contracts\Auth\Factory as Auth;

final class OutputController extends Controller
{
    /** @var OutputPdf */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  OutputPdf $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(OutputPdf $useCase, Auth $auth)
    {
        $this->middleware([
            'authenticate:user',
            sprintf('authorize:%s|%s', 'customers.*', 'customers.pdf.output'),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke()
    {
        $user = UserRepository::toModel($this->auth->user());
        return $this->useCase->excute($user);


        /**
         * TODO Output Flow
         */
        $customer = $this->useCase->getCustomer($customerId);

        $this->authorize('delete', $customer);

        $callback = function () use ($user, $customer) {
            return $this->useCase->excute($user, $customer);
        };

        if (! is_null(rescue($callback, false))) {
            flash(__('An internal error occurred. Please contact the administrator.'), 'danger');
            return back()->withInput();
        }

        flash(__('The :name information was :action.', ['name' => __('elements.resources.customers'), 'action' => __('elements.actions.deleted')]), 'info');
        return redirect()->route('customers');
    }

}
