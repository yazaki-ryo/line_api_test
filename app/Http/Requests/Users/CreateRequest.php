<?php
declare(strict_types=1);

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
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
//             'store_id' => [
//                 'required',
//                 'numeric',
//                 'exists:stores,id',
//                 'store_id',
//             ],
//             'role_id' => [
//                 'required',
//                 'string',
//                 Rule::in(array_keys(config('permissions.roles.general'))),
//                 // TODO by permissions
//             ],
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
}
