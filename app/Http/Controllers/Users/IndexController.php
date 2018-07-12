<?php
declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Domain\UseCases\Users\GetUsers;
use Illuminate\Http\Request;

final class IndexController extends Controller
{
    /** @var GetUsers */
    private $useCase;

    /**
     * @param  GetUsers $useCase
     * @return void
     */
    public function __construct(GetUsers $useCase)
    {
        $this->middleware('auth');

        $this->useCase = $useCase;
    }

    /**
     * @param  Request $request
     */
    public function __invoke(Request $request)
    {
        $result = $this->useCase->excute();

        return dd($result);
    }

}
