<?php
declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;

final class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  RegisterRequest $validator
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request, RegisterRequest $validator)
    {
        $user = $this->create($request->all());

        event(new Registered($user));

        /**
         * TODO 仮登録フロー構築
         */
//         $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    private function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    private function registered(Request $request, $user)
    {
        // ここでユーザ登録メール送信が良いか

        return redirect($this->redirectPath())->with('alerts.success', [__('User temporary registration is completed.')]);
    }

    /**
     * @return string
     */
    private function redirectTo()
    {
        return route('login');
    }

}
