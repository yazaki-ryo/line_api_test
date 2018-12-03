<?php
declare(strict_types=1);

namespace App\Http\Requests\Users;

use Domain\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

final class SelfUpdateRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        /** @var User $user */
        $user = request()->assign();

        return [
            'name' => [
                'required',
                'string',
                'max:191',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:191',
                Rule::unique('users')->ignore($user->id()),
            ],
            'password' => [
                'nullable',
                'string',
                'min:8',
                'max:16',
                'confirmed',
            ],
            'avatar' => [
                'nullable',
                'file',
                'image',
                'mimes:jpg,jpeg,png,gif',
                'max:2048',
                // Rule::dimensions()->maxWidth(1000)->maxHeight(500)->ratio(3 / 2), // サイズ, 比率を指定する場合
            ],
            'drop_avatar' => [
                'boolean',
            ],
        ];
    }

    /**
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Http\FormRequest::messages()
     * @return array
     */
    public function messages(): array
    {
        return [
            //
        ];
    }

    /**
     * {@inheritDoc}
     * @see \Illuminate\Foundation\Http\FormRequest::attributes()
     * @return array
     */
    public function attributes(): array
    {
        return \Lang::get('attributes.users');
    }

    /**
     * @param Validator $validator
     * @return void
     */
    protected function withValidator(Validator $validator): void
    {
        $this->errorBag = snake_case(studly_case(strtr(str_after(__CLASS__, 'App\\Http\\Requests\\'), '\\', '_')));
    }
}
