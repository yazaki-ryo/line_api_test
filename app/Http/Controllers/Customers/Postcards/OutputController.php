<?php
declare(strict_types=1);

namespace App\Http\Controllers\Customers\Postcards;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customers\Postcards\OutputRequest;
use App\Repositories\UserRepository;
use Domain\Models\User;
use Domain\UseCases\Customers\OutputPostcards;
use Illuminate\Contracts\Auth\Factory as Auth;

final class OutputController extends Controller
{
    /** @var OutputPostcards */
    private $useCase;

    /** @var Auth */
    private $auth;

    /**
     * @param  OutputPostcards $useCase
     * @param  Auth $auth
     * @return void
     */
    public function __construct(OutputPostcards $useCase, Auth $auth)
    {
        $this->middleware([
            'authenticate:user',
            sprintf('authorize:%s|%s', 'customers.*', 'customers.postcards.output'),
        ]);

        $this->useCase = $useCase;
        $this->auth = $auth;
    }

    /**
     * @param OutputRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(OutputRequest $request)
    {
        /** @var User $user */
        $user = UserRepository::toModel($this->auth->user());
        $args = $request->validated();

        return $this->useCase->excute($user, $args);
    }

}
