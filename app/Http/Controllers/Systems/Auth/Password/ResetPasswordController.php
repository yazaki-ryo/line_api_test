<?php
declare(strict_types=1);

namespace App\Http\Controllers\Systems\Auth\Password;

use App\Http\Controllers\Systems\Controller;
use App\Http\Requests\Auth\ResetRequest;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

final class ResetController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:administrator');
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view(sprintf('%s.auth.passwords.reset', $this->prefix))->with([
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  ResetRequest $validator
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function reset(Request $request, ResetRequest $validator)
    {
        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($response)
            : $this->sendResetFailedResponse($request, $response);
    }

    /**
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    private  function sendResetResponse($response)
    {
        return redirect($this->redirectPath())->with('alerts.success', [__($response)]);
    }

    /**
     * @return string
     */
    private function redirectTo()
    {
        return route(sprintf('%s.home', $this->prefix));
    }

}
