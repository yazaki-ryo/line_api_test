<?php
declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Create a new request instance.
     *
     * @return mixed
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Http\FormRequest::attributes()
     */
    public function attributes(): array
    {
        return [
            'name'                  => 'ログイン名',
            'email'                 => 'メールアドレス',
            'password'              => 'パスワード',
            'password_confirmation' => 'パスワード(確認)',
        ];
    }

}
