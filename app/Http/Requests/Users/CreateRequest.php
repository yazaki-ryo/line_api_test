<?php
declare(strict_types=1);

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

final class CreateRequest extends FormRequest
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
                'unique:users,email',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:16',
                'confirmed',
            ],
            'role' => [
                'sometimes',
                'required',
                'string',
                Rule::in(array_keys(config('permissions.roles.general'))),
                // TODO by permissions
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
