<?php
declare(strict_types=1);

namespace App\Http\Controllers\Systems;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** @var string */
    protected $guard = 'administrator';

    /** @var string */
    protected $prefix = 'systems';
}
